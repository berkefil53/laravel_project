@extends('layouts.mainLayout')
@section('title')
    Kullanıcılar Listesi
@endsection
@section('content')
<form method="POST" action="{{ route('deleteSelectedUsers') }}">
    @csrf
    <table border="1px" class="table table-striped">
        <thead align="center">
        <td></td>
        <td>Kullanıcı Adı</td>
        <td>Adı</td>
        <td></td>
        <td></td>
        </thead>
        @foreach($users as $user)
            <tr>
                <td><input type="checkbox" class="form-check-input" name="selectedUsers[]" value="{{ $user->id }}"/></td>
                <td>{{ $user->username }}</td>
                <td>{{ $user->user_title }}</td>
                <td><a href="{{route('editUser',['id'=>$user->id])}}" class="btn btn-warning">Düzenle</a></td>
                <td><a  href="{{route('deleteUser',['id'=>$user->id])}}" class="btn btn-danger">Sil</a></td>
            </tr>
        @endforeach
        <tr align="center"><td colspan="5"><input type="submit" value="Tümünü Sil" class="btn btn-danger"/></td></tr>
    </table>
</form>
@endsection
