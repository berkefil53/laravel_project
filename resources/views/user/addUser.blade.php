<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<form method="POST" action="{{route('saveAddUser')}}">
    @csrf
    <table>
        <tr><td>Kullanıcı Adı</td><td>: <input type="text" name="username"/></td></tr>
        <tr><td>Adı</td><td>: <input type="text" name="user_title"/></td></tr>
        <tr><td>Şifre</td><td>: <input type="password" name="password"/></td></tr>
        <tr><td></td><td><input type="submit" name="ekle" value="ekle"/></td></tr>
    </table>
</form>
@if($errors)
    <p>{{$errors->first()}}</p>
@endif
</body>
</html>
