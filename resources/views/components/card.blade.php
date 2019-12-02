
<div class="card bg-white collapsed-card quizz {{implode(' ',array_map(function($item){return substr($item,1);},$quizz->tags()))}}">
    <div class="card-header">
        <h5 class="card-title">
            {{$quizz->titleWithoutHashtag()}}

        </h5>
        <div class="card-tools">
            @foreach($quizz->tags() as $tag)
                <span class="badge bg-green tagFilter" style="cursor: pointer">
                 {{$tag}}
                </span>
            @endforeach
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i></button>
        </div>
    </div>
    <div class="card-body" style="display: none;">
        <div style="display: inline-flex; width: 100%" >
            <div style="width: 90%; margin-right: 10px;">
                <p class="card-text">
                    {{$quizz->overview}}
                </p>
            </div>
            <div style="width: 10%;">
                <form action="/quizz/{{$quizz->id}}">
                    <button type="submit" class="btn btn-block btn-primary">LANCER</button>
                </form>
            </div>
        </div>
    </div>
</div>
