<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class ShopController extends Controller
{
    public function store(Request $request)
    {
        $filename = $request->file('photo')->getClientOriginalName();
        $path = $request->file('photo')->storeAs('shops', $filename);

        // TASK: resize the uploaded image from /storage/app/shops/$filename
        //   to size of 500x500 and store it as /storage/app/shops/resized-$filename
        // Use intervention/image package, it's already pre-installed for you

        /*
         * some ways for getting original image
         * */
        // $photo = Image::make(storage_path('app/shops/' . $filename));
        // $photo = Image::make($request->file('photo')->getRealPath())->resize(500, 500);
        $photo = Image::make(Storage::get($path))->resize(500, 500);

        // some ways saving the resized image
        //$photo->save(storage_path('app/shops/resized-' . $filename));
        $photo->save(Storage::path('shops').'/resized-' .$filename);

        return 'Success';
    }
}
