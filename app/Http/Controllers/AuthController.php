<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        if(!Auth::user()){
            return view('auth.create');
        }
        elseif(session('admin')){
            return redirect()->route('admin.index');
        }
        elseif(session('publisher')){
            return redirect()->route('books.index');
        }
        else{
            return redirect()->route('reader.books.index');
        }

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

       $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ], [], [
            'email' => 'Email',
            'password' => 'Password'
            ]);

        $credentials = $request->only('email','password');
        $remember = $request->filled('remember');

        if(Auth::attempt($credentials, $remember)){

            $admin = \App\Models\Admin::where('user_id', Auth::id())->first();
            if($admin)
            {
                session(['admin' => $admin->id]);
                return redirect()->route('admin.index');
            }
            $publisher = \App\Models\Publisher::where('user_id', Auth::id())->first();
            if($publisher)
            {
                session(['publisher' => $publisher->id]);
                return redirect()->route('books.index');
            }
            \App\Models\PurchasedBook::updateCart();
            return redirect()->route('reader.books.index');
        }
        else{
            return redirect()->back()->with('error','Invalid Credentials!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy()
    {
        Auth::logout();

        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect()->route('reader.books.index');
    }
}
