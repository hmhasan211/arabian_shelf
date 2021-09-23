<?php

namespace App\Http\Controllers;

use App\Models\Subscriber;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;


class SubscriberController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'email'=>'required|email|unique:subscribers'
        ]);

        $subsciber = new Subscriber();
        $subsciber->email = $request->email;
        $subsciber->save();

        Toastr::info('Thanks for Subscription!!', '', ["positionClass" => "toast-top-center", 'progressBar' => true, 'showDuration' => 20,]);
        return back();
    }
}
