<!DOCTYPE html>
<html>
<head>

    <title>Laravel</title>

</head>
<body>
<h1>Hello</h1>

<ul>
    @foreach ($padlets as $padlet)
        <li><a href="padlets/{{$padlet->id}}">
                {{$padlet->name}}</a></li>
    @endforeach
</ul>
</body>
</html>
