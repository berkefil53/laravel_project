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
            'productTitle.required' => 'Ürün Adı Boş Bırakılamaz.',
            'barcode.required' => 'Barkod Boş Bırakılamaz.',
            'productStatus.required' => 'Statü Boş Bırakılamaz.',
        ];

        $validated = $this->validate($request, $rules, $messages);
        $islem = Product::create($validated);

        if (!$islem) {
            return back()->withErrors('Kategori Yanlış.');
        }

        return redirect()->route('main')->with('productAdd', 'Kayıt İşlemi Başarılı.');
    }
    public function showAddProductPage()
    {
        $categories = Category::all();

        return view('product/productAdd', ['categories' => $categories]);
    }
    public function productList()
    {
        $products = Product::all();
        $categories = Category::all();
        return view('product/productList', ['products' => $products], ['categories'=> $categories]);
    }
    public function editProduct($id)
    {
        $products = Product::withTrashed()->find($id);
        $categories = Category::all();
        if ($products) {
            return view('product/editProduct', ['products' => $products], ['categories'=> $categories]);
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
            'productTitle.required' => 'Ürün Adı Boş Bırakılamaz.',
            'barcode.required' => 'Barkod Boş Bırakılamaz.',
            'productStatus.required' => 'Statü Boş Bırakılamaz.',
        ];
        $this->validate($request, $rules, $messages);

        $products = Product::withTrashed()->find($id);

        if ($products) {
            $products->productTitle = $request->input('productTitle');
            $products->productCategoryId = $request->input('productCategoryId');
            $products->barcode = $request->input('barcode');
            $products->productStatus = $request->input('productStatus');
            $products->save();

            return redirect()->route('productList')->with('success', 'Ürün başarıyla düzenlendi.');
        } else {
            return redirect()->back()->with('error', 'Ürün bulunamadı.');
        }
    }
    public function deleteProduct(int $id)
    {
        Product::where('id',$id)->delete();
        return redirect()->route('productListPost');

    }

}
