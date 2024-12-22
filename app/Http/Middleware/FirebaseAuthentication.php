<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Kreait\Laravel\Firebase\Facades\Firebase;

class FirebaseAuthentication
{
    public function handle(Request $request, Closure $next)
    {
        if (!session()->has('firebaseUserId')) {
            return redirect()->route('login');
        }

        try {
            $auth = Firebase::auth();

            $customToken = $auth->createCustomToken(session('firebaseUserId'));
            $signInResult = $auth->signInWithCustomToken($customToken);

            // Update session with fresh token
            session()->put('idToken', $signInResult->idToken());

            return $next($request);
        } catch (\Exception $e) {
            session()->forget(['firebaseUserId', 'idToken']);
            return redirect()->route('login');
        }
    }
}
