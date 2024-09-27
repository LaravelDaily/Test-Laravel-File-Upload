<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class ShopController extends Controller
{
    public function store(Request $request)
    {
        $filename = $request->file('photo')->getClientOriginalName();
        $request->file('photo')->storeAs('shops', $filename);


        // TASK: resize the uploaded image from /storage/app/shops/$filename
        $resized = Image::make(Storage::path("shops/{$filename}"))
            ->resize(500,500);
        $resized->save(storage_path("app/shops/resized-".$filename));


        return 'Success';
    }
}
