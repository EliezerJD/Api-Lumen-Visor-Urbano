<?php

namespace App\Services\Implementation;

use App\Services\Interfaces\ProductServiceInterface;
use App\Models\Product;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ProductServiceImplementation implements ProductServiceInterface
{

	private $model;

	function __construct()
	{
		$this->model = new Product();
	}

	function getAll()
	{
		return $this->model->get();
	}

	function getProductById(int $id)
	{
		return $this->model->find($id);
	}

	function store(array $product)
	{
		$this->model->create($product);
	}

	function update(array $product, int $id)
	{
		$this->model->where('id', $id)->first()->fill($product)->save();
	}
	
	function delete(int $id)
	{
		$product = $this->model->find($id);
		if($product != null)
		{
			$product->delete();
		}
	}

	function getAllProductsDeleted()
	{
		return $this->model->onlyTrashed()->get();
	}

	function restore(int $id)
	{
		$product = $this->model->withTrashed()->find($id);

		if($product != null)
		{
			$product->restore();
		}
	}


}