<?php

namespace App\Http\Controllers;

use App\Models\Section;

class SectionController extends Controller
{
    public function index()
    {
        return view('sections.index');
    }

    public function edit(Section $section)
    {
        return view('sections.edit', [
            'section' => $section
        ]);
    }
}
