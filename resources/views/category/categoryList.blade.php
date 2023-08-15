@extends('layouts.mainLayout')
@section('title')
    Kategori Listeleme
@endsection
@section('content')

    <table class="table table-striped">
        <thead align="center">
        <td>Kategori Adı</td>
        <td>Kategori Açıklama</td>
        <td>Statü</td>
        <td></td>
        <td></td>
        </thead>
        @foreach($category as $categories)
            <tr>
                <td>{{ $categories->categoryTitle }}</td>
                <td>{{ $categories->categoryDescription }}</td>
                @if($categories->status)
                    <td>Aktif</td>
                @else
                    <td>İnaktif</td>

                @endif
                <td><a href="{{route('editCategory',['id'=>$categories->id])}} " class="btn btn-warning">Düzenle</a></td>
                <td><a onclick="return confirm('{{$categories->categoryTitle}} Kategorisini Silmek İstediğinden Emin Misin ?')" href="{{route('deleteCategory',['id'=>$categories->id])}} " class="btn btn-danger">Sil</a></td>
            </tr>
        @endforeach
    </table>
@endsection
