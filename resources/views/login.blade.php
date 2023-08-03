<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>1 Belge</title>
</head>

<body>

@if(session()->has('login')&&session('login')=='fail')
    Login İşlemi Başarısız.
@endif
@guest
    <form method="POST" action="{{route('loginPost')}}">
        @csrf
        <table>
            <tr>
                <td>Kullanıcı Adı : </td><td><input type="text" name="username"></td>
            </tr>

            <tr>
                <td>Şifre : </td><td>    <input type="password" name="password"></td>
            </tr>
            <td></td><td><input type="submit" value="Giriş" name="login"></td>
        </table>
    </form>
@endguest
</body>
</html>
