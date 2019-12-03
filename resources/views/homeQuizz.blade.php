@extends('adminlte::page')

@section('title', 'Quizz')

@section('content_header')


    <div style="display: inline-flex; width: 100%;">
        <div style="width: 90%;">
            <h1>Quizz</h1>
            <p>Trouvez un quizz qui vous intéresse !</p>
        </div>
        <label class="btn btn-xs btn-primary" id="showAll" style="display: none; cursor: pointer;">Montrer tout</label>
    </div>
    @foreach($quizzs as $quizz)
        @include('components.card', ['quizz' => $quizz])
    @endforeach
@stop

@section('js')
    <script>
        $('.tagFilter').click(function (e) {
            $('.quizz').hide();
            $('.'+e.target.innerHTML.trim().substr(1)).show()
            $('#showAll').show()
        })
        $('#showAll').click(function (e) {
            $('.quizz').show();
            $('#showAll').hide()
        })
    </script>
@endsection
