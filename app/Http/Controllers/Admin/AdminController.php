<?php

// namespace App\Http\Controllers;
namespace App\Http\Controllers\Admin;
use App\Models\User;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Models\Subscriber;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // $products = Product::all()->withco();
        // $users = User::all()->count();
        // $subscribers = Subscriber::all()->count();
        // $coupons = Coupon::all()->count();

        // return view('admin.index',compact('products','users','subscribers','coupons'));
        // dd('hello welcome');
    }
    public function deshboard()
    {
        return view('admin.index');
        // dd('hello welcome');
    }
}
