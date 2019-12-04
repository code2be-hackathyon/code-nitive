
<div class="card bg-white collapsed-card quizz {{implode(' ',array_map(function($item){return substr($item,1);},$quizz->tags()))}}" style="box-shadow: 0px 6px 18px -9px rgba(0,0,0,0.75);border-radius: 5px">
    <div class="card-header"   data-card-widget="collapse" style="cursor: pointer;background: white">
        <h5 class="card-title" style="font-size: 23px">
                @if($nbIterations >= 4)
                    <i class="fas fa-check" style="margin-right: 7px;color:#27ae60"></i>
                @else
                    @if($user_quizz->note >= $quizz->validationNote)
                        <i class="far fa-grin-stars" style="margin-right: 7px;color:#27ae60"></i>
                    @elseif($user_quizz->note >= $quizz->limitNote)
                        <i class="far fa-meh-rolling-eyes" style="margin-right: 7px;color:#d35400"></i>
                    @else
                        <i class="far fa-sad-tear" style="margin-right: 7px; color:#e74c3c" ></i>
                    @endif
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
            <div class="col-md-9">
                <p class="card-text">
                    {{$quizz->overview}}
                </p>
            </div>
            <div class="col-md-3" style="text-align: right">
                @if(!empty($friends_quizzs))
                    <button class="btn btn-default btn-sm" data-toggle="modal" data-target="#modal-friends"><i class="fas fa-users"></i></button>
                @endif
                <form action="/quizz/{{$quizz->id}}">
                    @if($user_quizz->note <= $quizz->limitNote OR session()->get('first_iteration'))
                        @php(session()->remove('first_iteration'))
                        <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-play"></i></button>
                    @endif
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modal-friends">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Amis ayant participés</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body p-0">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Prénom</th>
                            <th>Appréciation</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($friends_quizzs as $friend)
                            @if($friend[0]['nbIterations'] > 0)
                                <tr>
                                <td>{{$friend[0]['user_quizz']->user->firstname}}</td>
                                <td>{{$friend[0]['user_quizz']->user->lastname}}</td>
                                @if($friend[0]['iterations'][$friend[0]['nbIterations']-1]->note >= $friend[0]['user_quizz']->validationNote)
                                    <td><i class="far fa-grin-stars" style="margin-right: 7px;color:#27ae60"></i></td>
                                @elseif($friend[0]['iterations'][$friend[0]['nbIterations']-1]->note >= $friend[0]['user_quizz']->limitNote)
                                    <td><i class="far fa-meh-rolling-eyes" style="margin-right: 7px;color:#d35400"></i></td>
                                @else
                                    <td><i class="far fa-sad-tear" style="margin-right: 7px; color:#e74c3c" ></i></td>
                                @endif
                            </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
