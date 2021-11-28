<?php

namespace App\Http\Controllers;
use \App\Http\Requests\UploadRequest;
use \App\Models\User_info;
use Illuminate\Support\Facades\Auth;
class UploadController extends Controller
{
    public function store(UploadRequest $request){
        $user = User_info::where('user_id', '=', Auth::user()->id)->first();
        if (!$request->validated()['remove']){ 
            $image = $request->validated()['image'];
            $path = $image->storePubliclyAs('avatars',Auth::user()->id . '.png','public');
        }else{
            $path = '';
        }
        $user->img = $path;
        $user->save();
        
                // ddd($validated);
        return response()->json(var_dump($request->validated()['remove']),201);

    }
}
