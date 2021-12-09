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

        $imgFile = Image::make($request->file('photo')->getRealPath());

        $imgFile->resize(500, 500, function ($constraint) {
            $constraint->aspectRatio();
        })->save(Storage::path("shops/resized-".$filename));


        return 'Success';
    }
}
