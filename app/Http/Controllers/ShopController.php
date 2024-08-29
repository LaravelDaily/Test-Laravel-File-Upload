<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class ShopController extends Controller
{
    public function store(Request $request)
    {
        // Validate the request to ensure a photo is provided
        $request->validate([
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Get the original filename
        $filename = $request->file('photo')->getClientOriginalName();

        // Store the original photo
        $path = $request->file('photo')->storeAs('shops', $filename);

        // Load the uploaded image
        $image = Image::make(storage_path('app/shops/' . $filename));

        // Resize the image to 500x500
        $image->resize(500, 500);

        // Define the new filename for the resized image
        $resizedFilename = 'resized-' . $filename;

        // Save the resized image
        $image->save(storage_path('app/shops/' . $resizedFilename));

        return 'Success';
    }
}
