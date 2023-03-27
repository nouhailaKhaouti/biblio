<?php

namespace App\Http\Controllers;

use App\Http\Requests\PasswordRequest;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $book=Auth::user()->books;
        return response()->json(['response'=>'success','Books'=>$book]);
    }

    public function UpdatePassword(PasswordRequest $request){
        $current_user=User::find(Auth::user()->id);
        if(Hash::check($request->old_password,$current_user->password)){
            $current_user->update([
              'password'=>bcrypt($request->new_password)
            ]);
            return response()->json(['response'=>'success','you can now try with your new password']);
        }else{
            return response()->json(['response'=>'some information are wrong'],404);
        }
    } 
    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request)
    {
        //
        $profile =User::find(Auth::user()->id);
        $profile->update($request->all());
        return $profile;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
