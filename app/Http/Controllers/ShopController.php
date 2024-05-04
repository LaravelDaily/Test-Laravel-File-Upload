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
        $originalName=storage_path('app/shops/' . $filename);


        $resizedImage=Image::make($originalName)->resize(500,500)->encode();


        $resizedImageName='resized-' . $filename;


        $resizedImagePath=storage_path('app/shops/' . $resizedImageName);
        
        file_put_contents($resizedImagePath,$resizedImage);

        return 'Success';
    }
}
