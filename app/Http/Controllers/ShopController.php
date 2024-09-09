<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
//use Illuminate\Http\File;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
class ShopController extends Controller
{
    public function store(Request $request)
    {
        $filename = $request->file('photo')->getClientOriginalName();
        $request->file('photo')->storeAs('shops', $filename);
        $path = storage_path('app/shops/' . $filename);
         if (!File::exists($path)) {
            abort(404);
        }
        $name ='resized-'.$filename;
        $resize = Image::make($path)->resize(500,500)->save('storage/app/shops/'.$name);
        return 'Success';
    }
}
