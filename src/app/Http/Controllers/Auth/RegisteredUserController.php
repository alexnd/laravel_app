<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use App\Http\Controllers\BaseController;
use App\Models\User;
use App\Enums\UserRolesEnum;
use App\Providers\RouteServiceProvider;

class RegisteredUserController extends BaseController
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => UserRolesEnum::USER
        ]);
        // created not active user, should be checked by admin
        $request->session()->put('user_registered_name', $user['name']);
        $request->session()->put('user_registered_email', $user['email']);
        $request->session()->put('user_registered_password', $request->password);

        //event(new Registered($user));
        //Auth::login($user);
        //return redirect(RouteServiceProvider::HOME);

        return redirect('/login');
    }
}
