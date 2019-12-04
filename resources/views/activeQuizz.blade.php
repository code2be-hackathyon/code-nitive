@extends('adminlte::page')

@section('title', 'Mes Quizz')

@section('content_header')
    <div class="row">
        <div class="col-md-10">
            <h1>Quizz</h1>
            <p>Retrouvez sur cette page tous les quizz que vous avez répondu</p>
        </div>
    </div>
    <div class="row" style="padding:0 7px">
        <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="Ajoutez vos filtres: francais maths ..." id="searchFilter" style="border-radius: 0">
            <div class="input-group-append" id="btnDeleteFilter" style="display: none">
                <button type="button" class="btn btn-danger btn-flat"><i class="fas fa-trash"></i></button>
            </div>
        </div>
    </div>
    @foreach($quizzs as $quizz)
        @include('components.card_custom', ['quizz' => $quizz['quizz'], 'iterations' => $quizz['iterations'], 'nbIterations' => $quizz['nbIterations'], 'user_quizz' => $quizz['user_quizz']])
    @endforeach
@stop
@if(isset($modalClass))
    <button type="button" id="modal-trigger" style="display: none" class="{{$modalClass}}"></button>
@endif


@section('js')
    <script>
        var classes = [];
        @foreach($quizzs as $quizz)
            @foreach($quizz['quizz']->tags() as $tag)
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
    </script>
    <script>
        $(function() {
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 10000
            });
            $('.swalDefaultSuccess').click(function() {
                Toast.fire({
                    type: 'success',
                    title: 'Quizz validé. Félicitations !'
                })
            });
            $('.swalDefaultError').click(function() {
                Toast.fire({
                    type: 'error',
                    title: 'Votre résultat ne permet pas de valider ce quizz. N\'hésitez pas à demander conseil auprès de vos amis.'
                })
            });
        });

        jQuery(function(){
            jQuery('#modal-trigger').click();
        });
    </script>
@endsection
