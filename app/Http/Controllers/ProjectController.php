<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'logo' => 'max:1024', // Validation rule to limit logo file size to 1 megabyte
        ]);

        $filename = $request->file('logo')->getClientOriginalName(); // Get the original filename of the uploaded file

        // Store the file in the 'logos' directory with the original filename
        $request->file('logo')->storeAs('logos', $filename);

        Project::create([
            'name' => $request->name,
            'logo' => $filename,
        ]);

        return 'Success';
    }
}
