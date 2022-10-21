<?php

namespace Modules\User\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\User\Repositories\Interfaces\IUserRepository;
use Modules\User\Http\Requests\UserUpdateRequest;
use Modules\User\Transformers\UserResource;

class UserController extends Controller
{
   public function __construct(protected IUserRepository $user){
        $this->middleware('auth:api',['except'=>['index']]);
   }
   public function update(UserUpdateRequest $request){
     error_log('ok');
        $response=$this->user->update(auth()->user(),$request->validated());
        return response()->json(['message'=>$response?"success":"failed","data"=>$response??null],$response?200:400);
   }
   public function delete(){
        $this->user->delete(auth()->user());
        return response()->json(["message"=>"succes"],200);
   }
   public function logout(){
      auth()->logout(true);
      return response()->json(["message"=>"succes"],200);
     
   }
}
