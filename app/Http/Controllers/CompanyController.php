<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class CompanyController extends Controller
{
    public function store(Request $request)
    {
        $company = Company::create([
            'name' => $request->name,
        ]);
        $company->addMediaFromRequest('photo')->toMediaCollection('companies');

        return 'Success';
    }

    public function show(Company $company)
    {
        // TASK: retrieve the full URL to the uploaded photo file, using Spatie Media Library
        // Retrieve the first media file from the 'companies' collection
        // Get the full URL of the media file
        $photo = $company->getMedia('companies')->first()->getUrl();

        return view('companies.show', compact('company', 'photo'));
    }

}
