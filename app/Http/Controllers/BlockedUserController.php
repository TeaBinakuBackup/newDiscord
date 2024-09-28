<?php

namespace App\Http\Controllers;

use App\Models\BlockedUsersModel;
use App\Models\FriendsModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BlockedUserController extends Controller
{
    public function getBlockedUsers(){
        $blockedUsers=BlockedUsersModel::where('blocker_user_id',Auth::id())->with('blocked')->get();
        return response()->json($blockedUsers);
 }
    public function blockUser(Request $request) {

        $friend = FriendsModel::find($request->id);


        if (!$friend) {
            return response()->json(['message' => 'Friend not found'], 404);
        }

        // Create a new blocked user entry
        $blocked = new BlockedUsersModel();
        $blocked->blocker_user_id = Auth::id();

        // Determine which user to block
        if ($friend->user_id_1 == Auth::id()) {
            $blocked->blocked_user_id = $friend->user_id_2;
        } else {
            $blocked->blocked_user_id = $friend->user_id_1;
        }

        // Save the blocked user
        $blocked->save();

        // Delete the friendship
        $friend->delete();

        return response()->json(['message' => 'User blocked successfully'], 200);
    }


    public function removeBlock(Request $request){
        $block=BlockedUsersModel::findOrFail($request->id);
        $block->delete();

        return response()->json(['message' => 'User unblocked successfully'], 200);

    }
}
