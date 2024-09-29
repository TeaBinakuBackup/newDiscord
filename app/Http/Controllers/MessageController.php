<?php

namespace App\Http\Controllers;

use App\Models\MessagesModel;
use App\Models\ReactionToMessagesModel;
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

        // Fetch all messages where the authenticated user is either the sender or receiver
        // and the friend is the other participant.
        $messages = MessagesModel::with(['sender', 'receiver']) // Assuming sender and receiver relationships
        ->where(function($query) use ($authUserId, $friendId) {
            $query->where('sender_id', $authUserId)
                ->where('receiver_id', $friendId);
        })
            ->orWhere(function($query) use ($authUserId, $friendId) {
                $query->where('sender_id', $friendId)
                    ->where('receiver_id', $authUserId);
            })
            ->orderBy('created_at', 'asc')
            ->get();

            // Add a new field 'is_auth_user' to indicate whether the message was sent by the authenticated user
            $messages->transform(function ($message) use ($authUserId) {
                $message->is_auth_user = $message->sender_id === $authUserId;
                return $message;
            });

        return response()->json($messages, 200);
    }

    public function addReaction(Request $request) {
//dump($request->all());
//        $reaction = ReactionToMessagesModel::create([
//            'emoji' => $request->emoji,
//            'reacted_by' => Auth::id(),
//            'message_id' => $request->message_id,
//        ]);
        $reaction=new ReactionToMessagesModel();
        $reaction->emoji=$request->emoji;
        $reaction->reacted_by=Auth::id();
        $reaction->message_id=$request->message_id;
        $reaction->save();

        return response()->json($reaction, 200);
    }

    public function unsendMessage(Request $request){
        $message=MessagesModel::findOrFail($request->message_id);
        $message->delete();
        return response()->json('Message unsend',200);

    }


}
