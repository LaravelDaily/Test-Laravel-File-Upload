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
        $path = $request->file('photo')->storeAs('shops', $filename);
        
        // TASK: resize the uploaded image from /storage/app/shops/$filename
        //   to size of 500x500 and store it as /storage/app/shops/resized-$filename
        // Use intervention/image package, it's already pre-installed for you
        try {
            //code...
            // dd($request->file('photo')->path().'/'.$filename);
            // dd($filename);
            /**** I don't understand why i always get error "Image source not readable" */
            // $img = Image::make($request->file('photo')) //its not working
            // $img = Image::make($request->file('photo')->path()) //its also not working
            // $img = Image::make($request->file('photo')->getRealPath()) //its also not working
            // $img = Image::make($request->photo) //its also not working
            // $img = Image::make($path) //its also not working
            Image::make(Storage::path($path)) //its also not working
                ->resize(500, 500, function ($constraint) {
                    $constraint->aspectRatio();
                })
                // ->fit(500)
                ->save(Storage::path('shops/resized-' . $filename));
            // $img->resize(500, 500);
            // $img->save(public_path('shops').'/resized-'.$filename);
            // Storage::disk(config('filesystem.default'))->put('shops/resized'.$filename, $img);
        } catch (\Intervention\Image\Exception\NotReadableException $e) {
            return 'wkwkwk';
        } catch (\Throwable $e) {
            dd($e->getMessage());
        }


        return 'Success';
    }
}
