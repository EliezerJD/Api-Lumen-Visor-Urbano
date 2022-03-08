<?php

namespace App\Services\Implementation;

use App\Services\Interfaces\UserServiceInterface;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserServiceImplementation implements UserServiceInterface
{

	private $model;

	function __construct()
	{
		$this->model = new User();
	}

	function getAll()
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
		$this->model->create($user);
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

	function login(array $data)
	{
		
		$user = $this->model->where('email', $data['email'])->first();

		if($user != null)
		{
			if(Hash::check($data['password'], $user->password))
			{
	          $apiToken = base64_encode(Str::random(40));
	          $this->model->where('email', $data['email'])->update(['apiToken' => "$apiToken"]);
	          $user['apiToken'] = $apiToken;
	          return $user;
		    }
		    else
		    {
	        	return [
	                "status" => 422,
	                "message" => "Unauthorized"
	            ];
		    }
		}
	}

}