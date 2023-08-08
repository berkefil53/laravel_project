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
<form method="POST" action="{{route('saveAddProduct')}}" >
    @csrf
    <table border="1px">
        <tr><td>Ürün Adı</td><td><input type="text" name="productTitle"></td></tr>
        <tr><td>Kategori ID</td><td>
                <select name="productCategoryId" id="productCategoryId">
                    <option value="{{null}}"> </option>
                    @foreach ($categories as $category)
                        <option value="{{$category->id}}"> {{$category->id}} - {{$category->categoryTitle}} </option>
                    @endforeach
                </select></td></tr>
        <tr><td>Barkod</td><td><input type="text" name="barcode"></tr>
        <tr><td>Ürün Durumu</td><td><input type="radio" id="html" name="productStatus" value="1">
                  <label>Active</label>
                  <input type="radio" id="css" name="productStatus" value="0">
                  <label>İnactive</label></td></tr>
    <tr><td></td><td> <input type="submit" value="Ekle"></td></tr>
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
