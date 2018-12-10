<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    @if(Session::has('error'))
        <div>{{Session::get('error')}}</div>
    @endif
    @if(session('error'))
        <div>{{session('error')}}</div>
    @endif
<form action="{{ route('uploadfile')}}" method="post" enctype="multipart/form-data">
        @csrf
        <input type="file" name="myFile" id="myFile">
        <input type="submit" value="Send">
    </form>
</body>
</html>