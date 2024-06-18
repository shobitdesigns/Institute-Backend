<?php

namespace App\Http\Controllers\cms;

use App\Models\Course;
use Illuminate\Http\Request;
use App\Models\Qualification;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Facades\DataTables;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data       =   Course::join('users', 'users.id', '=', 'courses.added_by')->select(
                'courses.id as id',
                'courses.name as name',
                'courses.duration as duration',
                'courses.mrp as mrp',
                'courses.fix_price as fix_price',
                'users.name as added_by'
            );

            if ($request->order == null) {
                $data->orderBy('courses.created_at', 'desc');
            }

            return DataTables::of($data)
                ->addIndexColumn()
                ->filterColumn('added_by', function ($query, $keyword) {
                    $sql = "users.name LIKE ?";
                    $query->whereRaw($sql, ["%{$keyword}%"]);
                })
                ->editColumn('action',function($data){

                    $editUrl        =   route('course.edit', ['course' => $data->id]);
                    $deleteUrl      =   route('course.destroy', ['course' => $data->id]);
                    $btn            =   '<div class="row">';
                    $btn            .=  '<a href="' . $editUrl . '"><i class="fa fa-edit"></i></a>';
                    if(auth()->user()->hasRole('admin'))
                    {
                        $btn        .=  '<a style="cursor: pointer;"
                                            onclick="deleteItem(\'' . $deleteUrl . '\')">
                                            <i class="fa fa-trash text-red ml-3"></i>
                                        </a>';
                    }
                    $btn            .=  '</div>';

                    return $btn;

                })
                ->rawColumns(['added_by','action'])
                ->make(true);
        }

        return view('cms.course.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['object']         =       new Course();
        $data['method']         =       'POST';
        $data['url']            =       route('course.store');
        $data['qualifications'] =       Qualification::pluck('qualification','id')->toArray();

        return  view('cms.course.form',$data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $course                 =       new Course();
        $course->name           =       $request->name;
        $course->duration       =       $request->duration;
        $course->mrp            =       $request->mrp;
        $course->fix_price      =       $request->fix_price;
        $course->qualification  =       $request->qualification;
        $course->added_by       =       auth()->user()->id;
        $course->save();

        $data['message']        =       auth()->user()->name . " has register " . $course->name;
        $data['action']         =       "created";
        $data['module']         =       "course";
        $data['object']         =       $course;
        saveLogs($data);
        Session::flash("success", "student Register");

        return redirect(route('course.index'));
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
        $data['object']         =       Course::find($id);
        $data['method']         =       'PUT';
        $data['url']            =       route('course.update',['course'=>$id]);
        $data['qualifications'] =       Qualification::pluck('qualification','id')->toArray();

        return  view('cms.course.form',$data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
