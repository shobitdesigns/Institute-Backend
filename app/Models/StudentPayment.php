<?php

namespace App\Models;

use App\Models\StudentCourse;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StudentPayment extends Model
{
    use HasFactory;

    public function studentCourse():BelongsTo
    {
        return $this->belongsTo(StudentCourse::class,'student_course_id');
    }
}
