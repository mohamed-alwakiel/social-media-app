<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use GuzzleHttp\Psr7\UploadedFile;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use Inertia\Response;
use JetBrains\PhpStorm\NoReturn;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function index(User $user)
    {
        return Inertia::render('Profile/View', [
            'mustVerifyEmail' => $user instanceof MustVerifyEmail,
            'status' => session('status'),
            'success' => session('success'),
            'user' => new UserResource($user)
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

        return Redirect::route('profile.edit');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validate([
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    /**
     * Update user profile images (cover or avatar).
     */
    public function updateProfileImages(Request $request)
    {
        $user = $request->user();

        $data = $request->validate([
            'avatar' => ['nullable', 'image'],
            'cover' => ['nullable', 'image']
        ]);

        $success = '';

        /** @var \Illuminate\Http\UploadedFile $avatar */
        $avatar = $data['avatar'] ?? null;
        if ($avatar) {
            if ($user->avatar_path){
                Storage::disk('public')->delete($user->avatar_path);
            }
            $path = $avatar->store('user-' . $user->id, 'public');
            $user->update(['avatar_path' => $path]);
            $success = 'Your avatar image has been updated.';
        }

        /** @var \Illuminate\Http\UploadedFile $cover */
        $cover = $data['cover'] ?? null;
        if ($cover) {
            if ($user->cover_path){
                Storage::disk('public')->delete($user->cover_path);
            }
            $path = $cover->store('user-' . $user->id, 'public');
            $user->update(['cover_path' => $path]);
            $success = 'Your cover image has been updated.';
        }

        return back()->with('success', $success);
    }

}
