@extends('adminlte::page')

@section('title', 'Quizz')

@section('content_header')
    <h1>Quizz</h1>

    @include('components.card', ['quizzs' => $quizzs])
@stop

