<?php

namespace App\Models;

use App\Models\Course;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Qualification extends Model
{
    use HasFactory;
    protected   $guarded    =   ['id'];
    protected   $table      =   'qualifications';

    public function courses():BelongsToMany
    {
        return $this->belongsToMany(Course::class, 'course_qualifications');
    }
}
