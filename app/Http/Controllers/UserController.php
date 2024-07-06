<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Role;
use App\Models\User;
use App\Mail\UserMail;
use App\Models\Document;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize("userManager", new User());

        if(!empty(auth()->user()->super_admin))
        {
            $data['users']          =   User::where('id','<>',auth()->user()->id)->get();
        }
        else
        {
            $data['users']          =   User::where('id','<>',auth()->user()->id)->where(function($query){
                                            $query->whereNull('super_admin')->orWhere('super_admin','0');
                                        })->get();
        }

        return view('cms.user.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
         $this->authorize("userManager", new User());

        $data['object']         =   new User();
        $data['method']         =   'POST';
        $data['url']            =   route('user.store');

        return view('cms.user.form',$data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {
        $this->authorize("userManager", new User());

        $user                   =   new User();
        $user->name             =   $request->name;
        $user->email            =   $request->email;
        $user->contact_number   =   $request->contact_number;
        $password               =   Str::random(8);
        $user->password         =   Hash::make($password);
        if ($request->has("profile_pic")) {
            $imageName  = "user_" . Carbon::now()->timestamp . '.' . $request->file('profile_pic')->getClientOriginalExtension();
            $request->file('profile_pic')->move(public_path('uploads/users/'), $imageName);
            $user->profile_pic  =  $imageName;
        }
        $user->save();

        Mail::to($user->email)->send(new UserMail($user,$password));

        $data['message']        =   auth()->user()->name . " has created '$user->name' account";
        $data['action']         =   "created";
        $data['module']         =   "user";
        $data['object']         =   $user;
        saveLogs($data);
        Session::flash("success", "User Account Created");

        return redirect(route("user.index"));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $this->authorize("userManager", new User());

        $data['user']       =       User::with(['roles','document'])->find($id);

        return view('cms.user.detail',$data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $this->authorize("userManager", new User());

        $data['object']     =   User::find($id);
        if (empty($data['object'])) {
            Session::flash("error", "User Already Deleted");
            return back();
        }
        $data['url']        =   route("user.update", ['user' => $id]);
        $data['method']     =   "PUT";

        return view("cms.user.form", $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request, string $id)
    {
        $this->authorize("userManager", new User());

        $user                   =   User::find($id);
        if (empty($user)) {
            Session::flash("error", "User Already Deleted");
            return redirect(route("user.index"));
        }
        $user->name             =   $request->name;
        $user->email            =   $request->email;
        $user->contact_number   =   $request->contact_number;
        if ($request->has("profile_pic")) {
            if (file_exists("uploads/users/" . $user->profile_pic)) {
                File::delete("uploads/users/" . $user->profile_pic);
            }
            // image upload code
            $imageName  = "user_" . Carbon::now()->timestamp . '.' . $request->file('profile_pic')->getClientOriginalExtension();
            $request->file('profile_pic')->move(public_path('uploads/users/'), $imageName);
            $user->profile_pic   =  $imageName;
        }

        $user->update();

        $data['message']        =   auth()->user()->name . " has updated '$user->name' account";
        $data['action']         =   "updated";
        $data['module']         =   "user";
        $data['object']         =   $user;
        saveLogs($data);
        Session::flash("success", "User Account Updated");
        return redirect(route("user.index"));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->authorize("userManager", new User());

        $user   =   User::find($id);
        if (empty($user)) {
            Session::flash("error", "User Already Deleted");
            return back();
        }

        if (file_exists("uploads/users/" . $user->profile_pic)) {
            File::delete("uploads/users/" . $user->profile_pic);
        }
        if ($user->roles->isNotEmpty()) {
            foreach ($user->roles as $role) {
                $role->permissions()->detach();
            }
        }
        $user->roles()->detach();
        $data['message']        =   auth()->user()->name . " has deleted '$user->name' account";
        $data['action']         =   "deleted";
        $data['module']         =   "user";
        $data['object']         =   $user;
        saveLogs($data);
        $user->delete();
        Session::flash("success", "User Account Deleted");
        return redirect(route("user.index"));
    }

    public function changePassword(Request $request)
    {
        return view("cms.user.changePasswordForm");
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'password' => 'required|confirmed',
            'password_confirmation' => 'required',
        ]);
        $hashValue      =   Hash::make($request->password);
        auth()->user()->update(['password' => $hashValue]);
        Session::flash('success', 'Password Changed Successfully');

        return redirect(route('dashboard'));
    }

    public function assignRoleForm(Request $request)
    {
        $this->authorize("userManager", new User());
        $data['user']   =   User::with('roles')->find($request->id);
        if (empty($data['user'])) {
            Session::flash("error", "User Already Deleted");
            return redirect(route("user.index"));
        }
        $data['roles']  =   Role::all()->pluck("name", "id")->toArray();

        return view("cms.user.assignRole", $data);
    }

    public function assignRole(Request $request)
    {
        $this->authorize("userManager", new User());
        $user                   =   User::find($request->id);
        if (empty($user)) {
            Session::flash("error", "User Already Deleted");
            return redirect(route("user.index"));
        }

        $user->roles()->sync($request->role_id);
        $data['message']        =   auth()->user()->name . " has assigned roles to '$user->name' account";
        $data['action']         =   "assigned";
        $data['module']         =   "user";
        $data['object']         =   $user;
        saveLogs($data);
        Session::flash('success', 'Roles Assigned Successfully');

        return back();
    }

    public function switchUserForm()
    {
        abort_if(auth()->user()->cannot("superAdmin", new User()), 403);

        $data['users']          =   User::where('id', '<>', auth()->user()->id)->pluck('name', 'id')->toArray();

        return view('cms.user.switchUser', $data);
    }

    public function switchUser(Request $request)
    {
        $user = User::findOrFail($request->user_id);

        if ($user) {
            session()->put('original_user', auth()->user()->id);
            auth()->loginUsingId($user->id);
        }

        Session::flash("success", "Successfully User Switch");
        return redirect(route('dashboard'));
    }

    public function logoutSwitchUser()
    {
        if (session()->has('original_user')) {
            auth()->loginUsingId(session()->get('original_user'));
            session()->forget('original_user');
        }

        Session::flash("success", "Successfully Return Back");
        return redirect(route('dashboard'));
    }
}
