<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kreait\Firebase\Factory;
use Kreait\Firebase\Auth;

class ForgotPasswordController extends Controller
{
    protected $auth;

    public function __construct()
    {
        $factory = (new Factory)->withServiceAccount(resource_path('credentials/firebase/firebase_credentials.json'));
        $this->auth = $factory->createAuth();
    }

    public function showForgetPasswordForm()
    {
        return view('pages.forgot-password');
    }

    public function submitForgetPasswordForm(Request $request)
    {
        $request->validate([
            'email' => 'required|email'
        ]);

        try {
            $this->auth->sendPasswordResetLink($request->email);
            // return to login page
            return redirect()->route('login');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Email Tidak Terdaftar']);
        }
    }
}
