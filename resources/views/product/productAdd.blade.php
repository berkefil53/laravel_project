@extends('layouts.mainLayout')
@section('title')
    Ürün Ekleme
@endsection
@section('content')
<form method="POST" action="{{route('saveAddProduct')}}" >
    @csrf
         Ürün Adı:
        <p> <input class="form-control" type="text" name="productTitle"/></p>
        Kategori:
    <p><select name="productCategoryId" id="productCategoryId" class="form-select">
            <option value="{{null}}"> </option>
            @foreach ($categories as $category)
                <option value="{{$category->id}}"> {{$category->id}} - {{$category->categoryTitle}} </option>
            @endforeach
        </select></p>
        Barkod:
        <p><input type="text" name="barcode" class="form-control"></p>
        Ürün Durumu:
        <p><input type="radio" id="html" name="productStatus" value="1" class="form-check-input">
              <label>Active</label>
              <input type="radio" id="css" name="productStatus" value="0">
              <label>İnactive</label></p>
        <input type="submit" value="Ekle" class="btn btn-success">
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
