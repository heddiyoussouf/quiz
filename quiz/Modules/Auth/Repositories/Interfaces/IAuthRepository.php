<?php
namespace Modules\Auth\Repositories\Interfaces;
use Illuminate\Http\Request;
interface IAuthRepository{
    public function refresh(Request $request);
    
}