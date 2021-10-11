@extends('layouts.app',['title'=>'Догадки'])

@section('content')
    <div class="container">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <form method="post" action="{{route('make-input')}}">
                @csrf
                <label for="number">Введите загаданное число</label>
                <input type="text" name="number" id="number">
                <input type="submit" value="Загадал!">
                @if (isset($errors) && $errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </form>

            @isset($guesses)
                Догадки экстрасенсов:
                <table class="table">

                    @foreach($guesses as $guesse)
                        <tr>
                            <td>{{ $loop->iteration  }}</td>
                            <td>{{$guesse['gus']}}</td>
                        </tr>
                    @endforeach
                </table>
            @endisset

            @isset($input_history)
                История введенных пользователем чисел
                <table class="table">

                    @foreach($input_history as $item)
                        <tr>
                            <td>{{ $loop->iteration  }}</td>
                            <td>{{$item}}</td>
                        </tr>
                    @endforeach
                </table>
            @endisset

            @isset($guesses)
                Рейтинг экстрасенсов
                <table class="table">

                    <tbody>
                    @foreach($guesses as $result)
                        <tr>
                            <td>{{ $loop->iteration  }}</td>
                            <td>{{$result['psychologist']->name}}</td>
                            <td>{{$result['psychologist']->level}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

            @endisset
            <table class="table">
                <tbody>
                @isset($guesses_history)
                    История догадок экстрасенса
                    @foreach($guesses_history as $item)
                        <tr>
                            <td>{{ $loop->iteration  }}</td>
                            <td>{{ $item['name']  }}</td>
                            <td>{{ implode(',',$item['history'] ) }}</td>
                        </tr>
                    @endforeach
                @endisset
                </tbody>
            </table>
        </div>
    </div>
@endsection

