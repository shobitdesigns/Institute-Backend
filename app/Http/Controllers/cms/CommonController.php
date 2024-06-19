<?php

namespace App\Http\Controllers\cms;

use App\Models\Course;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CommonController extends Controller
{

    public function getCourse($id)
    {
        $course     = Course::with('qualifications')->find($id);

        if ($course) {
            return response()->json([
                'duration' => $course->duration,
                'mrp' => $course->mrp,
                'fix_price' => $course->fix_price,
                'qualifications' => $course->qualifications
            ]);
        } else {
            return response()->json([]);
        }
    }
}
