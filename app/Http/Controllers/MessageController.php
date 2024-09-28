<?php

namespace App\Http\Controllers;

use App\Models\MessagesModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function sendNewMessage(Request $request)
    {
        $newMessage = new MessagesModel();
        $newMessage->content = $request->content;
        $newMessage->sender_id = Auth::id();
        $newMessage->receiver_id = $request->friendId;
        $newMessage->save();

        return response()->json(['message' => 'Message sent successfully'], 200);
    }
    public function getMessagesWithFriend(Request $request)
    {
        $friendId = $request->friendId;
        $authUserId = Auth::id();

        $messages = MessagesModel::where(function($query) use ($authUserId, $friendId) {
            $query->where('sender_id', $authUserId)
                ->where('receiver_id', $friendId);
        })
            ->orWhere(function($query) use ($authUserId, $friendId) {
                $query->where('sender_id', $friendId)
                    ->where('receiver_id', $authUserId);
            })
            ->orderBy('created_at', 'asc') // To display messages in the order they were sent
            ->get();
    

        return response()->json($messages, 200);
    }


}
