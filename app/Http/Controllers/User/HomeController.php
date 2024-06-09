<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Content;
use App\Models\Menu;
use App\Models\Product;
use App\Models\User;

class HomeController extends Controller
{
    public function index(){
        $menu = Menu::all();
        $home = Content::whereHas('menu', function($q){
            $q->where('name', 'Home');
        })->first();
        $about = Content::whereHas('menu', function($q){
            $q->where('name', 'About');
        })->first();
        return view('users.home', compact('menu', 'home', 'about'));
    }

    public function dashboard(){
        $user       = User::all()->count();

        return view('admin.dashboard.index', compact('user'));
    }
}
