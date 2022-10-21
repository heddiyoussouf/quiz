<?php

namespace Modules\Auth\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Auth\Repositories\Interfaces\IAuthRepository;

class AuthController extends Controller
{
    public function refresh_token(Request $request,IAuthRepository $repo){
        if($token=$repo->refresh($request)){
            return response()->json(["message"=>"success","access_token"=>$token],200);
        }
        return response()->json(['message'=>"invalid token"],403);
    }
    
    
}
