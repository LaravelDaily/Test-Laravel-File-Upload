<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function store(Request $request)
    {
        $company = Company::create([
            'name' => $request->name,
        ]);
		$company->addMediaFromRequest('photo')->toMediaCollection('companies')->save();

        return 'Success';
    }

    public function show(Company $company)
    {
        // TASK: retrieve the full URL to the uploaded photo file, using Spatie Media Library
        //$photo = '???';
		//$photo = Company::latest()->get();
		 $photo = $company->getFirstMedia('companies')->first()->getUrl();
        return view('companies.show', compact('company', 'photo'));
    }

}
