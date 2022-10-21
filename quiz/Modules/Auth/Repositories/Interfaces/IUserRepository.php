<?php
namespace Modules\Auth\Repositories\Interfaces;
use Modules\Auth\Entities\User;
interface IUserRepository{
    public function update(User $user,$arr);
    public function delete(User $user);
    public function all();
}