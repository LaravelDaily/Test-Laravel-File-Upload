<?php

namespace App\Http\Controllers;

use App\Models\Office;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class OfficeController extends Controller
{
    public function store(Request $request)
    {
        $image = $request->photo->storePubliclyAs(
            'offices',
            $fileName = request()->file('photo')->getClientOriginalName(),
            'public'
        );

        if (!$image) {
            return 'fail';
        }

        Office::create([
            'name' => $request->name,
            'photo' => $fileName,
        ]);

        return 'Success';
    }

    public function show(Office $office)
    {
        return view('offices.show', compact('office'));
    }
}
