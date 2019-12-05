@extends('adminlte::page')

@section('title', 'Questions')

@section('content_header')
    <div class="row">
        <div class="col-md-10">
            <h1>{{$quizz->titleWithoutHashtag()}}</h1>
            <p>{{$quizz->overview}}</p>
        </div>
    </div>
    <form role="form" method="POST" action="{{@route('validateResponses',['id'=>$quizz->id])}}">
        {{csrf_field()}}
    @foreach($questions as $question)
            @include('components.question',['question'=>$question,'errors'=>session()->get('errors_quizz')])
        @endforeach
        @php(session()->remove('errors_quizz'))
            <button class="btn btn-primary" type="submit">VALIDER</button>
        </form>
@stop
