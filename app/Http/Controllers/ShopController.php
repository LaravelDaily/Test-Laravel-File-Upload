<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class ShopController extends Controller
{
    public function store(Request $request)
    {
        $photo = $request->file('photo');
        $filename = $photo->getClientOriginalName();

        // TASK: resize the uploaded image from /storage/app/shops/$filename
        //   to size of 500x500 and store it as /storage/app/shops/resized-$filename
        // Use intervention/image package, it's already pre-installed for you

        $resizedPhoto = Image::make($photo)->fit(500, 500);

        $photo->store('app/shops/resized-' . $filename);

        return 'Success';
    }
}
