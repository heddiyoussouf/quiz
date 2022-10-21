<?php
namespace Modules\Auth\Repositories;
use Illuminate\Http\Request;
use Modules\Auth\Repositories\Interfaces\IAuthRepository;
use Modules\Auth\Helpers\RefreshToken;
use Illuminate\Support\Facades\Cache;
use Modules\Auth\Entities\User;
class AuthRepository implements IAuthRepository{
    public function refresh(Request $request){
        $refresh_token=$request->bearerToken()??null;
        $response=RefreshToken::check($refresh_token);
        
        if($response!="out"){
            $user=User::find($response['id']);
            if(!is_null(Cache::get('refresh_token_'.$user->id)&& !is_null($user))) return auth()->login($user);
        }
        return null;

    }
    
   
}