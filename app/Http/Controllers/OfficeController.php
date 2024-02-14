<?php

namespace App\Http\Controllers;

use App\Models\Office;
use Illuminate\Http\Request;

class OfficeController extends Controller
{
    public function store(Request $request)
    {
        $filename = $request->file('photo')->getClientOriginalName();

        // TASK: Upload the file "photo" so it would be written as
        //   storage/app/public/offices/[original_filename]

        $path=$request->file('photo')->storeAs('offices',$filename,'public');

        Office::create([
            'name' => $request->name,
            'photo'=> $path
        ]);

        return 'Success';
    }

    public function show(Office $office)
    {
        return view('offices.show', compact('office'));
    }

}
