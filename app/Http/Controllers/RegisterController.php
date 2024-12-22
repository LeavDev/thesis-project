<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kreait\Laravel\Firebase\Facades\Firebase;

class RegisterController extends Controller
{
    private $firebaseAuth;

    public function __construct()
    {
        $this->firebaseAuth = Firebase::auth();
        putenv('CURL_CA_BUNDLE=' . base_path('storage/app/firebase/curl-ca-bundle.crt'));
    }


    public function index()
    {
        return view('pages.register');
    }

    public function register(Request $request)
    {
        $validator = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);

        try {
            $response = $this->firebaseAuth->createUserWithEmailAndPassword($validator['email'], $validator['password']);

            // Sign in the user immediately after registration
            $customToken = $this->firebaseAuth->createCustomToken($response->uid);
            $signInResult = $this->firebaseAuth->signInWithCustomToken($customToken);

            // Store the user session token
            session()->put('firebaseUserId', $response->uid);
            session()->put('idToken', $signInResult->idToken());

            return redirect()->route('admin.dashboard')->with('success', 'Berhasil Register');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Register Gagal');
        }
    }
}
