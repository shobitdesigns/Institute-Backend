<table>
    <thead>
        <tr>
            <th>Day</th>
            <th>Month</th>
            <th>Year</th>
            <th>ERP NO</th>
            <th>Name</th>
            <th>Father Name</th>
            <th>Place</th>
            <th>Course</th>
            <th>Amount</th>
            <th>Purpose</th>
        </tr>
    </thead>
    <tbody>
        {{-- @foreach ($students as $student)
            @php
                $date           =   Carbon::parse($student->created_at);
                $day            =   $date->day;
                $month          =   $date->month;
                $year           =   $date->year;
                $submitFees     =   $student->studentCourse->payments->sum(function ($student) {
            return $student->pay;
        });
        $pendingFees    =   $student->studentCourse->course_fixed_price - $submitFees;
        $paymentMode    =   ($student->studentCourse->payment_mode == 'full_pay' ) ? 'Full Pay' : 'Installment';
            @endphp
            <tr>
                <td>{{ $day }}</td>
                <td>{{ $month }}</td>
                <td>{{ $year }}</td>
                <td>{{ $student->unique_id }}</td>
                <td>{{ $student->first_name }} {{ $student->first_name }}</td>
                <td>{{ $student->father_name }}</td>
                <td>{{ $student->location }}</td>
                <td>{{ $student->studentCourse->course->name }}</td>
                <td>{{ $pendingFees }}</td>
                <td>{{ $paymentMode }}</td>
            </tr>
        @endforeach --}}
    </tbody>
</table>
