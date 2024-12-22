<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Kreait\Laravel\Firebase\Facades\Firebase;

class LoginController extends Controller
{

    public function index()
    {
        return view('pages.login');
    }

    public function login(Request $request)
    {
        $validator = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        try {
            $firebaseAuth = Firebase::auth();
            $signInResult = $firebaseAuth->signInWithEmailAndPassword($validator['email'], $validator['password']);

            // Get user info from sign in result
            $user = $firebaseAuth->getUser($signInResult->firebaseUserId());

            // Store fresh tokens
            session()->put('firebaseUserId', $user->uid);
            session()->put('idToken', $signInResult->idToken());

            return redirect()->route('admin.dashboard');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Login Gagal, Email dan Password Tidak Sesuai');
        }
    }


    public function logout()
    {
        Auth::logout();
        session()->forget(['firebaseUserId', 'idToken']);
        session()->flush();
        return redirect('/login');
    }
}
