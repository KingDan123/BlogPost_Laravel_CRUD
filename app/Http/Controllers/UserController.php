<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function login(Request $request){
        $incomingFields=$request->validate([
            'loginname'=>'required',
            'loginpassword'=>'required'
        ]); 

    
        if(auth()->attempt(['name'=>$incomingFields['loginname'],'password'=>$incomingFields['loginpassword']])){
            $request->session()->regenerate();


        }
        return redirect('/');
    }



    public function register(Request $request){
        $incomingFields = $request ->validate([
            //data input validation
            'name'=>['required','min:3','max:20'],
            //email must be unique for every user
            'email'=>['required','email',Rule::unique('users','email')],
            'password'=>['required','min:8']

        ]);
        //encrypt password
        $incomingFields['password']=bcrypt($incomingFields['password']);
// create user in database
        $user = User::create($incomingFields);
        auth()->login($user);
        return redirect('/');
    }

    public function logout(){
        auth()->logout();
        return redirect('/');
    }
}
