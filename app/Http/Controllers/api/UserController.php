<?php

namespace App\Http\Controllers\api;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Response;
use Validator;
class UserController extends Controller
{
    public function checkLogin(Request $request):Response
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|alpha_num',
            'password' => 'required|min:6',
        ]);
        if ($validator->fails()) {

            return Response(['message' => $validator->errors()], 401);
        } if(Auth::attempt($request->all())){

        $user = Auth::User();

        $success =  $user->createToken('MyApp')->plainTextToken;

        return Response(['token' => $success],200);
    }

        return Response(['message' => 'email or password wrong'],401);
    }

    public function logout():Response
    {
        $user = Auth::User();
        $user->currentAccessToken()->delete();

        return Response(['data' => 'User Logout successfully.'],200);
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

        return response()->json(['message' => 'Kayıt İşlemi Başarılı.'], 200);
    }


    function listUser()
    {
        $users = User::all();
        return $users;
    }

    public function deleteSelectedUsers(Request $request)
    {
        $selectedUsers = $request->input('selectedUsers', []);
        User::whereIn('id', $selectedUsers)->delete();
        return response()->json(['message' => 'Seçili Kullanıcılar Başarılı Şekilde Silindi.'], 200);
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
            return response()->json(['data'=>$user],200);
        } else {
            // Kullanıcı bulunamazsa hata mesajı göster veya başka bir işlem yap
            return response()->json(['message'=>'Kullanıcı bulunamadı.'],404);
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

            return response()->json(['message' => 'Kullanıcı başarıyla düzenlendi.'], 200);
        } else {
            return response()->json(['message' => 'Kullanıcı bulunamadı.'], 404);
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
        return response()->json(['message' => 'Kullanıcı başarıyla silindi.'], 200);
    }
}

