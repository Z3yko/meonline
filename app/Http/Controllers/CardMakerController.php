<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CardMakerController extends Controller
{
public function handle(){
    return view('cardmaker',[
        'username' => Auth::user()->name,
        'bio' => Auth::user()->info->bio,
        'image' => Auth::user()->info->img,
        'd_name' => Auth::user()->info->d_name,
        'email' => Auth::user()->contact->c_email,
        'phone' => Auth::user()->contact->phone,


    ]);
}
}
