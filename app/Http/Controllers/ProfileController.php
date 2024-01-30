<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(): View
    {
        $user = Auth::user();

        return view('profile.index', ['user' => $user]);
    }

    public function update(Request $request, User $profile)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'name' => ['nullable', 'string', 'min:3'],
            'address' => ['nullable', 'string', 'min:5'],
            'image_url' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
            'phone_number' => ['nullable', 'string']
        ]);


        $isAuthUser = Auth::user()->id == $profile->id;

        if (!$isAuthUser) {
            return back()->with('error', 'Unauthorized user!');
        }

        // Check if a new image has been uploaded
        if ($request->hasFile('image_url')) {
            // Store the image in the storage
            $fileName = time() . '.' . $request->image_url->extension();
            $request->image_url->storeAs('public/images', $fileName);

            // Update the 'image_url' field with the file name only
            $validatedData['image_url'] = $fileName;
        }

        // Update the profile with the validated data
        $profile->update($validatedData);

        return back()->with('success', 'Profile successfully updated');
    }

    // remove profile image
    public function removeProfile(User $profile)
    {

        $isAuthUser = Auth::user()->id == $profile->id;

        if (!$isAuthUser) {
            return back()->with('error', 'Unauthorized user!');
        }

        $profile->update(['image_url' => null]);

        return back()->with('success', 'Profile successfully updated');
    }

    public function updatePassword(Request $request, User $profile)
    {
        $validatedData = $request->validate([
            'password' => ['string', 'min:4'],
            'confirm_password' => ['same:password'],
        ]);

        $isAuthUser = Auth::user()->id == $profile->id;

        if (!$isAuthUser) {
            return back()->with('error', 'Unauthorized user!');
        }

        $profile->update([
            'password' => bcrypt($validatedData['password'])
        ]);

        // Logout the current user
        Auth::logout();

        // Redirect to the login page
        return redirect()->route('login')->with('success', 'Profile password updated. Please log in again.');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
