<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\File;

class GalleryController extends Controller
{
    public function index()
    {
        $galleryEvent = File::files(public_path('images/event'));
        $galleryKarya = File::files(public_path('images/karya'));

        return view('welcome', compact('galleryEvent', 'galleryKarya'));
    }
}
