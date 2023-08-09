<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ürünler Listesi</title>
</head>
<body>
<table border="1px">
    <thead align="center">
    <td>Ürün Adı</td>
    <td>Ürün Kategorisi</td>
    <td>Barkod</td>
    <td>Ürün Durumu</td>
    <td></td>
    <td></td>
    </thead>
    @foreach($products as $product)
        <tr>
            <td>{{ $product->productTitle}}</td>
                @foreach($categories as $category)
                    @if($category->id==$product->productCategoryId)
                    <td>{{$category->categoryTitle}}</td>
                    @else
                    @endif

                @endforeach
                @if($product->productCategoryId==null)
                    <td></td>
                @endif
            <td>{{ $product->barcode}}</td>
            @if($product->productStatus)
                <td>Aktif</td>
            @else
                <td>İnaktif</td>
            @endif
            <td><a href="{{route('editProduct',['id'=>$product->id])}}">Düzenle</a></td>
            <td><a onclick="return confirm('{{$product->productTitle}} Ürününü Silmek İstediğinden Emin Misin ?')" href="{{route('deleteProduct',['id'=>$product->id])}} ">Sil</a></td>
        </tr>
    @endforeach
</table>
</body>
</html>
