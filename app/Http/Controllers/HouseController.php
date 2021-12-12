<?php

namespace App\Http\Controllers;

use App\Models\House;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use League\CommonMark\Extension\CommonMark\Node\Inline\Strong;

class HouseController extends Controller
{
    public function store(Request $request)
    {
        // $filename = Storage::disk('public')->put('houses', $request->photo);

        $filename = $request->file('photo')->store('houses');

        House::create([
            'name' => $request->name,
            'photo' => $filename,
        ]);

        return 'Success';
    }

    public function update(Request $request, House $house)
    {
        $filename = $request->photo->store('houses');
        // $filename = Storage::disk('public')->put('houses', $request->photo);

        // TASK: Delete the old file from the storage
        Storage::exists($house->photo) ? Storage::delete($house->photo) : '';

        $house->update([
            'name' => $request->name,
            'photo' => $filename,
        ]);

        return 'Success';
    }

    public function download(House $house)
    {
        return Storage::exists($house->photo) ? Storage::download($house->photo) : '';

        // TASK: Return the $house->photo file from "storage/app/houses" folder
        // for download in browser
    }
}
