<?php

namespace App\Http\Controllers;

use App\Models\BestServices;
use App\Models\Menu;
use App\Traits\Generics;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use Illuminate\Http\Request;

class MainController extends Controller
{
    //
    use Generics;
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

    public function createMenu(Request $request)
    {
        $request->validate([
            'menu_title' => 'required|string',
            'chef' => 'required|string',
            'amount' => 'required'
        ]);
        $table = 'menus';
        $column = 'menu_id';
        $menu_id = $this->createUniqueID($table, $column);

        $myArray = [
            'menu_id' => $menu_id,
            'menu_title' => $request->menu_title,
            'amount' => $request->amount,
            'chef' => $request->chef,
            'description' => $request->description
        ];

        //if request has a file type
        if ($request->file()) {
            $request->validate([
                'image' => 'mimes:jpeg,jpg,png,gif'
            ]);
            $name = time() . '_' . $request->image->getClientOriginalName();
            $filePath = $request->file('image')->storeAs('uploads', $name, 'public');

            $result = Menu::create(array_merge($myArray, ['image' => $filePath]));
            return response([
                'status' => true,
                'message' => "Menu Created Successfully",
                'data' => $result
            ], 201);
        }
        // if request does not have a file type
        else {
            $result = Menu::create(array_merge($myArray, ['image' => "No Image"]));
            return response([
                'status' => true,
                'message' => "Menu Created Successfully",
                'data' => $result
            ], 201);
        }
    }

    public function createBestServices(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
        ]);
        $table = 'best_services';
        $column = 'unique_id';
        $id = $this->createUniqueID($table, $column);

        $myArray = [
            'unique_id' => $id,
            'title' => $request->menu_title,
            'description' => $request->description
        ];

        //if request has a file type
        if ($request->file()) {
            $request->validate([
                'image' => 'mimes:jpeg,jpg,png,gif'
            ]);
            $name = time() . '_' . $request->image->getClientOriginalName();
            $filePath = $request->file('image')->storeAs('uploads', $name, 'public');

            $result = BestServices::create(array_merge($myArray, ['image' => $filePath]));
            return response([
                'status' => true,
                'message' => "Menu Created Successfully",
                'data' => $result
            ], 201);
        }
        // if request does not have a file type
        else {
            $result = BestServices::create(array_merge($myArray, ['image' => "No Image"]));
            return response([
                'status' => true,
                'message' => "Menu Created Successfully",
                'data' => $result
            ], 201);
        }
    }
}
