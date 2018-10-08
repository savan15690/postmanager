<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserLogin;
use App\Http\Requests\UserRegister;
use Illuminate\Support\Facades\Hash;

use App\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRegister $request)
    {
        $user = new \App\User;

        if ($user->insertUserDetails($request)) {
            # Redirect with success message
            return redirect('login')->with('success', 'Record added successfully.');
        } else {
            # Redirect with fail message
            return redirect('register')->with('fail', 'Record is not added successfully.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function loadLoginView()
    {
        return view('login');
    }

    public function loadRegisterView()
    {
        return view('register');
    }

    public function validateUser(UserLogin $request)
    {
        // Retrieve the validated input data...
        $validated = $request->validated();
        
        $userInfo = User::where('email', $request->get('email'))->first();
        
        if (empty($userInfo)) {
            # code...
            return redirect('login')->with('fail', 'Invalid Email Address');
        } else {
            # code...
            if (Hash::check($request->get('password'), $userInfo->password)) {
                # code...
                session()->put('user_id', $userInfo->id);
                session()->put('is_loggedin', true);

                return redirect('posts');
            } else {
                # code...
                return redirect('login')->with('fail', 'Invalid Password');
            }
        }
    }

    public function logoutUser()
    {
        session()->forget('is_loggedin');
        session()->forget('user_id');

        return redirect('login')->with('success', 'You have logged out successfully');
    }
}
