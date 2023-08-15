@extends('layouts.mainLayout')
@section('title')
    Ürün Düzenleme
@endsection
@section('content')
<form action="{{ route('update-selected-product', ['id' => $products->id]) }}" method="post">
    @csrf
        Ürün Adı:
        <p> <input class="form-control" type="text" name="productTitle" value="{{ $products->productTitle }}" placeholder="Ürün Adı"/></p>
        Kategori:
        <p><select name="productCategoryId" id="productCategoryId" class="form-select">
                <option value="{{null}}"> </option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ $category->id == $products->productCategoryId ? 'selected' : '' }}>
                        {{ $category->id }} - {{ $category->categoryTitle }}
                    </option>                @endforeach
            </select></p>
        Barkod:
        <p><input type="text" name="barcode" value="{{ $products->barcode}}" class="form-control"></p>
        Statü:
        <p><input type="radio" id="html" name="productStatus" value="1" {{ $products->productStatus ? 'checked' : '' }} class="form-check-input">
            <label for="html"> Active </label>
            <input type="radio" id="css" name="productStatus" value="0" {{ $products->productStatus  ? '' : 'checked' }}>
            <label for="css"> Inactive </label></p>
        <input type="submit" value="Güncelle" class="btn btn-success">

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
@endsection
