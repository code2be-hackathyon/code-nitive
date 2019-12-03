
<div class="card bg-white collapsed-card quizz {{implode(' ',array_map(function($item){return substr($item,1);},$quizz->tags()))}}" style="box-shadow: 0px 6px 18px -9px rgba(0,0,0,0.75);border-radius: 0">
    <div class="card-header"   data-card-widget="collapse" style="cursor: pointer;background: white">
        <h5 class="card-title">
                @if($user_quizz->note >= $quizz->validationNote)
                    <i class="far fa-grin-stars" style="margin-right: 7px;color:#27ae60"></i>
                @elseif($user_quizz->note >= $quizz->limitNote)
                    <i class="far fa-meh" style="margin-right: 7px;color:#d35400"></i>
                @else
                    <i class="far fa-frown" style="margin-right: 7px; color:#e74c3c" ></i>
                @endif
            {{$quizz->titleWithoutHashtag()}}
        </h5>
        <div class="card-tools">
            @foreach($quizz->tags() as $tag)
                <span class="badge bg-green tagFilter" style="cursor: pointer">
                 {{$tag}}
                </span>
            @endforeach
                <button type="button" class="btn btn-tool"><i class="fas fa-plus"></i></button>
        </div>
    </div>
    <div class="card-body" style="display: none;">
        <div class="row">
            <div class="col-10">
                <p class="card-text">
                    {{$quizz->overview}}
                </p>
            </div>
            <div class="col-2" style="text-align: right">
                <form action="/quizz/{{$quizz->id}}">
                    @if($user_quizz->note <= $quizz->limitNote)
                    <button type="submit" class="btn btn-primary btn-sm">Commencer <i class="fas fa-chevron-right" style="margin-left: 5px"></i></button>
                    @endif
                </form>
            </div>
        </div>
    </div>
</div>
