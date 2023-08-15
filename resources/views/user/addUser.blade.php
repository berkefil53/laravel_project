@extends('layouts.mainLayout')
@section('title')
    Kullanıcı Ekleme
@endsection
@section('content')
<form method="POST" action="{{route('saveAddUser')}}">
    @csrf
    Kullanıcı Adı:
    <p> <input class="form-control" type="text" name="username"/></p>
    Adı:
    <p> <input class="form-control" type="text" name="user_title"/></p>
    Şifre:
    <p><input class="form-control" type="password" name="password"/></p>
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
