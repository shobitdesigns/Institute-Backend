<?php

namespace App\Exports;

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
            'U-ID', 'First Name', 'Last Name', 'Email', 'Father Name', 'Mobile', 'Institute', 'Monthly Payment'
        ];
    }

    public function map($student): array
    {
        return [
            $student->unique_id,
            $student->first_name,
            $student->last_name,
            $student->email,
            $student->father_name,
            $student->mobile,
            $student->institute,
            $student->studentCourse->monthly_payment,
        ];
    }
}
