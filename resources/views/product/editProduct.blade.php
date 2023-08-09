<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ürün Düzenleme</title>
</head>
<body>
<form action="{{ route('update-selected-product', ['id' => $products->id]) }}" method="post">
    @csrf
    <table>
        <tr>
            <td>Ürün Adı </td><td> :    <input type="text" name="productTitle" value="{{ $products->productTitle }}" placeholder="Ürün Adı"></td>
        </tr>
        <tr>
            <td>Kategori</td>
            <td> :
            <select name="productCategoryId" id="productCategoryId">
                <option value="{{null}}"> </option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ $category->id == $products->productCategoryId ? 'selected' : '' }}>
                        {{ $category->id }} - {{ $category->categoryTitle }}
                    </option>                @endforeach
            </select>
            </td>
        </tr>
        <tr>
        <td>Barkod</td><td> :<input type="text" name="barcode" value="{{ $products->barcode}}"></td>
        <tr><td>Statü</td><td>: <input type="radio" id="html" name="productStatus" value="1" {{ $products->productStatus ? 'checked' : '' }}>
                <label for="html"> Active </label>
                <input type="radio" id="css" name="productStatus" value="0" {{ $products->productStatus  ? '' : 'checked' }}>
                <label for="css"> Inactive </label></td>
            <td>
                <button type="submit">Ürün Güncelle</button></td></tr>
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
