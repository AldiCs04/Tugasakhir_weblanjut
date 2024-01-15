<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{
    public function redirectGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callbackGoogle()
    {
        try {
            $user = Socialite::driver('google')->user();
            $userDB = User::where('email', $user->email)->first();

            if ($userDB) {
                // Jika pengguna sudah terdaftar, login dan arahkan ke dashboard atau halaman lain
                Auth::login($userDB);

                $userData = DB::table('users')->where('email', $user->email)->first();
                $id = $userData->id;
                $name = $userData->name;
                $email = $user->email;

                return redirect()->route('home', compact('id', 'name', 'email'));
            } else {
                // Jika pengguna belum terdaftar, buat user baru
                $newUser = User::create([
                    'name' => $user->getName(),
                    'email' => $user->getEmail(),
                    'password' => Hash::make('12345678'),
                    'google_id' => $user->getId(),
                    'avatar' => $user->getAvatar(),
                ]);

                // Login user yang baru dibuat
                Auth::login($newUser);

                $id = $newUser->id;
                $name = $newUser->name;
                $email = $user->email;

                return redirect()->route('home', compact('id', 'name', 'email'));
            }
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }

    // public function findOrCreateUser($socialUser, $provider)
    // {
    //     $socialAccount = User::where('google_id', $socialUser->google_id)->first();

    //     if ($socialAccount) {
    //         return $socialAccount->user;

    //     } else {

    //         $user = User::where('email', $socialUser->getEmail())->first();

    //         if (!$user) {
    //             $user = User::create([
    //                 'name'  => $socialUser->getName(),
    //                 'email' => $socialUser->getEmail(),
    //                 'password' => Hash::make('12345678'),
    //                 'google_id' => $socialUser->getId(),
    //                 'avatar' => $socialUser->getAvatar(),
    //             ]);
    //         }

    //         return $user;
    //     }
    // }

    public function dashboard()
    {
        $userLogin = Auth::user();
        return view('dashboard',['user'=>$userLogin]);
    }

    public function logout()
    {
        Auth::logout();
        return redirect('');
    }

}
