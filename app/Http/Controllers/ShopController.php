<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class ShopController extends Controller
{
    public function store(Request $request)
    {
        $filename = $request->file('photo')->getClientOriginalName();
        $request->file('photo')->storeAs('shops', $filename);

        Image::make(Storage::get('shops/'.$filename))->resize(500,500)->save(Storage::path('shops/resized-'.$filename));

        return 'Success';
    }
}
