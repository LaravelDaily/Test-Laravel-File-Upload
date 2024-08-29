<?php

namespace App\Http\Controllers;

use App\Models\Office;
use Illuminate\Http\Request;

class OfficeController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'photo' => 'required|file|mimes:jpeg,png,jpg,gif|max:2048', // Adjust validation as needed
        ]);

        $file = $request->file('photo');
        $filename = $file->getClientOriginalName();
        $request->file('photo')->storeAs('offices',$filename,'public');

        // TASK: Upload the file "photo" so it would be written as
        //   storage/app/public/offices/[original_filename]

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
