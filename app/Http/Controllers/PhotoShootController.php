<?php

namespace App\Http\Controllers;

use App\Models\PhotoShoot;

class PhotoShootController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $photoshoots = PhotoShoot::latest()->get();

        return view('photoshoots.index', [
            'photoshoots' => $photoshoots
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {        
        return view('photoshoots.create');
    }

    /**
     * Display the specified resource.
     */
    public function show(PhotoShoot $photoshoot)
    {
        return view('photoshoots.show', [
            'photoshoot' => $photoshoot,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PhotoShoot $photoshoot)
    {
        return view('photoshoots.edit', [
            'photoshoot' => $photoshoot
        ]);
    }
}
