@extends('adminlte::page')

@section('title', 'Mes Quizz')

@section('content_header')
    <div style="display: inline-flex; width: 100%;">
        <div style="width: 90%;">
            <h1>Mes quizz</h1>
            <p>Retrouvez sur cette page tous les quizz que vous avez répondu</p>
        </div>
        <label class="btn btn-xs btn-primary" id="showAll" style="display: none; cursor: pointer;">Montrer tout</label>
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
        $('.tagFilter').click(function (e) {
            $('.quizz').hide();
            $('.'+e.target.innerHTML.trim().substr(1)).show()
            $('#showAll').show()
        })
        $('#showAll').click(function (e) {
            $('.quizz').show();
            $('#showAll').hide()
        })

        $(function() {
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 5000
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
