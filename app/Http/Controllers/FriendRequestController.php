<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\FriendRequestModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FriendRequestController extends Controller
{
    public function addFriendRequest(Request $request)
    {
        dump($request->all());
        dump("po vjen te metoda");
        // Check if the user exists by username or email
        $user = User::where('name', $request->username)
            ->orWhere('email', $request->email)
            ->first();

        if ($user) {
            $newFriendRequest = new FriendRequestModel();
            $newFriendRequest->requester_user_id = Auth::id();  // Current logged-in user
            $newFriendRequest->requesting_user_id = $user->id;  // The user being requested
            $newFriendRequest->request_status_id = 1;  // Pending status

            if ($newFriendRequest->save()) {
                return response()->json('Friend request sent to user', 200);
            } else {
                return response()->json('Something went wrong!', 500);
            }
        } else {
            return response()->json('User not found', 404);
        }
    }
}

