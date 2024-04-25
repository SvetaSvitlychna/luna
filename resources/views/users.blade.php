<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>lflflf</h1>
    <?="hello php" ?>
    <?=time(); ?>
    {{time()}}
    <h2>{{$title}}</h2>
<ul>
<li><a href="/users">users</a></li>
<li><a href="{{url('about')}}">about</a></li>
<li><a href="{{url('cms')}}">admin cms</a></li>
<li><a href="{{route('admin.index')}}">admin index</a></li>
</body>
</body>
</html>