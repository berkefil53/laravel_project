@extends('layouts.mainLayout')
@section('title')
    Ürün Listeleme
@endsection
@section('content')
<table border="1px" class="table table-striped">
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
            <td><a href="{{route('editProduct',['id'=>$product->id])}}" class="btn btn-warning">Düzenle</a></td>
            <td><a onclick="return confirm('{{$product->productTitle}} Ürününü Silmek İstediğinden Emin Misin ?')" href="{{route('deleteProduct',['id'=>$product->id])}} " class="btn btn-danger">Sil</a></td>
        </tr>
    @endforeach
</table>
@endsection
