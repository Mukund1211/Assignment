<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginFormRequest;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /**
     * Login From
     */
    public function viewLoginForm() {
        return view('login');
    }

    /** 
     * Login
     */
    public function login(LoginFormRequest $request){
        $data = $request->validated();

        // get login data
        $loginCredential = $request->only('email', 'password');

        if(auth()->attempt($loginCredential)) {
            return redirect()->route('showBooks');
        } else {
            return redirect()->route('login_view')
                ->with('error','Email-Address And Password Are Wrong.');
        }
    }

    /**
     * Logout
     */
    public function logout(Request $request) {
        auth()->logout();
        return redirect()->route('login_view');
    }
}

