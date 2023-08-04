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
<form method="POST" action="{{ route('deleteSelectedUsers') }}">
    @csrf
    <table border="1px">
        <thead align="center">
            <td></td>
            <td>Kullanıcı Adı</td>
            <td>Adı</td>
            <td></td>
            <td></td>
        </thead>

        @foreach($users as $user)
            <tr>
                <td><input type="checkbox" name="selectedUsers[]" value="{{ $user->id }}"/></td>
                <td>{{ $user->username }}</td>
                <td>{{ $user->user_title }}</td>
                <td><input type="submit" name="editUser" value="Düzenle"/> </td>
                <td><input type="submit" name="deleteUser" value="Sil"/> </td>
            </tr>
        @endforeach
        <tr align="center"><td colspan="5"><input type="submit" value="Tümünü Sil"/></td></tr>
    </table>
</form>
</body>
</html>
