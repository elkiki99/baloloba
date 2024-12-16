<?php

namespace App\Http\Controllers;

use App\Models\Header;

class HeaderController extends Controller
{
    public function index()
    {
        return view('headers.index');
    }

    public function edit(Header $header)
    {
        return view('headers.edit', [
            'header' => $header
        ]);
    }
}
