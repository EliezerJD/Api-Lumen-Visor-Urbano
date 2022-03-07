<?php

namespace App\Validator;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class UserValidator
{
	private $request;

	public function __construct(Request $request)
	{
		$this->request = $request;
	}

	public function validateStore()
	{
		return Validator::make($this->request->all(), $this->rulesStore(), $this->messages());
	}

	public function validateUpdate()
	{
		return Validator::make($this->request->all(), $this->rulesUpdate(), $this->messages());
	}

	private function rulesStore()
	{
		return [
			'name' => 'required',
			'email' => 'unique:users,email,' . $this->request->id,
			'password' => 'required',
			'confirm_password' => 'required|same:password'
		];
	}

	private function rulesUpdate()
	{
		return [
			'email' => 'unique:users,email,' . $this->request->id
		];
	}

	private function messages()
	{
		return [];
	}
}