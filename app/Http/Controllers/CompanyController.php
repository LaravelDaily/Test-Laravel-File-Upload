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
        $company->addMediaFromRequest('photo')->toMediaCollection('companies');

        return 'Success';
    }

    public function show(Company $company)
    {
        $photo = $company->getMedia('companies')[0]->getUrl();

        return view('companies.show', compact('company', 'photo'));
    }

}
