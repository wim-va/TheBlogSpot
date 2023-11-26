<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('users.index', ['users' => User::all()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view(
            'users.create',
            [
                'params' => [
                    'firstName' => 'First name',
                    'lastName' => 'Last name',
                    'email' => 'Email',
                    'password' => 'Password',
                    'password_confirmation' => 'Password confirmation',
                ]
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // TODO: implement length of different required data
        // TODO: implement custom error pw => alphanum & symbol
        $credentials = $request->validate([
            "firstName" => "required",
            "lastName" => "required",
            "email" => "required",
            "password" => "required|confirmed|between:3,65",
            /* 
 "firstName" => "required|min:3",
 "lastName" => "required|min:3",
 "email" => "required|email|unique:users|min:3",
"password" => "required|confirmed|between:10,65|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*\W+).+$/",
 "password" => "required|confirmed|min:12",
 */
        ]);
        // $user =
        User::create($credentials);
        if (Auth::attempt(
            $credentials
        )) {
            $request->session()->regenerate();

            return redirect('');
            return 'signed in';
            // session()->regenerate();
        }
        return 'failed attempt';

        dd(session());
        dd($request->all());
        return ('users store');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return view('users.show', ['user' => $user]);
        // dd($user);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        if (!Gate::allows('edit-user', $user)) {

            return view(
                'users.edit',
                [
                    'user' => $user,
                    'params' => [
                        'firstName' => 'First name',
                        'lastName' => 'Last name',
                        'email' => 'Email',
                        // 'password' => 'Password',
                        // 'password_confirmation' => 'Password confirmation',
                    ]
                ]
            );
        }

        return 'failure';
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        if (!Gate::allows('edit-user', $user)) {
            return view('users.show', ['user' => $user]);
            // dd($user);
        }
        return redirect(route('users.index'));
        //
        dd($request->all());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    public function logInForm()
    {
        return view('users.logInForm', [
            "title" => 'Create user',
            'params' =>
            [
                "email" => "Email",
                "password" => "Password",
            ]
        ]);
    }
    public function login(Request $request)
    {
        // dd($request->all());
        $credentials = $request->validate([
            "email" => "required|email",
            "password" => "required",
        ]);
        if (auth()->attempt($credentials)) {
            session()->regenerate();
            return redirect(route('users.index'));
        }
        return back()->with('error', 'Unknown credentials');
    }
}
