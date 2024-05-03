<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class ShopController extends Controller
{
    public function store(Request $request)
    {
        $filename = $request->file('photo')->getClientOriginalName();
        $request->file('photo')->storeAs('shops', $filename);

        // TASK: resize the uploaded image from /storage/app/shops/$filename
        //   to size of 500x500 and store it as /storage/app/shops/resized-$filename
        // Use intervention/image package, it's already pre-installed for you
        $originalPath = storage_path("app/shops/{$filename}");
        $newImg = Image::make($originalPath)->resize(500, 500);

        $newImg->save(storage_path("app/shops/resized-{$filename}"));

        return 'Success';
    }
}
