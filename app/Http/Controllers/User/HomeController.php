<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\User;

class HomeController extends Controller
{
    public function index(){
        $product = Product::latest('id')->take(3)->get();

        return view('users.home', compact('product'));
    }

    public function dashboard(){
        $user       = User::all()->count();

        return view('admin.dashboard.index', compact('user'));
    }
}
