@extends('adminlte::page')

@section('title', 'Mes Amis')

@section('content_header')
    <div class="row">
        <div class="col-5">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Ajouter un ami</h3>
                </div>
                <form role="form">
                    <div class="card-body">
                        <div class="form-group">
                            <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Entrer un email">

                            <button type="submit" class="btn btn-primary">Ajouter</button>
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
                                <th>Prenom</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Update software</td>
                                <td>Update software</td>
                                <td>Update software</td>
                            </tr>
                            <tr>
                                <td>Update software</td>
                                <td>Update software</td>
                                <td>Update software</td>
                            </tr>
                            <tr>
                                <td>Update software</td>
                                <td>Update software</td>
                                <td>Update software</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>

@stop
