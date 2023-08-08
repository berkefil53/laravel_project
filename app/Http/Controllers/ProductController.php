<?php

namespace App\Http\Controllers;

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
            return back()->withErrors('Kategori Yanlış.');
        }

        return redirect()->route('main')->with('productAdd', 'Kayıt İşlemi Başarılı.');
    }
    public function showAddProductPage(){
        $categories = Category::all();
        return view('product/productAdd', ['categories'=> $categories]);
    }
}
