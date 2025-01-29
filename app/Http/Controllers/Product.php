<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\ProductResource;
use App\Http\Requests\ProductValidation;
use App\Models\ProductModel;
use Illuminate\Http\JsonResponse;

class Product extends Controller
{
     protected $ProductModel;
     public function __construct(ProductModel $ProductModel) {
        $this->ProductModel = $ProductModel;
     }


     public function Store(ProductValidation $request): JsonResponse  {
            $data = $request->validated();

            //  $product = new $this->ProductModel($data);
            //  $product->name = $data['name'];
            //  $product->category_id = $data['category_id'];
            //  $product->price = $data['price'];
            //  $product->save();

             // Menggunakan Mass Assignment
                //  $product = $this->ProductModel::create($data);
                 $product = $this->ProductModel->create($data);
             // Return dengan status 201 dan resource
             return response()->json([
                 'message' => 'Success Created Data Product',
                 'Product' => new ProductResource($product)
             ], 201);
     }



        public function Update(ProductValidation $request, $id): JsonResponse  {
            $data = $request->validated();

            $product =  $this->ProductModel->find($id);
            if (!$product) {
                return response()->json(['error' => 'Product not found'], 404);
            }

            $product->update($data);

            return response()->json([
                'message' => 'Success Updated Product',
                'product' => new ProductResource($product)
            ], 200);
     }


     public function Get(): JsonResponse  {
        $getAllData = $this->ProductModel->all();
        return response()->json([
            'message' => 'Success',
            'products' => ProductResource::collection($getAllData)
        ], 200);
     }


     public function getDataById($id) : JsonResponse {
        $product = $this->ProductModel->find($id);
        if (!$product) {
            return response()->json(['error' => 'Product not found'], 404);
        }
        return response()->json([
            'message' => 'Success',
            'product' => new ProductResource($product)
        ], 200);
     }

     public function deleteProduct($id): JsonResponse {
        $product = $this->ProductModel->find($id);

        if (!$product) {
            return response()->json(['error' => 'Product not found'], 404);
        }

        $product->delete();
        return response()->json(['message' => 'Success Deleted'], 200);
    }
}
