<?php

namespace App\Http\Controllers;

use App\Models\UserInput;
use Illuminate\Http\Request;

class UserInputController extends Controller
{
    public function showForm()
    {
        return view('userinput.form');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:user_inputs,email',
            'interested_with' => 'nullable|string|max:255',
            'country' => 'nullable|string|max:255',
        ]);

        UserInput::create([
            'name' => $request->name,
            'email' => $request->email,
            'interested_with' => $request->interested_with,
            'country' => $request->country,
        ]);

        return redirect()->route('userinput.form')->with('success', 'User data saved successfully!');
    }
}
