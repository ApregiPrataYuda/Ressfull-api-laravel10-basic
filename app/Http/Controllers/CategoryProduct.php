<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CategoryProductModel;
use App\Http\Requests\CategoryProductValidation;
use App\Http\Resources\CategoryProductResource;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryProduct extends Controller
{
      protected $CategoryProductModel;
      public function __construct(CategoryProductModel $CategoryProductModel) {
        $this->CategoryProductModel = $CategoryProductModel;
      }


      public function Create_Category(CategoryProductValidation $request): JsonResponse  {
             $data = $request->validated();

             if ($this->CategoryProductModel->where('name', $data['name'])->exists()) {
              
                throw new HttpResponseException(response()->json([
                    'errors' => [
                        'name' => ['name sudah tersedia.']
                    ]
                ], 400));
             }

             $category = new $this->CategoryProductModel($data);
             $category->name = $data['name'];
             $category->description = $data['description'];
             $category->save();
     
             // Return dengan status 201 dan resource
             return response()->json([
                 'message' => 'Success Created Data Category',
                 'category' => new CategoryProductResource($category)
             ], 201);
      }


      public function Update_Category(CategoryProductValidation $request, $id)  {
        $data = $request->validated();

        $category = $this->CategoryProductModel->find($id);

        if (!$category) {
            return response()->json(['error' => 'Id Category not found'], 404);
        }
        $category->update($data);
         // Return response sukses
           return response()->json([
        'message' => 'Success Updated Data Category',
        'category' => new CategoryProductResource($category)
    ], 200);
      }


      Public function getAllDataCategory(): JsonResponse {
          $getAllData = $this->CategoryProductModel->all();
          return response()->json([
            'message' => 'Success',
            'categories' => CategoryProductResource::collection($getAllData)
        ], 200);
      }

      public function getDataById($id) : JsonResponse {
           $category = $this->CategoryProductModel->find($id);
           if (!$category) {
            return response()->json(['error' => 'Category not found'], 404);
           }

           return response()->json([
            'message' => 'Success',
            'category' => new CategoryProductResource($category)
        ], 200);
      }



      public function Delete_category($id)  {
         // Cari kategori berdasarkan ID
    $category = $this->CategoryProductModel->find($id);

    // Jika kategori tidak ditemukan, kembalikan response 404
    if (!$category) {
        return response()->json(['error' => 'Category not found'], 404);
    }

    // Hapus kategori
    $category->delete();

    // Return response sukses
    return response()->json([
        'message' => 'Success Deleted'
    ], 200);
      }
}
