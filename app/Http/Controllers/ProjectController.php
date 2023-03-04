<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'logo' => 'required|file|max:1000',
            // TASK: Write the validation rule so "logo" file would be MAX 1 megabyte
        ]);

        // TASK: change the below line so that $filename would contain only filename
        // The same filename as the original uploaded file
        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $filename = $file->getClientOriginalName();

            $file->storeAs('logos', $filename);

            Project::create([
                'name' => $request->name,
                'logo' => $filename,
            ]);

            return 'Success';

        } else {

            return 'No file!';

        }
    }
}
