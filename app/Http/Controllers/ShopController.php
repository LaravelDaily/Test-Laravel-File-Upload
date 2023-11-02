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

        // Get the path to the original image
        $originalImagePath = storage_path('app/shops/' . $filename);

        // Define the path for the resized image
        $resizedFilename = 'resized-' . $filename;
        $resizedImagePath = storage_path('app/shops/' . $resizedFilename);

        // Open the original image using Intervention Image
        $image = Image::make($originalImagePath);

        // Resize the image to 500x500 pixels
        $image->fit(500, 500);

        // Save the resized image
        $image->save($resizedImagePath);

        return 'Success';
    }
}
