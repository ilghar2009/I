<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index(){
        return view('auth');
    }
 
    public function authenticate(Request $request)
    {
        $validator = validator()->make($request->all(),[
            'name' => ['sometimes', 'string', 'max:10'],
            'password' => ['required', 'string', 'min:8'],
        ]);

        if($request->role === 'sign') {
            $valid = User::where('name', $request->name)->first();
            if(!$validator->fails() and !$valid) {
                $user = User::create($request->all());
                Auth::login($user);
                session()->regenerate();
                return redirect()->route('home');
            }else
                return view('auth', ['alertS' => 'user with name or UserName exist']);
        } else {
            if (!$validator->fails()) {
                $userName = $request->name;

                $user = User::where('name', $userName)->first();
                if ($user and Hash::check($request->password, $user->password)) {
                    Auth::login($user);
                    session()->regenerate();

                    return redirect()->route('chat.index');
                } else
                    return view('auth', ['alertL' => 'username or password is wrong']);
            }else
                return redirect()->route('authP')
                    ->withErrors($validator->errors())
                    ->withInput();
        }
        return redirect()->route('authP');
    }
}
