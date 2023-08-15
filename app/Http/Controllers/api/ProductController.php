<?php

namespace App\Http\Controllers\api;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function productAdd(Request $request)
    {
        $rules = [
            'productTitle' => 'required',
            'productCategoryId' => 'nullable',
            'barcode'=>'required',
            'productStatus' => 'required'
        ];

        $messages = [
            'productTitle.required' => '1',
            'productCategoryId.required' => '2',
            'barcode.required' => '3',
            'productStatus.required' => '4',
        ];

        $validated = $this->validate($request, $rules, $messages);
        $islem = Product::create($validated);

        if (!$islem) {
                return response()->json(['message','Ürün Ekleme Başarısız.'],500);
        }

                return response()->json(['message' => 'Ürün Ekleme Başarılı.'], 200);
    }
    public function showAddProductPage(){
        $categories = Category::all();
        return response()->json(['categories' => $categories], 200);
    }
    public function productList()
    {
        $products = Product::all();
        $categories = Category::all();
        return response()->json(['products'=>$products,'categories'=>$categories],200);
    }
    public function editProduct($id)
    {
        $products = Product::withTrashed()->find($id);
        $categories = Category::all();
        if ($products) {
            return response()->json(['products'=>$products,'categories'=>$categories],200);

        } else {
            return redirect()->back()->with('error', 'Ürün bulunamadı.');
        }
    }

    public function updateSelectedProduct(Request $request, $id)
    {
        $rules = [
            'productTitle' => 'required',
            'productCategoryId' => 'nullable',
            'barcode'=>'required',
            'productStatus' => 'required'
        ];

        $messages = [
            'productTitle.required' => '1',
            'productCategoryId.required' => '2',
            'barcode.required' => '3',
            'productStatus.required' => '4',
        ];
        $this->validate($request, $rules, $messages);

        $products = Product::withTrashed()->find($id);

        if ($products) {
            $products->productTitle = $request->input('productTitle');
            $products->productCategoryId = $request->input('productCategoryId');
            $products->barcode = $request->input('barcode');
            $products->productStatus = $request->input('productStatus');
            $products->save();

            return response()->json(['message' => 'Ürün başarıyla düzenlendi.'], 200);
        } else {
            return response()->json(['message' => 'Ürün bulunamadı.'], 404);
        }
    }
    public function deleteProduct(int $id)
    {
        $product = Product::find($id);

        if ($product) {
            $product->delete();
            return response()->json(['message' => 'Ürün başarıyla silindi.'], 200);
        } else {
            return response()->json(['message' => 'Ürün bulunamadı.'], 404);
        }
    }


}
