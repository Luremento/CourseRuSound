<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\Log;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    public function update_avatar(Request $request) {
        $validated = $request->validate([
            'avatar_change' => 'required|image|mimes:jpg,png,jpeg|max:2048'
        ]);

        $user = User::where('id', Auth::user()->id)->first();
        $photoPath = public_path($user->photo); // Используем public_path для получения абсолютного пути

        if (file_exists($photoPath)) {
            try {
                unlink($photoPath);
            } catch (\Throwable $th) {
                Log::error("Ошибка при удалении фото: " . $photoPath);
            }
        }

        $name = time() . '.' . $request->file('avatar_change')->extension();
        $destination = 'avatars'; // Убираем 'public/' из пути
        $path = $request->file('avatar_change')->storeAs($destination, $name, 'public'); // Используем 'public' диски

        User::where('id', Auth::user()->id)->update([
            'photo' => 'storage/avatars/' . $name // Путь к файлу в публичной директории
        ]);

        return redirect()->back();
    }
}
