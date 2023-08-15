<?php

namespace App\Http\Controllers;
use Illuminate\Validation\Rule;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use illuminate\Database\Eloquent\SoftDeletes;
class UserController extends Controller
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
        $rules = [
            'username' => 'required|alpha_num',
            'password' => 'required|min:6',
        ];

        $messages = [
            'username.required' => 'Kullanıcı Adı Boş Bırakılamaz.',
            'username.alpha_num' => 'Kullanıcı Adında Özel Karakterler Kullanılamaz.',
            'password.required' => 'Şifre Boş Bırakılamaz.',
            'password.min' => 'Şifre Minimum 6 Karakterden Oluşmalıdır.',
        ];
        $this->validate($request, $rules, $messages);
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

        $rules = [
            'username' => [
                'required',
                'alpha_num',
                Rule::unique('users')->where(function ($query) {
                    return $query->whereNull('deleted_at');
                }),
            ],
            'user_title' => 'required',
            'password' => 'required|min:6',
        ];
        $messages = [
            'username.required' => 'Kullanıcı Adı Boş Bırakılamaz.',
            'username.alpha_num' => 'Kullanıcı Adında Özel Karakterler Kullanılamaz.',
            'username.unique'=>'Bu Kullanıcı Adı Kullanılıyor.',
            'user_title.required'=>'Ad Boş Bırakılamaz',
            'password.required' => 'Şifre Boş Bırakılamaz.',
            'password.min' => 'Şifre Minimum 6 Karakterden Oluşmalıdır.',
        ];

        $validated = $this->validate($request, $rules, $messages);
        $validated['password'] = Hash::make($validated['password']);
        $islem = User::create($validated);

        return redirect()->route('main')->with('addUser', 'Kayıt İşlemi Başarılı. ');
    }


    function listUser()
    {
        $users = User::all();
        return view('user/listUser', compact('users'));
    }

    public function deleteSelectedUsers(Request $request)
    {
        $selectedUsers = $request->input('selectedUsers', []);
        User::whereIn('id', $selectedUsers)->delete();
        return redirect()->back()->with('success', 'Seçili kullanıcılar başarıyla silindi.');
    }
    /*
    public function deleteSelectedUsers(Request $request)
    {
        $selectedUsers = $request->input('selectedUsers', []);

        foreach ($selectedUsers as $userId) {
            $this->deleteUser($userId);
        }
        return redirect()->back()->with('success', 'Seçili kullanıcılar başarıyla silindi.');
    }*/
    public function editUser($id)
    {
        $user = User::withTrashed()->find($id);

        if ($user) {
            // Eğer kullanıcı bulunduysa, düzenleme formunu göster
            return view('user/editUser', compact('user'));
        } else {
            // Kullanıcı bulunamazsa hata mesajı göster veya başka bir işlem yap
            return redirect()->back()->with('error', 'Kullanıcı bulunamadı.');
        }
    }

    public function updateSelectedUser(Request $request, $id)
    {
        $user = User::withTrashed()->find($id);
        $currentUsername = $user->username;
        $rules = [
            'username' => ['required', 'string', 'max:255', 'regex:/^\S*$/'],
            'user_title' => ['required', 'string', 'max:255'],
            'password' => ['nullable', 'string', 'min:6', 'regex:/^(?!\s).*$/', 'regex:/^\S*$/'],
        ];
        if ($request->input('username') !== $currentUsername) {
            $rules['username'] = [
                'required', 'string', 'max:255', 'regex:/^\S*$/',
                Rule::unique('users')->where(function ($query) {
                    return $query->whereNull('deleted_at');
                }),
            ];
        }
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
    /*
    public function deleteUser(int $id)
    {
        $user = User::find($id);
        if ($user) {
            $user->username = "delete_".$id."_". $user->username;
            $user->save();
            $user->delete();
    return redirect()->route('listUserPost');
        }}*/
    public function deleteUser(int $id)
    {
        User::where('id',$id)->delete();
        return redirect()->route('listUserPost');
    }
}

