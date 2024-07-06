<?php

namespace App\Http\Controllers\cms;

use App\Exports\MonthlyCollectionExport;
use App\Exports\StudentsExport;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Course;
use App\Models\Student;
use Illuminate\Http\Request;
use App\Models\StudentCourse;
use App\Models\StudentPayment;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Maatwebsite\Excel\Facades\Excel;
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
                'students.unique_id as unique_id',
                'students.first_name as first_name',
                'students.last_name as last_name',
                'students.father_name as father_name',
                'students.institute as institute',
                'students.location as location',
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
                $data->orderBy('students.unique_id', 'asc');
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
                    $detailUrl      =   route('student.show',['student'=>$data->id]);
                    $btn            =   '<div class="row">';
                    $btn            .=  '<a href="' . $editUrl . '"><i class="fa fa-edit ml-2 mr-2"></i></a><a href="' . $detailUrl . '"><i class="fa fa-info-circle ml-2 mr-2"></i></a>';
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

        return view('cms.student.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['object']             =   new Student();
        $data['method']             =   'POST';
        $data['url']                =   route('student.store');
        $data['courses']            =   Course::pluck('name','id')->toArray();

        return view('cms.student.register',$data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'first_name'            => 'required|string|max:255',
            'last_name'             => 'required|string|max:255',
            'father_name'           => 'required|string|max:255',
            'location'              => 'required|string|max:255',
            'institute'             => 'required',
            'email'                 => 'required|email',
            'mobile'                => 'required|string|max:15',
            'course_id'             => 'required',
            'payment_mode'          => 'required',
            'payment_method'        => 'required_if:payment_mode,full',
            'installment'           => 'required_if:payment_mode,installment|nullable|numeric',
            'installment_months'    => 'required_if:payment_mode,installment|nullable|integer'
        ]);

        $student                  =   new Student();
        $student->first_name      =   $request->first_name;
        $student->last_name       =   $request->last_name;
        $student->father_name     =   $request->father_name;
        $student->institute       =   $request->institute;
        $student->location        =   $request->location;
        $student->email           =   $request->email;
        $student->user_id         =   auth()->user()->id;
        $student->mobile          =   $request->mobile;
        $student->save();

        if ($request->has("tenth_document")) {
            if (file_exists("uploads/students/".$student->id."/" . $student->tenth_document)) {
                File::delete("uploads/students/".$student->id."/"  . $student->tenth_document);
            }
            $tenthDocument  = $student->first_name.'_'."student_tenth_document." . $request->file('tenth_document')->getClientOriginalExtension();
            $request->file('tenth_document')->move(public_path('uploads/students/'.$student->id."/" ), $tenthDocument);
            $student->tenth_document   =  $tenthDocument;
        }

        if ($request->has("twelfth_document")) {
            if (file_exists("uploads/students/".$student->id."/" . $student->twelfth_document)) {
                File::delete("uploads/students/".$student->id."/"  . $student->twelfth_document);
            }
            $twelfthDocument  = $student->first_name.'_'."student_twelfth_document." . $request->file('twelfth_document')->getClientOriginalExtension();
            $request->file('twelfth_document')->move(public_path('uploads/students/'.$student->id."/" ), $twelfthDocument);
            $student->twelfth_document   =  $twelfthDocument;
        }
        if ($request->has("aadhaar_document")) {
            if (file_exists("uploads/students/".$student->id."/" . $student->aadhaar_document)) {
                File::delete("uploads/students/".$student->id."/"  . $student->aadhaar_document);
            }
            $aadhaarDocument  = $student->first_name.'_'."student_aadhaar_document." . $request->file('aadhaar_document')->getClientOriginalExtension();
            $request->file('aadhaar_document')->move(public_path('uploads/students/'.$student->id."/" ), $aadhaarDocument);
            $student->aadhaar_document   =  $aadhaarDocument;
        }
        $student->save();

        $studentApplication                     =   new StudentCourse();
        $studentApplication->student_id         =   $student->id;
        $studentApplication->course_id          =   $request->course_id;
        $studentApplication->monthly_payment    =   $request->monthly_payment;
        $course                                 =   Course::find($request->course_id);
        $studentApplication->course_fixed_price =   $course->fix_price;
        $studentApplication->payment_mode       =   $request->payment_mode;
        $studentApplication->installment_months =   $request->installment_months;
        $studentApplication->added_by           =   auth()->user()->id;
        $studentApplication->save();

        $studentPayment                         =   new StudentPayment();
        $studentPayment->student_course_id      =   $studentApplication->id;
        $studentPayment->payment_mode           =   $request->payment_mode;
        $studentPayment->payment_method         =   $request->payment_method;

        if ($request->payment_mode == 'installment') {
            $studentPayment->pay                =   $request->installment;
        }
        else{
            $studentPayment->pay                =   $studentApplication->course_fixed_price;
        }

        $studentPayment->save();

        $data['message']            =   auth()->user()->name . " has register " . $student->first_name;
        $data['action']             =   "created";
        $data['module']             =   "student";
        $data['object']             =   $student;
        saveLogs($data);
        Session::flash("success", "student Register");

        // return response()->json(['Data Update'], 200);
        return redirect(route('student.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data['student']            =   Student::with('studentCourse.payments','addedBy')->find($id);
        if(empty($data['student']))
        {
            Session::flash('error','Data not found');
            return back();
        }
        $data['totalPaid']          = $data['student']->studentCourse->payments->sum('pay');
        $coursePrice                = $data['student']->studentCourse->course_fixed_price;
        $data['balanceLeft']        = $coursePrice - $data['totalPaid'];

        return view('cms.student.paymentDetail',$data);
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
        $student                  =   Student::find($id);
        if(empty($student))
        {
            Session::flash('error','Data not found');
        }
        $student->first_name      =   $request->first_name;
        $student->last_name       =   $request->last_name;
        $student->email           =   $request->email;
        $student->user_id         =   auth()->user()->id;
        $student->mobile          =   $request->mobile;
        $student->father_name     =   $request->father_name;
        $student->institute       =   $request->institute;
        $student->location        =   $request->location;

        if ($request->has("tenth_document")) {
            if (file_exists("uploads/students/".$student->id."/" . $student->tenth_document)) {
                File::delete("uploads/students/".$student->id."/"  . $student->tenth_document);
            }
            $tenthDocument  = $student->first_name.'_'."student_tenth_document." . $request->file('tenth_document')->getClientOriginalExtension();
            $request->file('tenth_document')->move(public_path('uploads/students/'.$student->id."/" ), $tenthDocument);
            $student->tenth_document   =  $tenthDocument;
        }

        if ($request->has("twelfth_document")) {
            if (file_exists("uploads/students/".$student->id."/" . $student->twelfth_document)) {
                File::delete("uploads/students/".$student->id."/"  . $student->twelfth_document);
            }
            $twelfthDocument  = $student->first_name.'_'."student_twelfth_document." . $request->file('twelfth_document')->getClientOriginalExtension();
            $request->file('twelfth_document')->move(public_path('uploads/students/'.$student->id."/" ), $twelfthDocument);
            $student->twelfth_document   =  $twelfthDocument;
        }
        if ($request->has("aadhaar_document")) {
            if (file_exists("uploads/students/".$student->id."/" . $student->aadhaar_document)) {
                File::delete("uploads/students/".$student->id."/"  . $student->aadhaar_document);
            }
            $aadhaarDocument  = $student->first_name.'_'."student_aadhaar_document." . $request->file('aadhaar_document')->getClientOriginalExtension();
            $request->file('aadhaar_document')->move(public_path('uploads/students/'.$student->id."/" ), $aadhaarDocument);
            $student->aadhaar_document   =  $aadhaarDocument;
        }

        $student->update();

        $data['message']          =   auth()->user()->name . " has updated " . $student->first_name;
        $data['action']           =   "updated";
        $data['module']           =   "student";
        $data['object']           =   $student;
        saveLogs($data);
        Session::flash("success", "student Register");
        return redirect(route('student.index'));
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

        $data['message']            =   auth()->user()->name . " has deleted " . $student->first_name;
        $data['action']             =   "deleted";
        $data['module']             =   "student";
        $data['object']             =   $student;
        saveLogs($data);
        $student->studentCourse->delete();
        $student->delete();
        Session::flash("success", "student Deleted");
        return response()->json($student, 200);
    }

    public function storeMonthlyInstallment(Request $request)
    {
        $request->validate([
            'payment_method'        => 'required',
            'installment'           => 'required|numeric'
        ]);
        $studentPayment                     =   new StudentPayment();
        $studentPayment->student_course_id  =   $request->student_course_id;
        $studentPayment->payment_mode       =   'installment';
        $studentPayment->payment_method     =   $request->payment_method;
        $studentPayment->pay                =   $request->installment;
        $studentPayment->save();

        $student                  =   $studentPayment->studentCourse->student;
        $data['message']          =   auth()->user()->name . " has updated payment of " . $student->first_name;
        $data['action']           =   "updated";
        $data['module']           =   "studentPayment";
        $data['object']           =   $studentPayment;
        saveLogs($data);

        Session::flash('success','Payment Store Successfully');

        return back();
    }

    public function manageStudentInstallment(Request $request)
    {
        if($request->has('student'))
        {
            $data['students']     =     Student::where(function ($query) use ($request) {
                                            $query->where('first_name', 'like', '%' . $request->student . '%')
                                                ->orWhere('last_name', 'like', '%' . $request->student . '%')
                                                ->orWhere('unique_id', 'like', '%' . $request->student . '%')
                                                ->orWhere('father_name', 'like', '%' . $request->student . '%');
                                        })->get();
        }else{
            $data['students']     =     collect();
        }

        return view('cms.student.manageStudentInstallment',$data);
    }

    public function monthlyCollection(Request $request)
    {
        $data['students']               =       Student::whereHas('studentCourse', function ($query) {
                                                        $query->whereHas('payments', function ($paymentQuery) {
                                                            $paymentQuery->where('payment_mode', 'installment');
                                                        });
                                                    })->get()->filter(function ($student) {
                                                        return $student->hasPendingInstallment();
                                                });

        $data['totalMonthlyPayment']    =       $data['students']->sum(function ($student) {
                                                    return $student->studentCourse->monthly_payment;
                                                });

        return view('cms.student.monthlyCollection',$data);
    }

    public function exportMonthlyCollection()
    {
        $students               =       Student::whereHas('studentCourse', function ($query) {
                                            $query->whereHas('payments', function ($paymentQuery) {
                                                $paymentQuery->where('payment_mode', 'installment');
                                            });
                                        })->get()->filter(function ($student) {
                                            return $student->hasPendingInstallment();
                                        });

        return Excel::download(new MonthlyCollectionExport($students), today().'students_pending_installments.xlsx');
    }

    public function exportStudentsData()
    {
        $students               =       Student::with('studentCourse.payments')->get();

        return Excel::download(new StudentsExport($students), today().'students_data.xlsx');
    }
}
