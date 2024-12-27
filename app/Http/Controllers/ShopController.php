<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\ImageManager;

class ShopController extends Controller
{
    public function store(Request $request)
    {
        $filename = $request->file('photo')->getClientOriginalName();
        $path = $request->file('photo')->storeAs('shops', $filename);

        // TASK: resize the uploaded image from /storage/app/shops/$filename
        //   to size of 500x500 and store it as /storage/app/shops/resized-$filename
        // Use intervention/image package, it's already pre-installed for you
        $image = ImageManager::imagick()->read($path);
        $image->resize(500, 500);

        $image->storeAs('shops', 'resized-'.$filename);

        return 'Success';
    }
}
