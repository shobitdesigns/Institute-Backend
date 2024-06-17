<?php

namespace App\Http\Controllers\cms;

use App\Models\User;
use App\Models\Course;
use App\Models\Student;
use Illuminate\Http\Request;
use App\Models\StudentCourse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Facades\DataTables;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data       =   Student::join('users', 'users.id', '=', 'students.user_id')->select(
                'students.id as id',
                'students.first_name as first_name',
                'students.last_name as last_name',
                'students.email as email',
                'students.mobile as mobile',
                'users.name as added_by'
            );
            if(auth()->user()->super_admin || auth()->user()->hasRole('admin'))
            {
                $data;
            }else{
                if(!auth()->user()->hasRole('admin'))
                {
                    $data->where('students.user_id',auth()->user()->id);
                }
            }

            if ($request->order == null) {
                $data->orderBy('students.created_at', 'desc');
            }

            return DataTables::of($data)
                ->addIndexColumn()
                ->filterColumn('added_by', function ($query, $keyword) {
                    $sql = "users.name LIKE ?";
                    $query->whereRaw($sql, ["%{$keyword}%"]);
                })
                ->editColumn('action',function($data){

                    $editUrl        =   route('student.edit', ['student' => $data->id]);
                    $deleteUrl      =   route('student.destroy', ['student' => $data->id]);
                    $btn            =   '<div class="row">';
                    $btn            .=  '<a href="' . $editUrl . '"><i class="fa fa-edit"></i></a>';
                    $btn            .=  '<a style="cursor: pointer;"
                                            onclick="deleteItem(\'' . $deleteUrl . '\')">
                                            <i class="fa fa-trash text-red ml-3"></i>
                                        </a>
                                    </div>';

                    return $btn;

                })
                ->rawColumns(['added_by','action'])
                ->make(true);
        }

        return view('cms.student.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $student                  =   new Student();
        $student->first_name      =   $request->first_name;
        $student->last_name       =   $request->last_name;
        $student->email           =   $request->email;
        $student->user_id         =   auth()->user()->id;
        $student->mobile          =   $request->mobile;
        $student->save();

        $studentApplication                     =   new StudentCourse();
        $studentApplication->student_id         =   $student->id;
        $studentApplication->course_id          =   $request->course_id;
        $studentApplication->added_by           =   auth()->user()->id;
        $studentApplication->save();
        $data['message']            =   auth()->user()->name . " has register " . $student->name;
        $data['action']             =   "created";
        $data['module']             =   "student";
        $data['object']             =   $student;
        saveLogs($data);
        Session::flash("success", "student Register");

        return response()->json(['Data Update'], 200);
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
        $data['object']             =   Student::with('studentCourse')->find($id);
        $data['method']             =   'PUT';
        $data['url']                =   route('student.update',['student'=>$id]);
        $data['courses']            =   Course::pluck('name','id')->toArray();

        return view('cms.student.form',$data);
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
        $this->authorize('admin', new User());

        $student                    =   Student::find($id);
        if (empty($student)) {
            Session::flash("error", "Data Not Found");
            return back();
        }

        $data['message']            =   auth()->user()->name . " has deleted " . $student->name;
        $data['action']             =   "deleted";
        $data['module']             =   "student";
        $data['object']             =   $student;
        saveLogs($data);
        $student->studentCourse->delete();
        $student->delete();
        Session::flash("success", "student Deleted");
        return response()->json($student, 200);
    }
}