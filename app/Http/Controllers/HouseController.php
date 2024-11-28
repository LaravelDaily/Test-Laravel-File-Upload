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

        // حذف الملف القديم من التخزين

        Storage::delete($house->photo);

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
        $filePath = 'houses/' . $house->photo;

        // التحقق إذا كان الملف موجودًا
        if (Storage::exists($filePath)) {
            // إرجاع الملف ليتم تحميله عبر المتصفح
            return Storage::download($filePath);
        }

        // إذا لم يكن الملف موجودًا، إرجاع خطأ 404
        return abort(404, 'File not found');
    }
}
