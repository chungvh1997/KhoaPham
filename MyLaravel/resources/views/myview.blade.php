<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>Thực Chó</h1>
    <?php  echo $tenkhoahoc; ?>
    <br>
    {{--command--}}
    {{$MonHoc}}
    @for($i=1;$i<=5;$i++)
        <p>{{$i}} </p>
    @endfor
</body>
</html>
