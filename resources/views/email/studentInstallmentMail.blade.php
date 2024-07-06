<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Institute</title>
</head>
<body>
    @php
        $submitFees     =   $student->studentCourse->payments->sum(function ($student) {
            return $student->pay;
        });
        $pendingFees    =   $student->studentCourse->course_fixed_price - $submitFees;
    @endphp
    <h1>Hi {{$student->first_name}} {{$student->last_name}},</h1>
    <p>ID :- <b>{{$student->unique_id}}</b></p>
    <p>Institute :- <b>{{ucfirst($student->institute)}}</b></p>
    <p>Course Name :- <b>{{$student->studentCourse->course->name}}</b></p>
    <p>Payment Mode :- <b>@if($student->studentCourse->payment_mode == 'full_pay') Full Payment @else Installment @endif</b></p>
    @if($student->studentCourse->payment_mode == 'installment')
        <p>Payment Submit:- <b>{{$student->studentCourse->payments->last()->pay}}</b></p>
        <p>Total Payment Submit:- <b>{{$submitFees}}</b></p>
        <p>Payment Left :- <b>{{$pendingFees}}</b></p>
    @endif
    <p>Thank you.</p>
</body>
</html>
