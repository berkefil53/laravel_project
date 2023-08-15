<?php

namespace App\Http\Controllers\api;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;


class CategoryController extends Controller
{
    public function categoryAdd(Request $request)
    {
        $rules = [
            'categoryTitle' => 'required|regex:/^[\d\p{L}\s]+$/u|unique:category|regex:/^\S*$/',
            'categoryDescription' => 'required',
            'status' => 'required'
        ];

        $messages = [
            'categoryTitle.required' => 'Kategori Adı Alanı Gereklidir.',
            'categoryTitle.unique' => 'Bu Kategori Adı Zaten Kullanılıyor.',
            'categoryTitle.regex' => 'Kategori Adında Boşluk Bulunamaz.',
            'categoryDescription.required' => 'Kategori Açıklama alanı gereklidir.',
            'status.required' => 'Statü Boş Bırakılamaz.',
        ];

        $validated = $this->validate($request, $rules, $messages);

        $islem = Category::create($validated);

        if (!$islem) {
            return response()->json(['message' => 'Kategori Yanlış.'], 500);
        }

        return response()->json(['message' => 'Kayıt İşlemi Başarılı.'], 200);    }

    public function categoryList()
    {
        $category = Category::all();
        return $category;

    }

    public function editCategory($id)
    {
        $category = Category::withTrashed()->find($id);

        if ($category) {
            return response()->json(['data'=>$category],200);

        } else {
            // Kategori bulunamazsa hata mesajı göster veya başka bir işlem yap
            return response()->json(['message'=>'Kategori bulunamadı.'],404);
        }
    }

    public function updateSelectedCategory(Request $request, $id)
    {
        $rules = [
            'categoryTitle' => ['required','regex:/^[\d\p{L}\s]+$/u','unique:category,categoryTitle,'.$id],
            'categoryDescription' => ['required'],
            'status' => ['required'],
        ];

        $messages = [
            'categoryTitle.required' => 'Kategori Adı Alanı Gereklidir.',
            'categoryTitle.regex' => 'Kategori Adında Boşluk Bulunamaz.',
            'categoryTitle.unique' => 'Aynı Kategoriden Var.',
            'categoryDescription.required' => 'Kategori Açıklama alanı gereklidir.',
            'status.required' => 'Statü Boş Bırakılamaz.',
        ];

        $this->validate($request, $rules, $messages);

        $category = Category::withTrashed()->find($id);

        if ($category) {
            $category->categoryTitle = $request->input('categoryTitle');
            $category->categoryDescription = $request->input('categoryDescription');
            $category->status = $request->input('status');

            $category->save();

            return response()->json(['message' => 'Kategori başarıyla düzenlendi.'], 200);
        } else {
            return response()->json(['message' => 'Kategori bulunamadı.'], 404);
        }
    }

    public function deleteCategory(int $id)
    {
        $products = Product::where('productCategoryId', $id)->get();

        foreach ($products as $product) {
            $product->productCategoryId = null;
            $product->save();
        }
        Category::where('id',$id)->delete();
        return response()->json(['message' => 'Kategori başarıyla silindi.'], 200);

    }
}
