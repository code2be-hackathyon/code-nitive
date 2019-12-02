@foreach($quizzs as $quizz)
<div class="card bg-white">
    <div class="card-header collapsed-card">
        <h5 class="card-title">{{$quizz->label}}</h5>
        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i></button>
        </div>
    </div>
    <div class="card-body" style="display: none;">
        <div style="display: inline-flex; width: 100%" >
            <div style="width: 90%">
                <p class="card-text">
                    {{$quizz->overview}}
                </p>
            </div>
            <div style="width: 10%">
                <button type="button" class="btn btn-block btn-primary ">LANCER</button>
            </div><C></C>
        </div>
    </div>
</div>
@endforeach
