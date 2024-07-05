<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class MonthlyCollectionExport implements FromCollection, WithHeadings, WithMapping, WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */

    protected $students;
    protected $totalMonthlyPayment;

    public function __construct($students)
    {
        $this->students             =   $students;
        $this->totalMonthlyPayment  =   $students->sum(function ($student) {
                                            return $student->studentCourse->monthly_payment;
                                        });
    }

    public function collection()
    {
        return $this->students;
    }

    public function view(): View
    {
        return view('cms.exports.monthlyCollectionExport', [
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

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $event->sheet->appendRows([
                    ['', '', '', '', '', '', 'Total Monthly Payment', $this->totalMonthlyPayment]
                ], $event);

                // Style the header row and total row
                $event->sheet->getStyle('A1:H1')->applyFromArray([
                    'font' => [
                        'bold' => true,
                    ],
                ]);

                $highestRow = $event->sheet->getHighestRow();
                $event->sheet->getStyle("A{$highestRow}:H{$highestRow}")->applyFromArray([
                    'font' => [
                        'bold' => true,
                    ],
                ]);
            },
        ];
    }
}
