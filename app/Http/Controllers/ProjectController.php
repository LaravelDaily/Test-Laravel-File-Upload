<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'logo' => 'max:1024'
        ]);

        // TASK: change the below line so that $filename would contain only filename
        // The same filename as the original uploaded file
        $filename = $request->file('logo')->getClientOriginalName();
        $request->file('logo')->storeAs('logos', $filename);

        Project::create([
            'name' => $request->name,
            'logo' => $filename,
        ]);

        return 'Success';
    }
}
