<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
@auth
    <p align="right">
    <a href="{{route('logout')}}">Çıkış</a>
    </p>
@endauth
@guest
    <script> window.location.href = "{{ route('main') }}";</script>

@else
    <form method="POST" action="{{route('addUser')}}">
        @csrf
        <input type="submit" name="addUser" value="Kullanıcı Ekle"/>
    </form>
    <form method="POST" action="{{route('listUserPost')}}">
        @csrf
        <input type="submit" name="listUser" value="Kullanıcı Listele"/>
    </form>
    <form method="POST" action="{{route('categoryAddPost')}}">
        @csrf
        <input type="submit" name="categoryAdd" value="Kategori Ekle"/>
    </form>
    <form method="POST" action="{{route('categoryListPost')}}">
        @csrf
        <input type="submit" name="categoryList" value="Kategori Listele"/>
    </form>
    <form method="POST" action="{{route('productAddPost')}}">
        @csrf
        <input type="submit" name="productList" value="Ürün Ekle"/>
    </form>
@endguest
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
</body>
</html>
