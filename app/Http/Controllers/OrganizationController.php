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
        Organization::create($request->data());

        return redirect()->route('home');
    }
}
