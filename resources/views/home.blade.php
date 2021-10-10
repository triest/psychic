@extends('layouts.app',['title'=>'Загадате число!'])

@section('content')
<div class="container">
    <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
        <form method="post" action="{{route('guess-number')}}">
            @csrf
            Пожалуста, загадайте число!

            <input type="submit" value="Загадал!">

        </form>
    </div>

</div>
@endsection
