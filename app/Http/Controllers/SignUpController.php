<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SignUpController extends Controller
{
    public function index(Request $request)
    {

        $newUser = new User();
        $newUser->name = $request->name;
        $newUser->email = $request->email;
        $newUser->password = Hash::make($request->password);
        $newUser->user_type_id = 1;
        $newUser->mood_status_id = 1;

        if ($newUser->save()) {
            return response()->json(['message' => 'Sign Up Successful'], 200);
        } else {
            return response()->json(['message' => 'Sign Up Failed'], 500);
        }
    }
}
