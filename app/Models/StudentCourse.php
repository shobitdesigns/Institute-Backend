<?php

namespace App\Models;

use App\Models\Course;
use App\Models\StudentPayment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StudentCourse extends Model
{
    use HasFactory;

    public function payments():HasMany
    {
        return $this->hasMany(StudentPayment::class);
    }

    public function course():BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class,'student_id');
    }
}
