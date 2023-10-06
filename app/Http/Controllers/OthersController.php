<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class OthersController extends Controller
{
    //--check_table
    public function check_table()
    {
        $table = "users";
        if(Schema::hasTable($table)){
            return response()->json([
                'status' => 200,
                'message' => $table. " table exists this Database!"
            ], 200);
        }
        else{
            return response()->json([
                'status' => 404,
                'message' => $table. " table not found this Database!"
            ], 404);
        }
    }
}
