<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;
use Tymon\JWTAuth\Facades\JWTAuth;
use Google_Client;
use Exception;

class GoogleController extends Controller
{
    public function redirectToProvider()
    {
        $url = Socialite::driver('google')->stateless()->redirect()->getTargetUrl();

        return response()->json([
            'status' => 'success',
            'message' => 'Google login URL generated',
            'url' => $url,
        ], 200);
    }

    public function handleProvideCallback(Request $request)
    {
        try {
            $user = Socialite::driver('google')->stateless()->user();
        } catch (Exception $e) {
            return redirect()->back();
        }

        $authUser = $this->findOrCreateUser($user);

        $token = JWTAuth::fromUser($authUser);

        $redirectUrl = env('FRONTEND_URL') . '/callback-google?jwt_token=' . urlencode($token);

        return redirect()->away($redirectUrl);
    }

    private function findOrCreateUser($googleUser)
    {
        $user = User::where('google_id', $googleUser->id)->first();
        
        if (!$user) {
            $user = User::where('email', $googleUser->email)->first();
        }
        
        if (!$user) {
            $user = User::create([
                'name' => $googleUser->name,
                'email' => $googleUser->email,
                'google_id' => $googleUser->id,
                'avatar' => $googleUser->avatar,
                'password' => bcrypt(Str::random(16)),
            ]);
        } else if (empty($user->google_id)) {
            $user->google_id = $googleUser->id;
            $user->save();
        }

        return $user;
    }
}