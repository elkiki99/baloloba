<?php

namespace App\Http\Controllers;

use App\Models\Footer;

class FooterController extends Controller
{
    public function edit(Footer $footer)
    {
        return view('footer.edit', [
            'footer' => $footer
        ]);
    }
}
