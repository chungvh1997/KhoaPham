@extends('layout.app')
@section('login')
    <div class="container" >
        <h2>Sign Up</h2>
        
        @if ($errors->any())
            @foreach ($errors->all() as $err )
                <li>{{$err}}</li>
            @endforeach
        @endif
        
        <form  method="post" >
            @csrf
            <p>
                    <label for="username">username</label>
                    <input type="text" name="username" id="username" >
            </p>
            <p>
                    <label for="password">password</label>
                    <input type="password" name="password" id="password">
            </p>
            <p>
                    <label for="password">confirm-password</label>
                    <input type="password" name="confirm-password" id="confirm-password">
            </p>
            <p>
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" >
            </p>
            <p>
                    <label for="age">Age</label>
                    <input type="number" name="age" id="age">
            </p>
            <button type="submit">Login</button>
            
            
        </form>
    </div>
@endsection
