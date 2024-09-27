<?php

namespace App\Http\Controllers;

use App\Models\FriendsModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FriendController extends Controller
{
    public function getFriends(){
        $friends=FriendsModel::where('user_id_1',Auth::id())
            ->Orwhere('user_id_2',Auth::id())
            ->with('user1.moodStatus','user2.moodStatus')
            ->get();
        return response()->json($friends);
    }
}
