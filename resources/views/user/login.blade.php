@extends('layouts.loginLayout')
@guest
@else
    <script> window.location.href = "{{ route('main') }}";</script>
@endguest
@section('error')
@if(session()->has('login')&&session('login')=='fail')
    Login İşlemi Başarısız.
@endif
@endsection
