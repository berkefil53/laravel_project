<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kullanicilar;
use Illuminate\Support\Facades\Auth;
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




}
