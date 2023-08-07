<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use illuminate\Database\Eloquent\SoftDeletes;

class KullanicilarController extends Controller
{
    /*
    public function create()
    {
        $Kullanici=new Kullanicilar;
        $Kullanici->username ='berkefil';
        $Kullanici->password='12345678910';
        $Kullanici->save();
        return "veri kaydedildi";
    }*/

    public function checkLogin(Request $request)
    {
        $this->validate($request, [
            'username' => 'required|alphaNum',
            'password' => 'required|min:6'
        ]);
        if (Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
            return redirect()->route('main')->with('login', 'Giriş İşlemi Başarılı hoşgeldin ');
        }
        return redirect()->back()->with('login', 'fail');
    }

    public function logout()
    {
        auth()->logout();
        return redirect()->route('login')->with('login', 'Çıkış Başarıyla Gerçekleşti. ');
    }

    public function addUser(Request $request)
    {
        $validated = $request->validate([
            'username' => 'required|alphaNum|unique:users',
            'user_title' => 'required',
            'password' => 'required|min:6'
        ]);
        /*$existingUser = Kullanicilar::where('username', $request->username)->first();
        if ($existingUser) {
            return back();
        }
        $data = $request->only('username', 'user_title','password');
        $data['password']=Hash::make($data['password']);*/
        $validated['password'] = Hash::make($validated['password']);
        $islem = User::create($validated);
        if (!$islem) {
            return back()->withErrors('Kullanıcı adı veya şifre yanlış.');
        }
        return redirect()->route('main')->with('addUser', 'Kayıt İşlemi Başarılı. ');

    }

    function listUser()
    {
        $users = User::all();
        return view('listUser', compact('users'));
    }

    public function deleteSelectedUsers(Request $request)
    {
        $selectedUsers = $request->input('selectedUsers', []);
        // Soft delete işlemini yap
        User::whereIn('id', $selectedUsers)->delete();
        return redirect()->back()->with('success', 'Seçili kullanıcılar başarıyla silindi.');
    }

    public function editUser($id)
    {
        $user = User::withTrashed()->find($id);

        if ($user) {
            // Eğer kullanıcı bulunduysa, düzenleme formunu göster
            return view('editUser', compact('user'));
        } else {
            // Kullanıcı bulunamazsa hata mesajı göster veya başka bir işlem yap
            return redirect()->back()->with('error', 'Kullanıcı bulunamadı.');
        }
    }

    public function updateSelectedUser(Request $request, $id)
    {
        $rules = [
            'username' => ['required', 'string', 'unique:users,username,' . $id, 'max:255', 'regex:/^\S*$/'],
            'user_title' => ['required', 'string', 'max:255'],
            'password' => ['nullable', 'string', 'min:6', 'regex:/^(?!\s).*$/', 'regex:/^\S*$/'],
        ];

        $messages = [
            'username.required' => 'Kullanıcı adı alanı gereklidir.',
            'username.unique' => 'Bu kullanıcı adı zaten kullanılıyor.',
            'username.regex' => 'Kullanıcı adında boşluk bulunamaz.',
            'user_title.required' => 'Kullanıcı başlığı alanı gereklidir.',
            'password.min' => 'Şifre en az 6 karakter olmalıdır.',
            'password.regex' => 'Şifre boşluk içeremez.',
        ];

        $this->validate($request, $rules, $messages);

        $user = User::withTrashed()->find($id);

        if ($user) {
            $user->username = $request->input('username');
            $user->user_title = $request->input('user_title');

            $password = $request->input('password');
            if ($password) {
                $user->password = bcrypt($password);
            }

            $user->save();

            return redirect()->route('listUserPost')->with('success', 'Kullanıcı başarıyla düzenlendi.');
        } else {
            return redirect()->back()->with('error', 'Kullanıcı bulunamadı.');
        }
    }
}
