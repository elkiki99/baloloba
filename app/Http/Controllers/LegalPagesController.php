<?php

namespace App\Http\Controllers;

class LegalPagesController extends Controller
{
    public function cookies()
    {
        return view('legal-pages.cookies');
    }

    public function disclaimer()
    {
        return view('legal-pages.disclaimer');
    }

    public function privacy()
    {
        return view('legal-pages.privacy');
    }

    public function refund()
    {
        return view('legal-pages.refund');
    }
    
    public function terms()
    {
        return view('legal-pages.terms');
    }
}
