<?php

namespace App;

use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    /*
        This function is used to 
    */
    function insertUserDetails($request) {
        $this->name = $request->get('name');
        $this->email = $request->get('email');
        $this->password = Hash::make($request->get('password'));

        return $this->save();
    }
}
