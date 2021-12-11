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
        $isDeleted = Storage::delete($house->photo);

        if (!$isDeleted) {
            return 'fail';
        }

        $filename = $request->file('photo')->store('houses');

        $house->update([
            'name' => $request->name,
            'photo' => $filename,
        ]);

        return 'Success';
    }

    public function download(House $house)
    {
        return Storage::download($house->photo);
    }
}
