<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use Illuminate\Http\Request;

class MainController extends Controller
{
    //
    public function login(Request $request)
    {

        // running the validation rules on the inputs
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);
        if (!$token = Auth::attempt($validator->validated())) {
            return response([
                'status' => false,
                "message" => "Incorrect Email Address / Password",
                "data" => "Empty",
            ], 401);
        } else {
            return $this->createNewToken($token);
        }
    }
}
