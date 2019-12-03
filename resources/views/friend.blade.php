@extends('adminlte::page')

@section('title', 'Mes Amis')

@section('content_header')
    <div class="row">
        <div class="col-5">
            <div class="card" >
                <div class="card-header">
                    <h3 class="card-title">Ajouter un ami</h3>
                </div>
                <form role="form" method="post" action="{{@route('addFriend')}}">
                    {{csrf_field()}}
                    <div class="card-body">
                        <div class="form-group" style="display: grid; grid-template-columns: repeat(6, 1fr); grid-gap: 10px;">
                            <div style="grid-column: 1/6; grid-row: 1;">
                                <input type="email" class="form-control" name="email" placeholder="Entrer l'email d'un ami">
                            </div>
                            <div style="grid-column: 6/6; grid-row: 1">
                                <button type="submit" class="btn btn-block btn-outline-primary"><i class="fas fa-user-plus"></i></button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Demandes d'amis en attentes</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body p-0">
                    <table class="table">
                        <tbody>
                            @foreach($askFriends as $askFriend)
                                <tr>
                                    <td>{{$askFriend->sender()->email}}</td>
                                    <td class="project-actions text-right" style="align-items: center">
                                        <form role="form" method="post" action="{{@route('responseFriendAsk')}}">
                                            {{csrf_field()}}
                                            <input type="hidden" name="relationship_id" value="{{$askFriend->id}}">
                                            <button name="accept" class="btn btn-success btn-sm" >
                                                <i class="fas fa-check">
                                                </i>
                                            </button>
                                            <button name="decline" class="btn btn-danger btn-sm" >
                                                <i class="fas fa-trash">
                                                </i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-7">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Amis</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body p-0">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Adresse email</th>
                                <th>Nom</th>
                                <th>Prénom</th>
                                <th>Statut</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($friends as $friend)
                            @if($friend->sender()->id == \Illuminate\Support\Facades\Auth::user()->id)
                            <tr>
                                <td>{{$friend->receiver()->email}}</td>
                                <td>{{$friend->receiver()->firstname}}</td>
                                <td>{{$friend->receiver()->lastname}}</td>
                                <td>@if($friend->confirm == 1)
                                        <span class="badge badge-success">Amis</span>
                                    @else
                                        <span class="badge badge-warning">En attente</span>
                                    @endif
                                </td>
                            </tr>
                            @endif
                            @if($friend->receiver()->id == \Illuminate\Support\Facades\Auth::user()->id)
                                <tr>
                                    <td>{{$friend->sender()->email}}</td>
                                    <td>{{$friend->sender()->firstname}}</td>
                                    <td>{{$friend->sender()->lastname}}</td>
                                    <td>{{$friend->confirm}}</td>
                                </tr>
                            @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>

@stop
