<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Implementation\ProductServiceImplementation;
use App\Validator\ProductValidator;
use App\Model\Product;

class ProductController extends Controller
{
    private $productService;

    private $request;

    private $validator;

    public function __construct(ProductServiceImplementation $productService, Request $request, ProductValidator $productValidator)
    {
        $this->productService = $productService;

        $this->request = $request;

        $this->validator = $productValidator;
    }

    function store()
    {
        $response = response("", 201);

        $validator = $this->validator->validate();

        if($validator->fails())
        {
            $response = response([
                "status" => 422,
                "message" => "Error",
                "errors" => $validator->errors()
            ], 422);
        }
        else 
        {
            $this->productService->store($this->request->all());
        }

        return $response;
    }

    function getAll()
    {
        return response($this->productService->getAll());
    }

    function getProductById(int $id)
    {
        return response($this->productService->getproductById($id));
    }

    function update(int $id)
    {
        $response = response("", 202);

        $this->productService->update($this->request->all(), $id);

        return $response;
    }

    function delete(int $id)
    {
        $this->productService->delete($id);

        return response("", 204);
    }

    function getAllProductsDeleted()
    {
        return response($this->productService->getAllproductsDeleted());
    }

    function restore(int $id)
    {
        $this->productService->restore($id);

        return response("", 204);
    }

}
