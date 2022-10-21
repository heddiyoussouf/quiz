<?php

namespace Modules\Auth\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Auth\Http\Requests\RegisterRequest;
use Illuminate\Support\Facades\Hash;
use Modules\Auth\Entities\User;
use Modules\Auth\Helpers\RefreshToken;
use Illuminate\Support\Facades\URL;
use Modules\Auth\Emails\VerificationEmail;
use Illuminate\Support\Facades\Mail;
class RegisterController extends Controller
{
    public function register(RegisterRequest $request){
        $data=$request->validated();
        $data['password']=Hash::make($data['password']);
        $data['type']="particular";
        $user=User::create($data);
        $url=URL::signedRoute('email-verification',['id'=>$user->id]);
        Mail::to('sahla.youssouf@gmail.com')->send(new VerificationEmail($user,$url));
        $refresh_token=RefreshToken::make($user->id,$user->type);
        return view('auth::auth.verify-email',["user"=>$user,"url"=>$url]);
        //return response()->json(["message"=>"success","access_token"=>auth()->login($user),"refresh_token"=>$refresh_token]);
    }
}
