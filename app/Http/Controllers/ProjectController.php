<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\File;

class ProjectController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'logo' => [
                'required',
                File::defaults()->max(1024)
            ]
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
