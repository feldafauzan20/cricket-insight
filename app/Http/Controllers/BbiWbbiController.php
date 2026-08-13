<?php

namespace App\Http\Controllers;

use App\Models\BbiWbbiSetting;
use Illuminate\Http\Request;

class BbiWbbiController extends Controller
{
    public function index()
    {
        $setting = BbiWbbiSetting::with(['article1', 'article2', 'article3'])->first();
        // dd($setting);

        return view('bbi-wbbi', compact('setting'));
    }
}
