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

        // open an image file
        $img = Image::make('/storage/app/shops/'.$filename);

        // now you are able to resize the instance
        $img->resize(500, 500);

        // and insert a watermark for example
        $img->insert('/storage/app/shops/resized-'.$filename);

        // finally we save the image as a new file
        $img->save();


        return 'Success';
    }
}
