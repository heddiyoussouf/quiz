<?php

namespace Modules\Auth\Http\Controllers;
use Illuminate\Contracts\Support\Renderable;
use Modules\Auth\Http\Requests\LoginRequest;
use Illuminate\Routing\Controller;
use Modules\Auth\Helpers\RefreshToken;
class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function login(LoginRequest $request){
        $fieldType = filter_var($request->name, FILTER_VALIDATE_EMAIL) ? 'email' : 'name';
        if($token =auth('api')->attempt(array($fieldType=>$request->name,"password"=>$request->password))){
            $user=auth()->user();
            $refresh_token=RefreshToken::make($user->id,$user->type);
            
            return  response()->json(["message"=>"success","data"=>$user,"access_token"=>$token,"refresh_token"=>$refresh_token],200);  
        }
        return  response()->json(['message'=>"user not found"],404);
    }
    
}
