<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
@auth
    <p align="right">
    <a href="{{route('logout')}}">Çıkış</a>
    </p>
@endauth
<form method="POST" action="{{route('addUser')}}">
    @csrf
    <input type="submit" name="addUser" value="Kullanıcı Ekle"/>
</form>
<form method="POST" action="{{route('listUserPost')}}">
    @csrf
    <input type="submit" name="listUser" value="Kullanıcı Listele"/>
</form>
</body>
</html>
