<?php

namespace App\Http\Controllers;

use App\Models\Testimonial;

class TestimonialController extends Controller
{
    public function index()
    {
        return view('testimonials.index');
    }

    public function edit(Testimonial $testimonial)
    {
        return view('testimonials.edit', [
            'testimonial' => $testimonial,
        ]);
    }
}   
