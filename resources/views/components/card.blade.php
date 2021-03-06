
<div class="card bg-white collapsed-card quizz {{implode(' ',array_map(function($item){return substr($item,1);},$quizz->tags()))}}" style="box-shadow: 0px 6px 18px -9px rgba(0,0,0,0.75);border-radius: 0">
    <div class="card-header bg-blue" data-card-widget="collapse" style="cursor: pointer;background: white">
        <h5 class="card-title" style="font-size: 23px">
            {{$quizz->titleWithoutHashtag()}}
        </h5>
        <div class="card-tools" >
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
            <div class="col-sm-11 col-md-11">
                <p class="card-text">
                    {{$quizz->overview}}
                </p>
            </div>
            <div class="col-sm-1 col-md-1" style="text-align: right">
                <form action="/quizz/{{$quizz->id}}">
                    <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-play"></i></button>
                </form>
            </div>
        </div>
    </div>
</div>
