<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

use Socialite;
use App\User;

class SocialController extends Controller
{
    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return Response
     */
    public function viewLogin()
    {
        return view('auth.login');
    }

    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return Response
     */
    public function getFacebookAuth()
    {
        //ユーザー情報を取得
        return Socialite::driver('facebook')->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return Response
     */
    public function getFacebookAuthCallback()
    {
        try {
            $user = Socialite::driver('facebook')->stateless()->user();
            dd($user);

            if ($user) {
                //dd($user);
                // OAuth Two Providers
                $token = $user->token;
                $refreshToken = $user->refreshToken; // not always provided
                $expiresIn = $user->expiresIn;

                // All Providers
                $user->getId();
                $user->getNickname();
                $user->getName();
                $user->getEmail();
                $user->getAvatar();
            }
        } catch (Exception $e) {
            return redirect("/");
        }

        // $user->token;
    }

    public function getGoogleAuth()
    {
        return Socialite::driver('google')->redirect();
    }

    public function getGoogleAuthCallback()
    {
        $gUser = Socialite::driver('google')->stateless()->user();

        $user = User::where('email', $gUser->email)->first();

        if ($user == null) {
            $user = $this->createUserByGoogle($gUser);
        }

        // ログイン処理
        \Auth::login($user, true);
        return redirect('/home');
    }

    public function createUserByGoogle($gUser)
    {
        $user = User::create([
            'name'     => $gUser->name,
            'email'    => $gUser->email,
            'password' => \Hash::make(uniqid()),
        ]);
        return $user;
    }
}
