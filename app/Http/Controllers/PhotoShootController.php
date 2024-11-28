<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\PhotoShoot;
use Illuminate\Http\Request;

class PhotoShootController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('photoshoots.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {        
        return view('photoshoots.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return view('photoshoots.store');
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
    public function edit(string $id)
    {
        return view('photoshoots.edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        return view('photoshoots.update');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return view('photoshoots.destroy');
    }
}
