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
        $userActive = User::whereNotNull('email_verified_at')->get()->count();
        $product    = Product::all()->count();
        $newProduct = Product::latest('id')->take(3)->get();
        $productAc  = Product::where('is_active', 1)->count();
        
        $data = [
            'user'          => $user,
            'userActive'    => $userActive,
            'product'       => $product,
            'newProduct'    => $newProduct,
            'productActive' => $productAc
        ];

        return view('admin.dashboard.index', compact('data'));
    }
}
