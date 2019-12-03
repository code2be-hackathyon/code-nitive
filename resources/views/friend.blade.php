@extends('adminlte::page')

@section('title', 'Mes Amis')

@section('content_header')
    <div class="row">
        <div class="col-5">
            <div class="card" >
                <div class="card-header">
                    <h3 class="card-title">Ajouter un ami</h3>
                </div>
                <form role="form">
                    <div class="card-body">
                        <div class="form-group" style="display: grid; grid-template-columns: repeat(3, 1fr); grid-gap: 10px;">
                            <div style="grid-column: 1/3; grid-row: 1;">
                                <input type="email" class="form-control" id="addFriendByEmail" placeholder="Entrer l'email d'un ami">
                            </div>
                            <div style="grid-column: 3/3; grid-row: 1">
                                <button type="submit" class="btn btn-block btn-outline-primary">Ajouter</button>
                            </div>
                        </div>
                    </div>
                </form>
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
                            </tr>
                        </thead>
                        <tbody>
{{--                        @foreach($friends as $friend)--}}
{{--                            <tr>--}}
{{--                                <td>{{$friend->email}}</td>--}}
{{--                                <td>{{$friend->firstname}}</td>--}}
{{--                                <td>{{$friend->lastname}}</td>--}}
{{--                            </tr>--}}
{{--                            @endforeach--}}
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
    <div class="row">
        <div class="col-5">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Demandes d'amis en attentes</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body p-0">
                    <table class="table">
                        <tbody>
                            <tr>
                                <td>test@test</td>
                                <td class="project-actions text-right" style="align-items: center">
                                    <a class="btn btn-success btn-sm" href="#">
                                        <i class="fas fa-check">
                                        </i>
                                    </a>
                                    <a class="btn btn-danger btn-sm" href="#">
                                        <i class="fas fa-trash">
                                        </i>
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@stop
