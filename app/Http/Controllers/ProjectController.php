<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Validation\Rules\File;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'logo' => ['file', File::defaults()->max(1024)]
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
