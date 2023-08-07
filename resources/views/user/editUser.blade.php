<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Kullanıcı Düzenleme</title>
</head>
<body>
<form action="{{ route('update-selected-user', ['id' => $user->id]) }}" method="post">
    @csrf
    <table>
        <tr>
        <td>Kullanıcı Adı </td><td> :    <input type="text" name="username" value="{{ $user->username }}" placeholder="Kullanıcı Adı"></td>
        </tr>
        <tr>
            <td>Adı </td><td> :     <input type="text" name="user_title" value="{{ $user->user_title }}" placeholder="Adı"></td>
        </tr>
        <tr><td>Şifre</td><td> :    <input type="password" name="password" placeholder="Yeni Şifre"></td></tr>
        <tr><td></td><td>    <button type="submit">Kullanıcıyı Güncelle</button></td></tr>
    </table>
</form>
@if($errors->any())
    <div class="alert alert-danger">
        <h4>Hata!</h4>
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
</body>
</html>
