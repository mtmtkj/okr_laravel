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
        $organization = Organization::create($request->data());
        \Auth::user()->individual->organizations()->save($organization);

        return redirect()->route('home');
    }
}
