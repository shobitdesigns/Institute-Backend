<?php

namespace App\Http\Controllers\cms;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('superAdmin', new User());

        $setting                =   Setting::first();
        if(!empty($setting))
        {
            return redirect()->route('setting.edit', $setting->id);
        }
        else{
            return redirect()->route('setting.create');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('superAdmin', new User());

        $data['object']         =   new Setting();
        $data['method']         =   'POST';
        $data['url']            =   route('setting.store');

        return view('cms.settingForm',$data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('superAdmin', new User());
        $request->validate([
            'name'  =>  'required|string|max:255|regex:/^[\p{L}\p{M}\p{N}\p{Pd}\p{Pc}\p{Zs}]+$/u',
            'logo'  =>  'image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $setting                =   new Setting();
        $setting->name          =   $request->name;
        if ($request->has("logo")) {
            $imageName  = "logo_" . Carbon::now()->timestamp . '.' . $request->file('logo')->getClientOriginalExtension();
            $request->file('logo')->move(public_path('uploads/logo/'), $imageName);
            $setting->logo   =  $imageName;
        }
        $setting->save();

        $data['message']        =   auth()->user()->name . " has created '$setting->name' account";
        $data['action']         =   "created";
        $data['module']         =   "setting";
        $data['object']         =   $setting;
        saveLogs($data);
        Session::flash("success", "Setting Created");

        return redirect(route('setting.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $this->authorize('superAdmin', new User());

        $data['object']     =   Setting::find($id);
        if (empty($data['object'])) {
            Session::flash("error", "Setting Already Deleted");
            return back();
        }
        $data['url']        =   route("setting.update", ['setting' => $id]);
        $data['method']     =   "PUT";

        return view("cms.settingForm", $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->authorize('superAdmin', new User());

        $request->validate([
            'name'  =>  'required|string|max:255|regex:/^[\p{L}\p{M}\p{N}\p{Pd}\p{Pc}\p{Zs}]+$/u',
            'logo'  =>  'image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $setting                =   Setting::find($id);
        if (empty($setting)) {
            Session::flash("error", "Setting Already Deleted");
            return redirect(route("setting.index"));
        }
        $setting->name          =   $request->name;
        if ($request->has("logo")) {
            if (file_exists("uploads/logo/" . $setting->logo)) {
                File::delete("uploads/logo/" . $setting->logo);
            }
            // image upload code
            $imageName  = "logo_" . Carbon::now()->timestamp . '.' . $request->file('logo')->getClientOriginalExtension();
            $request->file('logo')->move(public_path('uploads/logo/'), $imageName);
            $setting->logo   =  $imageName;
        }
        $setting->update();

        $data['message']        =   auth()->user()->name . " has updated '$setting->name' ";
        $data['action']         =   "updated";
        $data['module']         =   "setting";
        $data['object']         =   $setting;
        saveLogs($data);
        Session::flash("success", "Setting Updated");
        return redirect(route("setting.index"));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
