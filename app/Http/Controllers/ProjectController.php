<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            // TASK: Write the validation rule so "logo" file would be MAX 1 megabyte
        ]);

        $filename = $request->file('logo')->getClientOriginalName();
        $request->file('logo')->storeAs('logos', $filename);

        Project::create([
            'name' => $request->name,
            'logo' => $filename,
        ]);

        return 'Success';
    }
}
