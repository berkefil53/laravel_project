<?php

namespace App\Http\Controllers;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function categoryAdd(Request $request)
    {
        $rules = [
            'categoryTitle' => 'required|regex:/^[a-zA-ZığüşöçĞÜŞÖÇ\s]+$/u|unique:category|regex:/^\S*$/',
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
            return back()->withErrors('Kategori Yanlış.');
        }

        return redirect()->route('main')->with('categoryAdd', 'Kayıt İşlemi Başarılı.');
    }

    public function categoryList()
    {
        $category = Category::all();
        return view('category/categoryList', ['category' => $category]);
    }

    public function editCategory($id)
    {
        $category = Category::withTrashed()->find($id);

        if ($category) {
            // Eğer kategori bulunduysa, düzenleme formunu göster
            return view('category/editCategory', compact('category'));
        } else {
            // Kategori bulunamazsa hata mesajı göster veya başka bir işlem yap
            return redirect()->back()->with('error', 'Kategori bulunamadı.');
        }
    }

    public function updateSelectedCategory(Request $request, $id)
    {
        $rules = [
            'categoryTitle' => ['required','regex:/^[a-zA-ZığüşöçĞÜŞÖÇ\s]+$/u','unique:category,categoryTitle,'.$id,'regex:/^\S*$/'],
            'categoryDescription' => ['required'],
            'status' => ['required'],
        ];

        $messages = [
            'categoryTitle.required' => 'Kategori Adı Alanı Gereklidir.',
            'categoryTitle.regex' => 'Kategori Adında Boşluk Bulunamaz.',
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

            return redirect()->route('categoryList')->with('success', 'Kategori başarıyla düzenlendi.');
        } else {
            return redirect()->back()->with('error', 'Kategori bulunamadı.');
        }
    }

    public function deleteCategory(int $id)
    {
        Category::where('id',$id)->delete();
        return redirect()->route('categoryListPost');

    }
}
