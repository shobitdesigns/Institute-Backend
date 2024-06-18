<?php

namespace App\Http\Controllers\cms;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Qualification;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\QualificationRequest;

class QualificationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['qualifications']         =       Qualification::all();

        return view('cms.qualification.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['object']     =       new Qualification();
        $data['method']     =       'POST';
        $data['url']        =       route('qualification.store');

        return view('cms.qualification.form',$data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(QualificationRequest $request)
    {
        $qualification                      =       new Qualification();
        $qualification->qualification       =       $request->qualification;
        $qualification->save();

        Session::flash('success','Data added successfully');
        return redirect(route('qualification.index'));
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
        $data['object']     =       Qualification::find($id);
        $data['method']     =       'PUT';
        $data['url']        =       route('qualification.update',['qualification'=>$id]);

        return view('cms.qualification.form',$data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(QualificationRequest $request, string $id)
    {
        $qualification                      =       Qualification::find($id);
        if(empty($qualification))
        {
            Session::flash('error','Data not found');

            return back();
        }
        $qualification->qualification       =       $request->qualification;
        $qualification->update();

        Session::flash('success','Data added successfully');
        return redirect(route('qualification.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->authorize("admin", new User());
        $qualification                   =   Qualification::find($id);
        if (empty($qualification)) {
            Session::flash("error", "Qualification Already Deleted");
            return back();
        }
        $qualification->courses()->detach();
        $data['message']        =   auth()->user()->name . " has deleted '$qualification->name' qualification";
        $data['action']         =   "deleted";
        $data['module']         =   "qualification";
        $data['object']         =   $qualification;
        saveLogs($data);
        $qualification->delete();
        Session::flash("success", "Qualification Deleted");

        return redirect(route("qualification.index"));
    }
}
