<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Show the profile form for the current user.
     */
    public function show(): View
    {
        return view('profile.edit', [
            'user' => auth()->user(),
        ]);
    }

    /**
     * Update the current user's profile.
     */
    public function update(ProfileRequest $request): RedirectResponse
    {
        $user = $request->user();
        $data = $request->validated();

        if ($request->hasFile('avatar')) {
            $this->deleteStoredAvatar($user->avatar);
            $data['avatar'] = $request->file('avatar')->store('avatars', 'public');
        }

        if (! empty($data['password'])) {
            $user->password = $data['password'];
        }

        $user->name = $data['name'];
        $user->email = $data['email'];

        if (array_key_exists('avatar', $data)) {
            $user->avatar = $data['avatar'];
        }

        $user->save();

        return redirect()->route('profile.edit')->with('success', 'Profil berhasil diperbarui.');
    }

    private function deleteStoredAvatar(?string $avatarPath): void
    {
        if ($avatarPath !== null && ! Str::startsWith($avatarPath, ['http://', 'https://'])) {
            Storage::disk('public')->delete($avatarPath);
        }
    }
}
