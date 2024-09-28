<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function changeProfilePicture(Request $request) {
        // Validate the request to ensure an image file is uploaded
        $request->validate([
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',  // Ensure it's an image
        ]);

        $user = Auth::user();

        // Handle the file upload
        if ($request->hasFile('avatar')) {
            // Store the uploaded image in the 'avatars' folder within the 'public' disk
            $path = $request->file('avatar')->store('avatars', 'public');

            // Update the user's avatar with the stored file path
            $user->avatar = $path;
            $user->save();

            // Return the full URL to the image
            return response()->json([
                'message' => 'Profile picture updated successfully',
                'avatar' => asset('storage/' . $path)  // Return full URL to the image
            ], 200);
        }

        return response()->json(['message' => 'No file uploaded'], 400);
    }

    public function getUserProfile() {
        $user = Auth::user();
        // Generate the full URL for the avatar if it exists
        $user->avatar = $user->avatar ? asset('storage/' . $user->avatar) : null;
        return response()->json($user);
    }

}
