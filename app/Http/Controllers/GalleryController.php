<?php

namespace App\Http\Controllers;

use App\Data\DummyGalleryData;
use Illuminate\Http\Request;
use Illuminate\View\View;

class GalleryController extends Controller
{
    public function index(): View {
        $galleries = DummyGalleryData::all();

        return view('gallery', [
            'galleries' => $galleries,
        ]);
    }
}
