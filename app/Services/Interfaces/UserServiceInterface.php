<?php

namespace App\Services\Interfaces;

interface UserServiceInterface
{
	function getAllUsers();

	function getUserById(int $id);

	function store(array $user);

	function update(array $user, int $id);
	
	function delete(int $id);

	function getAllUsersDeleted();

	function restore(int $id);

}