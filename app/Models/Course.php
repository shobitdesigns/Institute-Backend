<?php

namespace App\Models;

use App\Models\Qualification;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Course extends Model
{
    use HasFactory;
    protected   $guarded    =   ['id'];
    protected   $table      =   'courses';

    public function qualifications():BelongsToMany
    {
        return $this->belongsToMany(Qualification::class, 'course_qualifications');
    }
}
