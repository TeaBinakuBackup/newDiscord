<?php

namespace App\Http\Controllers;

use App\Models\BlockedUsersModel;
use App\Models\FriendsModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FriendController extends Controller
{
    public function getFriends(){
        $friends = FriendsModel::where(function($query) {
            $query->where('user_id_1', Auth::id())
                ->orWhere('user_id_2', Auth::id());
        })
            ->with(['user1' => function($query) {
                $query->where('id', '!=', Auth::id());  // Exclude Auth::id() from user1
            }, 'user2' => function($query) {
                $query->where('id', '!=', Auth::id());  // Exclude Auth::id() from user2
            }])
            ->get();


        return response()->json($friends);
    }

    public function removeFriend(Request $request){
        $friend=FriendsModel::find($request->id);

        $friend->delete();

        return response()->json('Friend removed',200);
    }






}
