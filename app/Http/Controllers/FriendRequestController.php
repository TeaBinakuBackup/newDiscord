<?php

namespace App\Http\Controllers;

use App\Models\FriendsModel;
use App\Models\User;
use App\Models\FriendRequestModel;
use App\Notifications\FollowRequestNotification3;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FriendRequestController extends Controller
{
    public function addFriendRequest(Request $request)
{
    dump($request->all());

    // Find the user by name or email
    $user = User::where('name', $request->username)
        ->orWhere('email', $request->email)
        ->first();

    if ($user) {
        // Create a new friend request
        $newFriendRequest = new FriendRequestModel();
        $newFriendRequest->requester_user_id = Auth::id();
        $newFriendRequest->requesting_user_id = $user->id;
        $newFriendRequest->request_status_id = 1;

        if ($newFriendRequest->save()) {
            // Send notification to the user being followed/requested
            try {
                // Try sending the notification and log the process
                $user->notify(new FollowRequestNotification3(Auth::user()));

                // Log the notification attempt
               dump('Notification sent to user: ' . $user->id);

            } catch (\Exception $e) {
                // Catch any exceptions and log them
               dump('Notification failed: ' . $e->getMessage());
                return response()->json('Notification failed: ' . $e->getMessage(), 500);
            }

            return response()->json('Friend request sent to user', 200);
        } else {
            return response()->json('Something went wrong!', 500);
        }
    } else {
        return response()->json('User not found', 404);
    }
}


    public function sendFriendRequests(){

        $sendFriendRequests=FriendRequestModel::
        where('requester_user_id',Auth::id())
            ->where('request_status_id',1)
            ->with('RequestingUser','RequestStatus')
            ->get();
        return response()->json($sendFriendRequests);
    }
    public function receivedFriendRequests(){
        $receivedFriendRequests=FriendRequestModel::
            where('requesting_user_id',Auth::id())
            ->where('request_status_id',1)
            ->with('Requester','RequestStatus')
            ->get();

        return response()->json($receivedFriendRequests);
    }

    public function denyFriendRequest(Request $request)
    {

        $id = $request->request_id;

        $friendRequest = FriendRequestModel::findOrFail($id);
            $friendRequest->delete();

        return response()->json('Friend request denied!', 200);
    }
    public function approveFriendRequest(Request $request)
    {
        $id = $request->request_id;

        // Find the friend request by ID
        $friendRequest = FriendRequestModel::findOrFail($id);
//        dump($friendRequest);
        $newFriend=new FriendsModel();
        $newFriend->user_id_1=$friendRequest->requester_user_id;
        $newFriend->user_id_2=$friendRequest->requesting_user_id;
        $newFriend->save();
        //added to follow each other upon confirm
        $newFriend2=new FriendsModel();
        $newFriend2->user_id_1=$friendRequest->requesting_user_id;
        $newFriend2->user_id_2=$friendRequest->requester_user_id;
        $newFriend2->save();
        $friendRequest->request_status_id = 2;  // 2 means accepted
        $friendRequest->save();




        return response()->json('Friend request accepted!', 200);
    }

}

