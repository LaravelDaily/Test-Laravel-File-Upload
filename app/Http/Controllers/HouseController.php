<?php

namespace App\Http\Controllers;

use App\Models\House;
use Illuminate\Http\Request;
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
        $filename = $request->file('photo')->store('houses');

        // TASK: Delete the old file from the storage
        if(Storage::exists($house->photo)) {
            Storage::delete($house->photo);
        } else {
            throw new \Exception("Not found", 404);
        }
        $house->update([
            'name' => $request->name,
            'photo' => $filename,
        ]);

        return 'Success';
    }

    public function download(House $house)
    {
        // TASK: Return the $house->photo file from "storage/app/houses" folder
        // for download in browser
        return Storage::download($house->photo);
    }
}
