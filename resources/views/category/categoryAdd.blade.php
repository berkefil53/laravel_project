@extends('layouts.mainLayout')
@section('title')
    Kategori Ekleme
@endsection
@section('content')
<form method="POST" action="{{route('saveAddCategory')}}">
    @csrf
    Kategori Adı:
    <p> <input class="form-control" type="text" name="categoryTitle"/></p>
    Kategori Açıklaması:
    <p> <input class="form-control" type="text" name="categoryDescription"/></p>
    Statü: <br>
    <input type="radio" id="html" name="status" value="1" class="form-check-input">
      <label>Active</label>
      <input type="radio" id="css" name="status" value="0">
      <label>İnactive</label>
    <p> <input class="btn btn-success" type="submit" name="ekle" value="Ekle"/></p>
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
