<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class adminController extends Controller
{
    public function adminPage(){
        if(Auth::user()->role == 'admin'){
            return view('adminPage');
        }
        else{
            return redirect()->back()->withErrors(['error' => 'You are not authorized to access this page']);
        }
    }
    public function createUserForm(){
        return view('createUserForm');
    }
    public function createUser(Request $request){
        try{
            $validated = $request->validate([
                'name' => 'required|string',
                'role' => 'required|string',
                'password' => 'required|string'
            ]);
            $user = User::create([
                'name' => $validated['name'],
                'password' => bcrypt($validated['password']),
                'role' => $validated['role']
            ]);
            return redirect()->back()->with('success', 'User has been created');
        }
        catch(\Exception $e){
            \Log::error('Fail to create user with the following message'.$e->getMessage());
            return redirect()->back()->withErrors(['error' => 'An error occured while creating user']);
        }
    }
    public function updateUserForm($id){
        $user = User::find($id);
        return view('updateUserForm', ['user' => $user]);
    }
    public function updateUser(Request $request, $id){
        try{
            $validated = $request->validate([
                'name' => 'required|string',
                'password' => 'required|string',
                'role' => 'required|string',
            ]);
            $user = User::find($id);
            $user->name = $validated['name'];
            $user->password = bcrypt($validated['password']);
            $user->role = $validated['role'];
            $user->save();
            return redirect()->back()->with('success', 'User has been updated');
        }
        catch(\Exception $e){
            \Log::error('Fail to update user with the following message'.$e->getMessage());
            return redirect()->back()->withErrors(['error' => 'An error occured while updating user']);
        }
    }
    public function viewUser(){
        $users = User::all();
        return view('viewUser', ['users' => $users]);
    }

    public function loginForm(){
        return view('loginForm');
    }
    public function login(Request $request){
        try{
            $validated = $request->validate([
                'name' => 'required|string',
                'password' => 'required|string'
            ]);
            if(Auth::attempt($validated)){
                return redirect('/admin');
            }
            else{
                return redirect()->back()->withErrors(['error' => 'Invalid username or password']);
            }
        }
        catch(\Exception $e){
            \Log::error('Fail to login with the following message'.$e->getMessage());
            return redirect()->back()->withErrors(['error' => 'An error occured while logging in']);
        }
    }
}
