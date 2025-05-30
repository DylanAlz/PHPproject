<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;


class AcoountController extends Controller
{
    public function login()
    {
        return view('auth/login');
    }

    public function loginPost(LoginRequest $request) : RedirectResponse
    {
        $request->authenticate();
     
        $request->session()->regenerate();
        return redirect()->intended(route('home.index', absolute: false));
    }

    public function logout(Request $request) : RedirectResponse
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return Redirect(route('login'));
    }

    public function edit(){
        $user = Auth::user();
        return view('auth/profile', ['user' => $user]);

    }

    public function update(Request $request)
    {
        Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'document' => 'required',
        ],
        [
            'first_name.required' => 'First name is required.',
            'last_name.required' => 'Last name is required.',
            'document.required' => 'Document is required.',
        ])->validate();

        try {
            $user = Auth::user();

            $user->update([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'document' => $request->document,
            ]);
            
            Session::flash('message', ['content' => 'Profile updated successfully.', 'type' => 'success']);

        return redirect()->route('home.index');

        } catch (\Exception $e) {
            Log::error($e);
            Session::flash('message', ['content' => 'There was an error updating the profile.', 'type' => 'error']);
            return redirect()->back();
        }
      
    }

    public function changePassword(){
        
        return view('auth/changePassword');

    }

    public function updatePassword(Request $request){
        
        Validator::make($request->all(), [
            'current_password' => 'required',
            'new_password' => 'required|confirmed',
            
        ],
        [
            'current_password.required' => 'The current password is required.',
            'new_password.required' => 'The new password is required.',
            'new_password.confirmed' => 'The password not match.',
        ])->validate();

        try {
            $user = Auth::user();
            if(!Hash::check($request->current_password, $user->password)) {
                Session::flash('message', ['content' => 'The current password is incorrect.', 'type' => 'error']);
                return redirect()->back();

            } else {
                $user->update([
                    'password' => Hash::make($request->new_password),
                ]);
                
                Session::flash('message', ['content' => 'Password updated successfully.', 'type' => 'success']);
                return redirect()->route('home.index');
            }
        

        } catch (\Exception $e) {
            Log::error($e);
            Session::flash('message', ['content' => 'There was an error updating the profile.', 'type' => 'error']);
            return redirect()->back();
        }

    }
}
