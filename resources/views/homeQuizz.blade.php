@extends('adminlte::page')

@section('title', 'Quizz')

@section('content_header')
    <div class="row">
        <div class="col-md-10">
            <h1>Quizz</h1>
            <p>Trouvez un quizz qui vous intéresse !</p>
        </div>
    </div>
    @if(count($quizzs) > 0)
    <div class="row" style="padding:0 7px">
        <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="Ajoutez vos filtres: francais maths ..." id="searchFilter" style="border-radius: 0">
            <div class="input-group-append" id="btnDeleteFilter" style="display: none">
                <button type="button" class="btn btn-danger btn-flat"><i class="fas fa-trash"></i></button>
            </div>
        </div>
    </div>
    @endif
    @forelse($quizzs as $quizz)
        @include('components.card', ['quizz' => $quizz])
    @empty
        Bravo, vous avez fait tous les quizzs !
    @endforelse
@stop

@section('js')
    <script>
        var classes = [];
        @foreach($quizzs as $quizz)
            @foreach($quizz->tags() as $tag)
                classes.push('{{$tag}}'.substr(1))
            @endforeach
        @endforeach
        $('#searchFilter').on('input', function(e){
            var input = $(this);
            var val = input.val();
            changeFilter(val);
        });

        function changeFilter(val){
            var words = val.split(' ');
            if(words[0] === ""){
                $('.quizz').show();
                $('#showAll').hide()
                $('#btnDeleteFilter').hide()
            }else{
                $('.quizz').hide();
                $('#btnDeleteFilter').show()
                words.forEach(function(elem){
                    classes.forEach(function(classe){
                        if(classe.startsWith(elem)){
                            $('.'+classe).show()
                        }
                    });
                })
            }
        }

        $('#btnDeleteFilter').click(function(e){
            $('.quizz').show();
            $('#showAll').hide();
            $("#searchFilter").val('')
            $('#btnDeleteFilter').hide();
        })
        $('.tagFilter').click(function (e) {
            var tag = e.target.innerHTML.trim().substr(1);
            var inputText = $('#searchFilter').val();
            if(inputText !== ''){
                inputText += " ";
            }
            $('#searchFilter').val(inputText+tag);
            changeFilter(inputText+tag)
        })

        @if(session()->exists('first_connection'))
            @php(session()->remove('first_connection'))
            $("#modal-welcome").modal();
        @endif
    </script>
@endsection
