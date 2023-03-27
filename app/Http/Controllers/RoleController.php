<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleController extends Controller
{
    //

    public function ChangeRole(){
       if(Auth::user()->role=='Admin'){
            Auth::user()->role=='Normale';
       }else{
            Auth::user()->role=='Admin';
       }
    }
}
