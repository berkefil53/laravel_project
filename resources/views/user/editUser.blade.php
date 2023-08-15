@extends('layouts.mainLayout')
@section('title')
    Kullanıcı Düzenleme
@endsection
@section('content')
<form action="{{ route('update-selected-user', ['id' => $user->id]) }}" method="post">
    @csrf
    Kullanıcı Adı:
    <p> <input class="form-control" type="text" name="username" value="{{ $user->username }}" placeholder="Kullanıcı Adı"></p>
    Adı:
    <p> <input class="form-control" type="text" name="user_title" value="{{ $user->user_title }}" placeholder="Adı"/></p>
    Şifre:
    <p><input class="form-control" type="password" name="password" placeholder="Yeni Şifre"/></p>
    <p> <input class="btn btn-success" type="submit" name="ekle" value="Kullanıcıyı Güncelle"/></p>

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
