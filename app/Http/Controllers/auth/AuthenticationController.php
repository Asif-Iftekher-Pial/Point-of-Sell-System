<?php

namespace App\Http\Controllers\auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

class AuthenticationController extends Controller
{
    //
    public function loginPage(){
        return view('partials.auth.login');
    }
    
    public function registrationPage(){
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
            'password' => Hash::make($request->password),
        ]);
        // $notification=array(
        //     'messege' => 'congrats! '.$request->name.' Registration successfull',
        //     'alert-type'=>'success'
        // );
        // return redirect()->back()->with($notification);
        if($data){
            $notification=array(
                'T-messege' => 'congrats '.$request->name.'! Registration successfull',
                'alert-type'=>'success'
            );
            return redirect()->route('login')->with($notification);
        }else{
            $notification=array(
                'T-messege' => 'Oops!Something went wrong',
                'alert-type'=>'error'
            );
            return redirect()->back();
        }

       
    }

    public function login(Request $request){
        // return $request->all();
       

        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8'
        ]);
 
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
 
            // return redirect()->intended('dashboard');
            $status=User::where('id',Auth::user()->id);
            $status->update(['status'=>'active']);
            $notification=array(
                // 'T-messege' => 'welcome '.$request->name.'!',
                'T-messege' => 'welcome ',
                'alert-type'=>'success'
            );
            return redirect()->route('home')->with($notification);
        }
        $notification=array(
            // 'T-messege' => 'welcome '.$request->name.'!',
            'T-messege' => 'welcome ',
            'alert-type'=>'success'
        );
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }
    

    public function logout()
    {
        $status = User::find(Auth::user()->id); //this will find query will authorized logged in user by his ID 
        $status->update([
            'status' => 'inactive'
        ]);

        Auth::logout();
        $notification=array(
            // 'T-messege' => 'welcome '.$request->name.'!',
            'T-messege' => 'Successfully logged out',
            'alert-type'=>'error'
        );
        return redirect()->route('login')->with($notification);
    }



}
