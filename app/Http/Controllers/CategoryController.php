<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CategoryRequestValidation;
use App\Http\Resources\CategoryResource;
use App\Models\CategoryModel;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;

class CategoryController extends Controller
{
     protected $CategoryModel;
     public function __construct(CategoryModel $CategoryModel) {
        $this->CategoryModel = $CategoryModel;
     }

     function Create_category(CategoryRequestValidation $request) : JsonResponse {
  
           $data = $request->validated();

           if ($this->CategoryModel->where('name', $data['name'])->exists()) {
            throw new HttpResponseException(response()->json([
                'errors' => [
                    'name' => ['name sudah tersedia.']
                ]
            ], 400));
           }

             // Buat data baru
        $cate = new $this->CategoryModel($data);
        $cate->name = $data['name'];
        $cate->description = $data['description'];
        $cate->save();

        // Return dengan status 201 dan resource
        return response()->json([
            'message' => 'Success Created',
            'category' => new CategoryResource($cate)
        ], 201);
           
     }

     public function Update_category(CategoryRequestValidation $request, $id): JsonResponse
{
    // Ambil data yang sudah divalidasi
    $data = $request->validated();
    // Cari kategori berdasarkan ID
    $category = $this->CategoryModel->find($id);
    // Jika kategori tidak ditemukan, kembalikan response 404
    if (!$category) {
        return response()->json(['error' => 'Id Category not found'], 404);
    }
    // Update data kategori
    $category->update($data);
            // Return response sukses
    return response()->json([
        'message' => 'Success Updated',
        'category' => new CategoryResource($category)
    ], 200);

}


public function GetAllCategories(): JsonResponse
{
    $categories = $this->CategoryModel->all(); // Mengambil semua kategori
    return response()->json([
        'message' => 'Success',
        'categories' => CategoryResource::collection($categories)
    ], 200);
}



public function GetCategoryById($id): JsonResponse
{
    $category = $this->CategoryModel->find($id);

    if (!$category) {
        return response()->json(['error' => 'Category not found'], 404);
    }

    return response()->json([
        'message' => 'Success',
        'category' => new CategoryResource($category)
    ], 200);
}


public function Delete_category($id): JsonResponse
{
    // Cari kategori berdasarkan ID
    $category = $this->CategoryModel->find($id);

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
