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
<form method="POST" action="{{route('saveAddCategory')}}">
    @csrf
<table border="1px">
    <tr><td>Kategori Adı</td><td><input type="text" name="categoryTitle"></td></tr>
    <tr><td>Kategori Açıklaması</td><td><input type="text" name="categoryDescription"></td></tr>
    <tr><td>Statü</td><td>
            <input type="radio" id="html" name="status" value="1">
              <label>Active</label>
              <input type="radio" id="css" name="status" value="0">
              <label>İnactive</label></td></tr>
</table>
<input type="submit" value="Ekle">
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
