<?php

namespace App\Http\Controllers;


use Illuminate\Validation\ValidationException;

class SessionsController
{

    public function create()
    {
        return view('sessions.create');
    }

    public function store()
    {
        // validate the request
        $attributes = request()->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (! auth()->attempt($attributes)) {
            // auth failed
            throw ValidationException::withMessages(
                ['email' => 'Your provided credentials could not be verified.']
            );
        }

        session()->regenerate();

        // redirect with a success flash message
        return redirect('/')->with('success', 'Welcome Back!');
    }

    public function destroy()
    {
        auth()->logout();

        return redirect('/')->with('success', 'Goodbye!');
    }
}
