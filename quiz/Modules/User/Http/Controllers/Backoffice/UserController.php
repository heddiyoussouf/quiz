<?php

namespace Modules\USer\Http\Controllers\backoffice;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\User\Repositories\Interfaces\IUserRepository;
use Modules\User\Http\Requests\UserUpdateRequest;
use Modules\User\Transformers\UserResource;
use Modules\Auth\Entities\User;
class UserController extends Controller
{
   public function __construct(protected IUserRepository $user){
        $this->middleware('auth:api',['except'=>['index']]);
   }
   public function index(){
     return response()->json(["message"=>"succes","data"=>UserResource::collection($this->user->all())],200);
   }
   public function update(UserUpdateRequest $request,$id){
        $response=$this->user->update(User::find($id),$request->validated());
        return response()->json(['message'=>$response?"success":"failed","data"=>$response??null],$response?200:400);
   }
   public function delete($id){
        $response=$this->user->delete(User::find($id));
        return response()->json(["message"=>$response?"succes":"not found"],$response?200:404);
   }
}
