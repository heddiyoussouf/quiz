<?php
namespace Modules\User\Repositories;
use Modules\Auth\Entities\User;
use Modules\User\Repositories\Interfaces\IUserRepository;
use Illuminate\Support\Facades\Hash;
class UserRepository implements IUserRepository{

    public function update(User $user,$arr){
        try{
            if(array_key_exists('password',$arr)) $arr['password']=Hash::make($arr['password']);
            $user->update($arr);
            return $user;
        }catch(\Exception $exception){
            return null;
        }
    }
    public function delete(User $user){
        return is_null($user)?$user:$user->delete();
    }
    public function all(){
        return User::orderBy('updated_at','desc')->get();
    }
}