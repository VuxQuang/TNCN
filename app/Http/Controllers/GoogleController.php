<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Http\Request;

class GoogleController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback(Request $request)
{
    // Get user from Google
    try {
        $googleUser = Socialite::driver('google')->user();
    } catch (\Exception $e) {
        return redirect()->route('login')->withErrors(['msg' => 'Googleアカウントでログインできませんでした。もう一度お試しください。']);
    }

    // Find the user in the database
    $findUser = User::where('google_id', $googleUser->id)->first();

    if ($findUser) {
        // Log the user in if they exist
        Auth::login($findUser);
        
        // Check if the user is raijin2306@gmail.com
        if ($googleUser->email === 'raijin2306@gmail.com') {
            return redirect()->route('qlLesson'); // Redirect to QlLesson.blade.php
        }

        return redirect()->intended('welcome');
    } else {
        // Create a new user
        $newUser = User::updateOrCreate(
            ['email' => $googleUser->email],
            [
                'name' => $googleUser->name,
                'google_id' => $googleUser->id,
                'password' => bcrypt('12345678'), // Use bcrypt to hash the password
            ]
        );

        // Log the newly created user in
        Auth::login($newUser);

        // Check if the user is raijin2306@gmail.com
        if ($googleUser->email === 'raijin2306@gmail.com') {
            return redirect()->route('qlLesson'); // Redirect to QlLesson.blade.php
        }

        return redirect()->intended('welcome');
    }
}

}
