<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Kullanicilar;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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
        if(Auth::attempt(['username'=>$request->username, 'password'=>$request->password]))
        {
            return redirect()->route('main')->with('login','Giriş İşlemi Başarılı hoşgeldin ');
        }
            return redirect()->back()->with('login','fail');
    }

    public function logout()
    {
        auth()->logout();
        return redirect()->route('login')->with('login','Çıkış Başarıyla Gerçekleşti. ');
    }
    public function addUser(Request $request)
    {
            $validated=$request->validate([
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
           $validated['password']=Hash::make($validated['password']);
           $islem=Kullanicilar::create($validated);
           if (!$islem)
           {
               return back()->withErrors('e');
           }
           return redirect()->route('main')->with('addUser', 'Kayıt İşlemi Başarılı. ');

    }



}
