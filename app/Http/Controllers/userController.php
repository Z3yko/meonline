<?php

namespace App\Http\Controllers;
use App\Models\User_contact;
use App\Models\User_info;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Storage;
class  userController extends Controller
{
    private function getUserData($name){
        $user = User::where('name','=',$name)->first();
        $user ? : abort(404);
        $user_contact = $user->contact;
        $i = 0;


        foreach([$user_contact->social, $user_contact->website] as $list ){
            $output = [];
            $items = explode(";;;;",$list);
            foreach($items as $item){
                try{
                $res = explode('::::',$item);
                $output += [$res[0] => $res[1]];
                }catch(Exception $err){

                }
            }
            $i++;
            $i == 1 ? $user_contact->social = $output : '';
            $i == 2 ? $user_contact->website = $output : '';
        }

        $user_info = User_info::where('user_id','=',$user->id)->first();
        $data = [
            'user' => $user,
            'contact' => $user_contact,
            'info' => $user_info
        ];
        return $data;
    }



    public function show(Request $request, $name){

        if ($request->ajax() && User::where('name','=',$name)->first() && User::where('name','=',$name)->first() != Auth::user()) {

            if(strlen($name) > 1){
                return response()->json(['msg' => 'user name already used'],400);
            }

        }elseif($request->ajax()){

            if(strlen($name) > 1){
                return response()->json('user name Available',200);
            }
        }

        return view('userPage',['user' => self::getUserData($name)]);
    }




    public function edit(){
        return view('pageEditor',['user' => $this->getUserData(Auth::user()->name)]);
    }


   public function updateInfo(Request $request){
    try{
       $request->validate([
           'name' => 'string|required|max:255',
           'email' => ['email','max:255',
           Rule::unique('users')->ignore(Auth::user()->id),
           Rule::unique('user_contact','c_email')->ignore(Auth::user()->id)
           ],
           'location' => 'string|max:255',
           'phone' => 'string',
           'social.*' => 'url|max:1500',
           'websites.*' => 'url|max:1500',
           'bio' => 'string|max:70',
       ]);

       $user_info = User_info::where('user_id','=',Auth::user()->id)->first();
       $user_contact = User_contact::where('user_id','=',Auth::user()->id)->first();
       $user_contact->c_email = request('email');
       $user_contact->phone = request('phone');
       $user_info->d_name = request('name');
       $user_info->location = request('location');
       $user_info->bio = request('bio');
       $social = collect(request('social'));
       $websites = collect(request('websites'));
       if (!empty($social)) {
           $mappedSocial = $social->map(function($link, $app) use($social){
            if($social->last() == $link) return $app . '::::' . $link;
            return $app . '::::' . $link . ';;;;';
              });
              $readySocial = $mappedSocial->implode('');
              $user_contact->social = $readySocial;
       }else{
        $user_contact->social = '';
       }

       if(!empty($websites)){
        $mappedWebsites = $websites->map(function($link, $name) use($websites){
            if($websites->last() == $link) return $name . '::::' . $link;
            else return $name . '::::' . $link . ';;;;';
           });
           $readyWebsites = $mappedWebsites->implode('');
           $user_contact->website = $readyWebsites;
       }else{
        $user_contact->website = '';
       }

       $user_contact->save();
       $user_info->save();




    }catch(ValidationException $exception) {
        return response()->json([
            'errors' => $exception->errors(),
        ], 422);
  }

    return response()->json(['done' => json_encode(true),200]);

}


}

