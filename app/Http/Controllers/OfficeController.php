<?php

namespace App\Http\Controllers;

use App\Models\Office;
use Illuminate\Http\Request;

class OfficeController extends Controller
{
    public function store(Request $request)
    {
        $fileRequest = $request->file('photo');
        $filename = $fileRequest->getClientOriginalName();

        // TASK: Upload the file "photo" so it would be written as
        //   storage/app/public/offices/[original_filename]
        $fileRequest->storeAs('offices', $filename);
        Office::create([
            'name' => $request->name,
            'photo' => $filename,
        ]);

        return 'Success';
    }

    public function show(Office $office)
    {
        return view('offices.show', compact('office'));
    }

}
