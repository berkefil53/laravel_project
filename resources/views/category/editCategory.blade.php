@extends('layouts.mainLayout')
@section('title')
    Kategori Düzenleme
@endsection
@section('content')
<form action="{{ route('update-selected-category', ['id' => $category->id]) }}" method="post">
    @csrf
        Kategori Adı:
        <p> <input class="form-control" type="text" name="categoryTitle"  value="{{ $category->categoryTitle }}" placeholder="Kategori Adı"></p>
        Kategori Açıklama:
        <p> <input class="form-control" type="text" name="categoryDescription" value="{{ $category->categoryDescription }}" placeholder="Kategori Açıklama"/></p>
        Statü:
        <p><input type="radio" id="html" name="status" value="1" {{ $category->status ? 'checked' : '' }} class="form-check-input">
            <label for="html"> Active </label>
            <input type="radio" id="css" name="status" value="0" {{ $category->status  ? '' : 'checked' }}>
            <label for="css"> Inactive </label></p>
            <p> <input class="btn btn-success" type="submit" name="ekle" value="Kategori Güncelle"/></p>
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
