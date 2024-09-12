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

        // TASK: resize the uploaded image from /storage/app/shops/$filename
        //   to size of 500x500 and store it as /storage/app/shops/resized-$filename
        // Use intervention/image package, it's already pre-installed for you

        //Didn't work for some reason
        // $filePath = 'shops/' . $filename;
        // $img = Image::make(Storage::get($filePath));
        // $img->resize(500, 500);
        // $img->save("/storage/app/shops/resized-$filename");

        Image::make(storage_path('app/shops/' . $filename))
            ->resize(500, 500)
            ->save(storage_path("app/shops/resized-$filename"));

        return 'Success';
    }
}
