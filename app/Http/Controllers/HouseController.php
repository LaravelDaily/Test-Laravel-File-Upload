<?php

namespace App\Http\Controllers;

use App\Models\House;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class HouseController extends Controller
{
    public function store(Request $request)
    {
        $filename = $request->file('photo')->store('houses');

        House::create([
            'name' => $request->name,
            'photo' => $filename,
        ]);

        return 'Success';
    }

    public function update(Request $request, House $house)
    {


        Storage::delete($house->photo);
        $filename = $request->file('photo')->store('houses');


        // TASK: Delete the old file from the storage


        $house_get = $house->update([
            'name' => $request->name,
            'photo' => $filename,
        ]);

        return 'Success';
    }

    public function download(House $house)
    {

        return Storage::download($house->photo);

        // TASK: Return the $house->photo file from "storage/app/houses" folder
        // for download in browser
    }
}
