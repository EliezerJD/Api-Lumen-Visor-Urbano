<?php

namespace App\Services\Interfaces;

interface ProductServiceInterface
{
	function getAll();

	function getProductById(int $id);

	function store(array $user);

	function update(array $user, int $id);
	
	function delete(int $id);

	function getAllProductsDeleted();

	function restore(int $id);

}