<?php

namespace App\Exports;

use Carbon\Carbon;
use App\Models\Student;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class StudentsExport implements FromCollection , WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $students;

    public function __construct($students)
    {
        $this->students     =   $students;
    }

    public function collection()
    {
        return $this->students;
    }

    public function view(): View
    {
        return view('cms.exports.studentExport', [
            'students'              => $this->students
        ]);
    }

    public function headings(): array
    {
        return [
            'Day','Month','Year','ERP NO', 'Name', 'Father Name','Place', 'Course', 'Amount', 'Purpose'
        ];
    }

    public function map($student): array
    {
        $date           =   Carbon::parse($student->created_at);
        $day            =   $date->day;
        $month          =   $date->month;
        $year           =   $date->year;
        $submitFees     =   $student->studentCourse->payments->sum(function ($student) {
            return $student->pay;
        });
        $pendingFees    =   $student->studentCourse->course_fixed_price - $submitFees;
        $paymentMode    =   ($student->studentCourse->payment_mode == 'full_pay' ) ? 'Full Pay' : 'Installment';
        return [
            $day,
            $month,
            $year,
            $student->unique_id,
            $student->first_name .' '. $student->last_name,
            $student->father_name,
            $student->location,
            $student->studentCourse->course->name,
            $pendingFees,
            $paymentMode
        ];
    }
}
