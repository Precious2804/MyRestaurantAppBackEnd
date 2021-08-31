<?php

namespace App\Traits;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\BestServices;
use App\Models\Menu;

trait Generics
{
    // a function that generates a random unique ID
    function generateId()
    {
        $unique_id = (string) Str::uuid();
        $exploded = explode('-', $unique_id);
        $n_unique_id = $exploded[4];
        return $n_unique_id;
    }

    function createUniqueID($table, $column)
    {
        $id = $this->generateId();
        return DB::table($table)->where($column, $id)->first() ? $this->createUniqueID($table, $column) :  $id;
    }
    function createNewToken($token)
    {
        return response()->json([
            'status' => true,
            'message' => "Login Was Successful",
            'data' => auth()->user(),
            'access_token' => 'Bearer ' . $token,
            'token_type' => 'bearer',
            'expires_in' => Auth::factory()->getTTL() * 60000
        ]);
    }
}
