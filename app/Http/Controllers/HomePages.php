<?php

namespace App\Http\Controllers;

use App\Models\PhotoShoot;

class HomePages extends Controller
{
    public function welcome()
    {
        $photoshoots = PhotoShoot::take(6)->where('status', 'published')->latest()->get();

        return view('homepages.welcome', [
            'photoshoots' => $photoshoots
        ]);
    }

    public function about()
    {
        return view('homepages.about');
    }

    public function contact()
    {
        return view('homepages.contact');
    }

    public function components()
    {
        return view('admin.components.index');
    }
}
