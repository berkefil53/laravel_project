<?php

namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CategoryController extends Controller
{
    public function categoryAdd(Request $request)
    {
        $validated = $request->validate([
            'categoryTitle' => 'required|regex:/^[a-zA-ZığüşöçĞÜŞÖÇ\s]+$/u|unique:category|regex:/^\S*$/',
            'categoryDescription' => 'required',
            'status' => 'required'
         ],
            $messages = [
                'categoryTitle.required' => 'Kategori Adı Alanı Gereklidir.',
                'categoryTitle.unique' => 'Bu Kategori Adı Zaten Kullanılıyor.',
                'categoryTitle.regex' => 'Kategori Adında Boşluk Bulunamaz.',
                'categoryDescription.required' => 'Kategori Açıklama alanı gereklidir.',
                'status.required' => 'Statü Boş Bırakılamaz.',
            ]);
        $this->validate($request, $validated, $messages);
        $islem = Category::create($validated);

        if (!$islem) {
            return back()->withErrors('Kategory Yanlış.');
        }
        return redirect()->route('main')->with('categoryAdd', 'Kayıt İşlemi Başarılı. ');

    }
}
