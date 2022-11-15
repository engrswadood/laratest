<?php
namespace App\Repositories\User;


use App\Repositories\User\UserInterface as UserInterface;
use App\Models\User;


class UserRepository implements UserInterface
{
    public $user;

    function __construct(User $user) {
	$this->user = $user;
    }

    public function getAll()
    {
        return $this->user->getAll();
    }

    public function find($nam)
    {
		return User::select('name', 'email', 'id')
                           ->where('name', '=', $nam)
                           ->get();
		
    }


    public function delete($id)
    {
        return $this->user->deleteUser($id);
    }
}