<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Str;

class AuthenticatedSessionController extends Controller
{
    /**
     * Отображаем страницу логина
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        return redirect()->intended(route('index', absolute: false));
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    /**
     * Переводим на страницу авторизации Yandex
     */
    public function RedirectYandex(): RedirectResponse {
        return Socialite::driver('yandex')->redirect();
    }

    /**
     * Авторизируем пользователя
     */
    public function CallbackYandex() {
        $user = Socialite::driver('yandex')->user();
        $info = $this->RegOrUser($user);
        if ($info === 'default') {
            return inertia('Auth/Login', ['ErrorMsg' => 'Пожалуйста, используйте Email и пароль для входа']);
        } else {
            return redirect()->route('index');
        }
    }

    /**
     * Проверяем данные
     */
    private function RegOrUser($user) {
        $existingUser = User::where('email', $user->email)->first();
        if (!$existingUser) {
            $name = time(). ".". 'png';
            $destination = 'public/avatars/';
            $imageData = file_get_contents($user->avatar);
            $info = file_put_contents('storage/avatars/' . $name, $imageData);
            $newUser = User::create([
                'name'=>$user->name,
                'email'=>$user->email,
                'unix'=>time(),
                'profile_image'=>'storage/avatars/' . $name,
                'password'=>Hash::make(Str::uuid()),
                'regist_method'=>'yandex'
            ]);

            Auth::login($newUser);
        } else {
            if ($existingUser->regist_method!='yandex'){
                return $error = 'default';
            } else {
                Auth::login($existingUser);
            }
        }
    }
}
