<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
class AuthorizationController extends Controller
{
    public function register(Request $request){
        $request->validate([
            'name' =>['required','string','min:10','max:50'],
            'email' =>['required','email'],
            'password' =>['required','min:6','max:25','confirmed'],
            'gender' =>['required'],
            'dateOfBirth'=>['required']
        ]);
        User::create([
            'name' =>$request->name,
            'email' =>$request->email,
            'password' => bcrypt($request->password),
            'gender' =>$request->gender,
            'dateOfBirth'=>$request->dateOfBirth

        ]);
        return redirect()->route('login');
    }
    public function login(Request $request){
        $user = User::where('email',$request->email)->first();
        if(!$user){
            return redirect()->route('login');
        }
        if(!Hash::check($request->password,$user->password)){
            return redirect()->route('login');
        }

        Auth::loginUsingId($user->id);
        return redirect()->back();
    }
    public function resetPassword(Request $request){
        dd($request->all());
    }
    public function logout(Request $request){
        auth()->logout();
        return redirect()->route('login');
    }
}
