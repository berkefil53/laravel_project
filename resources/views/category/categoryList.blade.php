<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Kategori Listesi</title>
</head>
<body>
<table border="1px">
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
            <td>{{ $categories->status }}</td>
            <td><a href="{{route('editCategory',['id'=>$categories->id])}}">Düzenle</a></td>
        </tr>
    @endforeach
</table>
</body>
</html>