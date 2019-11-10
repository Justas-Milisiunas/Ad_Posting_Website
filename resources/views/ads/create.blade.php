@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">
            <h1 class="card-text">Skelbimo kūrimas</h1>
        </div>
        <div class="card-body">
            {!! Form::open(['action' => 'AdsController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
            <div class="form-group">
                {{Form::label('name', 'Pavadinimas')}}
                {{Form::text('name', '', ['class' => 'form-control', 'placeholder' => 'Pavadinimas'])}}
            </div>
{{--            TODO: Fix image upload--}}
            <form class="form-group" enctype="multipart/form-data" method="post" action="/details">
                <label for="images">Nuotraukos</label><br>
                <input id="images" required type="file" name="images[]" placeholder="address" multiple>
            </form>
            <br>
            <div class="form-group">
                {{Form::label('description', 'Skelbimo aprasas')}}
                {{Form::textarea('description', '', ['class' => 'form-control', 'style' => 'min-height: 45px; max-height: 200px', 'placeholder' => 'Skelbimo aprasas'])}}
            </div>
            {{Form::submit('Sukurti', ['class' => 'btn btn-primary'])}}
            {!! Form::close() !!}
        </div>
    </div>
@stop
