<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string'],
            'logo' => ['required', 'file', 'max:500']
        ]);

        // TASK: change the below line so that $filename would contain only filename
        // The same filename as the original uploaded file
        $logo = $request->file('logo');

        $filename = $logo->getClientOriginalName();
        $logo->storeAs('logos', $filename);

        Project::create([
            'name' => $request->name,
            'logo' => $filename,
        ]);

        return 'Success';
    }
}
