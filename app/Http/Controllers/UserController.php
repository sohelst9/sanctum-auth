<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    //--------------all users ---////////////////
    public function index()
    {
        $users = User::get();
        return response()->json($users);
    }

    public function edit($id)
    {
        $user = User::where('id', $id)->first();
        if($user){
            return response()->json([
                'status' => 200,
                'data' => $user
            ], 200);
        }else{
            return response()->json([
                'status' => 404,
                'message' => 'User Not Found!'
            ], 404);
        }
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' =>'required',
            'email' =>'email|required|unique:users,email,'.$id,
        ]);
        if($validator->fails()){
            return response()->json([
                'status' => 422,
                'message' => $validator->errors()
            ],422);
        }

        $user = User::where('id', $id)->first();
        if($user){
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
            ]);
            return response()->json([
                'status' => 200,
                'message' => 'user updated successfully!'
            ], 200);
        }else{
            return response()->json([
                'status' => 404,
                'message' => 'User Not Found!'
            ], 404);
        }
    }

    public function delete($id)
    {
        $user = User::where('id', $id)->first();
        if($user){
            $user->delete();
            return response()->json([
                'status' => 200,
                'message' => 'user deleted successfully!'
            ], 200);
        }else{
            return response()->json([
                'status' => 404,
                'message' => 'User Not Found!'
            ], 404);
        }
    }



    //--------------all users end ---////////////////

    //////////////-- auth  user  ---////////////////
    public function user()
    {
        try {
            $user = auth()->user();
        } catch (\Exception $error) {
            $user = null;
        }
        if (is_null($user)) {
            return response()->json([
                'status' => 500,
                'message' => 'Internal Server Error'
            ], 500);
        } else {
            return response()->json($user);
        }
    }

    //--update
    public function auth_user_update(Request $request)
    {
        $user_id = auth()->user()->id;
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'email|required|unique:users,email,' . $user_id
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'message' => $validator->errors()
            ], 422);
        } else {
            $user = User::findOrFail($user_id);
            if ($user) {
                $user->update([
                    'name' => $request->name,
                    'email' => $request->email,
                ]);
                return response()->json([
                    'status' => 200,
                    'message' => 'User Updated Successfully!'
                ], 200);
            } else {
                return response()->json([
                    'status' => 404,
                    'message' => 'User Not Found!'
                ], 404);
            }
        }
    }

    //----change_password
    public function change_password(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'old_password' => 'required',
            'password' => 'required|min:6|max:12|confirmed'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages()
            ], 422);
        } else {
            if (Hash::check($request->old_password, auth()->user()->password)) {
                $user = User::findOrFail(auth()->user()->id);
                $user->update([
                    'password' => Hash::make($request->password)
                ]);
                return response()->json([
                    'status' => 200,
                    'message' => 'User Password Change Successfully!'
                ], 200);
            } else {
                return response()->json([
                    'status' => 401,
                    'message' => 'Old Password Does Not Match!'
                ], 401);
            }
        }
    }
}
