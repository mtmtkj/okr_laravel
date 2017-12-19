<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateOrganizationRequest;
use App\Organization;

class OrganizationController extends Controller
{
    public function create()
    {
        return view('organization.create');
    }

    public function store(CreateOrganizationRequest $request)
    {
        $organization = Organization::create(['name'=>$request->name]);
        \Auth::user()->individual->saveOrganization($organization);

        return redirect()->route('home');
    }
}
