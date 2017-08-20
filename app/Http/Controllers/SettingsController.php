<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateSettingsRequest;
use Auth;

class SettingsController extends Controller
{
    public function edit()
    {
        return view('settings.index')->with(['user' => Auth::user()]);
    }

    public function update(UpdateSettingsRequest $request)
    {
        $user = Auth::user();
        $name = $request->input('name');
        $user->name = $name;
        $password = $request->input('new_password');
        if (!empty($password)) {
            $user->password = $password;
        }
        $user->save();

        session()->flash('success', 'Successfully updated.');

        return redirect()->route('settings.edit');
    }
}
