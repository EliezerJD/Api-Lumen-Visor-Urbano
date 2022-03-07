<?php

namespace App\Services\Implementation;

use App\Services\Interfaces\UserServiceInterface;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserServiceImplementation implements UserServiceInterface
{

	private $model;

	function __construct()
	{
		$this->model = new User();
	}

	function getAllUsers()
	{
		return $this->model->get();
	}

	function getUserById(int $id)
	{
		return $this->model->find($id);
	}

	function store(array $user)
	{
		$user['password'] = Hash::make($user['password']);
		$this->model->store($user);
	}

	function update(array $user, int $id)
	{
		$user['password'] = Hash::make($user['password']);
		$this->model->where('id', $id)->first()->fill($user)->save();
	}
	
	function delete(int $id)
	{
		$user = $this->model->find($id);
		if($user != null)
		{
			$user->delete();
		}
	}

	function getAllUsersDeleted()
	{
		return $this->model->onlyTrashed()->get();
	}

	function restore(int $id)
	{
		$user = $this->model->withTrashed()->find($id);

		if($user != null)
		{
			$user->restore();
		}
	}

}