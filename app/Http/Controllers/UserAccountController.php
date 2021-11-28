<?php

namespace App\Http\Controllers;
use App\Models\User;
use Exception;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use App\Mail\AccountCreated;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\Null_;
use SebastianBergmann\Type\NullType;

class UserAccountController extends Controller
{
    public function show(Request $request){
        $user = User::find(Auth::user()->id);
        return view('userAccount',[
            'name' => Auth::user()->name,
            'email' => Auth::user()->email,
            'emailVerified' => Auth::user()->email_verified_at ? 1 : 0,
        ]);
    }

    public function store(Request $request, $attribute){
        $user = User::find(Auth::user()->id)->first();
        switch ($attribute) {
            case 'name':
                $request->validate(['name' => 'unique:users|string|min:2|max:30|regex:/^[a-z0-9\040\.\-\_]+$/i']);
                $user->name = $request->name;
                $user->save();
                return response()->json(['nameSendMsg' => 'username updated']);
                break;
            case 'email':
                if($request->email == $user->email){
                    return response()->json(['emailSendMsg' => 'Valid email !!']);
                } 
                $request->validate(['email' => 'required|unique:users|max:254|email']);
                return response()->json(['emailSendMsg' => 'Valid email !!']);
            case 'update-email':
                if($request->email == $user->email){
                    return response()->json(['emailSendMsg' => 'email updated']);
                } 
                $request->validate(['email' => 'required|unique:users|max:254|email']);
                $user->email = $request->email;
                $user->email_verified_at = null;
                $user->save();
                return response()->json(['emailSendMsg' => 'email updated']);
            case 'update-password':
                $request->validate([
                    'currentPassword' => 'current_password:web',
                    'password' => ['required', 'confirmed', Rules\Password::defaults()],
                ]);

                $user->forceFill([
                    'password' => Hash::make($request->password),
                    'remember_token' => Str::random(60),
                ])->save();

                event(new PasswordReset($user));

                return response()->json(['msg' => 'password updated'], 200);


            default:
                # code...
                break;
        }

    }
}
