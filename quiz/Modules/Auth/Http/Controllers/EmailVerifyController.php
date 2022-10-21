<?php

namespace Modules\Auth\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Auth\Entities\User;
class EmailVerifyController extends Controller
{
    public function verify($id)
   {
    try{
        $user=User::findOrFail($id);
        return $user;
    }catch(\Exception $exception){
        return "failed";
    }
   }
}
