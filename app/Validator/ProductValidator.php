<?php

namespace App\Validator;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class ProductValidator
{
	private $request;

	public function __construct(Request $request)
	{
		$this->request = $request;
	}

	public function validate()
	{
		return Validator::make($this->request->all(), $this->rules(), $this->messages());
	}

	private function rules()
	{
		return [
			'name' => 'required',
			'description' => 'required',
			'price' => 'required',
			'amount' => 'required',
			'image' => 'required',
		];
	}


	private function messages()
	{
		return [];
	}
}