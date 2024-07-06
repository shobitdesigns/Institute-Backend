<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Institute</title>
</head>
<body>
    <h1>Student Registration</h1>
    <p>Hi {{$student->first_name}} {{$student->last_name}},</p>
    <p>ID :- <b>{{$student->unique_id}}</b></p>
    <p>Institute :- <b>{{ucfirst($student->institute)}}</b></p>
    <p>Course Name :- <b>{{$student->studentCourse->course->name}}</b></p>
    <p>Course Duration :- <b>{{$student->studentCourse->course->duration}}</b></p>
    <p>Course Price :- <b>{{$student->studentCourse->course_fixed_price}}</b></p>
    <p>Payment Mode :- <b>@if($student->studentCourse->payment_mode == 'full_pay') Full Payment @else Installment @endif</b></p>
    @if($student->studentCourse->payment_mode == 'installment')
        <p>Payment Submit:- <b>{{$student->studentCourse->payments->first()->pay}}</b></p>
        <p>Installment Month :- <b>{{$student->studentCourse->installment_months}}</b></p>
        <p>Monthly Installment:- <b>{{$student->studentCourse->monthly_payment}}</b></p>
    @else
        <p>Payment Submit:- <b>{{$student->studentCourse->payments->first()->pay}}</b></p>
    @endif
    <p>Thank you.</p>
</body>
</html>
