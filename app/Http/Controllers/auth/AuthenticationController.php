<?php

namespace App\Http\Controllers\auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AuthenticationController extends Controller
{
    //
    public function login(){
        return view('partials.auth.login');
    }
    
    public function registration(){
        return view('partials.auth.register');
    }

    public function saveUser(Request $request){
        
        $request->validate([
            'email' => 'required|unique:users,email',
            'name' => 'string|required',
            'password' => [
                'required', 'string',
                'min:8',               // must be at least 12 characters in length
                'regex:/[a-z]/',       // must contain at least one lowercase letter
                'regex:/[A-Z]/',      // must contain at least one uppercase letter
                'regex:/[0-9]/',     // must contain a special character
            ],
            'confirmPassword'=>'required|same:password',
        ]);
        
       $data= User::create([
            
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);
        // $notification=array(
        //     'messege' => 'congrats! '.$request->name.' Registration successfull',
        //     'alert-type'=>'success'
        // );
        // return redirect()->back()->with($notification);
        if($data){
            $notification=array(
                'messege' => 'congrats! '.$request->name.' Registration successfull',
                'alert-type'=>'success'
            );
            return redirect()->route('login')->with($notification);
        }else{
            $notification=array(
                'messege' => 'Oops!Something went wrong',
                'alert-type'=>'error'
            );
            return redirect()->back();
        }

       
    }



}
