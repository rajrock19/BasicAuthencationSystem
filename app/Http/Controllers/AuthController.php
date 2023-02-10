<?php

namespace App\Http\Controllers;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    Public function homePage(){
        return view('home');
    }
    
    public function registerPage(){
       
       
        return view('register');
    }
    public function loginUser(){
        return view('login');
    }

    public function registerUser(Request $request){
        
        $user =new User;
        $user->name=$request['name'];
        $user->email=$request['email'];
        $user->phone=$request['phone'];
        $user->password=bcrypt($request['password']);
        $user->confirmpassword=bcrypt($request['confirmpassword']);
        $user->save();
        return response("Successfully  added");
    }

    public function customLogin(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
    
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->intended('dashboard')
                        ->withSuccess('Signed in');
        }
   
        return redirect("login")->withSuccess('Login details are not valid');
    }
    public function dashboard()
    {
        if(Auth::check()){
            $users=User::first();
            $data=compact('users');
             return view('dashboard')->with($data);
          
        }
   
        return redirect("login")->withSuccess('are not allowed to access');
    }
    public function registration()
    {
        return view('auth.registration');
    }

    public function showUser(){
        $users =User::all();
        return view('show',compact('users'));
    
    }
   public function trash()
   {
    $users=User::onlyTrashed()->get();
    return view('usertrash',compact('users'));
   }

    public function delete($id){
        $users=User::find($id);
        if(!is_null($users)){
            $users->delete();
        }
      return redirect('show');
    }
    public function edit($id){
        $user=User::find($id);
        if(is_null($user)){
            return redirect('show'); 
        }else{
    
         return view('edit',compact('user','id'));
        }
    } 
    public function update($id, Request $request){
        $users=User::find($id);
        $users->name=$request['name'];
        $users->email=$request['email'];
        $users->phone=$request['phone'];
        $users->save();

      return view('show');


    }
}

