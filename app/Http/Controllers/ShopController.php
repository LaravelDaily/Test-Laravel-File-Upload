<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class ShopController extends Controller
{
    public function store(Request $request)
    {
        $filename = $request->file('photo')->getClientOriginalName();
        $originalImage = $request->file('photo')->storeAs('shops', $filename);

        Image::make(storage_path('app/'.$originalImage))->resize(500, 500)->save(storage_path('app/shops/resized-'.$filename));

        return 'Success';
    }
}
