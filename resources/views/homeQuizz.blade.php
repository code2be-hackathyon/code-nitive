@extends('adminlte::page')

@section('title', 'Quizz')

@section('content_header')
    <div class="row">
        <div class="col-md-10">
            <h1>Quizz</h1>
            <p>Trouvez un quizz qui vous intéresse !</p>
        </div>
        <div class="col-md-2" style="text-align: right">
            <button class="btn btn-outline-dark btn-sm" id="showAll" style="display: none; cursor: pointer;"><i class="far fa-eye" style="padding-right: 5px"></i>Montrer tout</button>
        </div>
    </div>
        <div class="card">
            <div class="card-header border-0">
                <div class="d-flex justify-content-between">
                    <h3 class="card-title">Filtres de recherche</h3>
                </div>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label for="exampleInputEmail1">Ajoutez vos #...</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" placeholder="#français #maths #...">
                </div>
            </div>
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
