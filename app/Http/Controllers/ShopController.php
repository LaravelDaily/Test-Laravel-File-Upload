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
        $extension = $request->file('photo')->getClientOriginalExtension();
        $request->file('photo')->storeAs('shops', $filename);

        // TASK: resize the uploaded image from /storage/app/shops/$filename
        //   to size of 500x500 and store it as /storage/app/shops/resized-$filename
        // Use intervention/image package, it's already pre-installed for you

        // $content = Storage::get('shops/' . $filename);

        // open an image file
        $img = Image::make($request->file('photo'));

        // resize image instance
        $img->resize(500, 500);


        // save image in desired format
        // $img->save(Storage::get('shops/resized-' . $filename));

        Storage::put('shops/resized-' . $filename, $img->encode($extension));


        return 'Success';
    }
}
