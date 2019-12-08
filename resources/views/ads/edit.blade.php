@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">
            <h1 class="card-text">Skelbimo redagavimas</h1>
        </div>
        <div class="card-body">
            {!! Form::open(['action' => ['AdsController@update', $ad->id], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
            <div class="form-group">
                {{Form::label('name', 'Pavadinimas')}}
                {{Form::text('name', $ad->name, ['class' => 'form-control', 'placeholder' => 'Pavadinimas'])}}
            </div>
            <div class="form-group">
                {{Form::label('price', 'Kaina')}}
                {{Form::number('price', $ad->price, ['class' => 'form-control', 'placeholder' => 'Kaina', 'min' => '1'])}}
            </div>
            <div class="form-group">
                {{Form::label('expiration', 'Pasibaigimo data')}}
                {{Form::date('expiration', $ad->expiration, ['class' => 'form-control', 'placeholder' => 'Pasibaigimo data', 'min' => date('Y-m-d', strtotime('+1 days'))])}}
            </div>
            <div class="form-group">
                {{Form::label('description', 'Skelbimo aprasas')}}
                {{Form::textarea('description', $ad->description, ['class' => 'form-control', 'style' => 'min-height: 45px; max-height: 200px', 'placeholder' => 'Skelbimo aprasas'])}}
            </div>
            {{Form::submit('Atnaujinti', ['class' => 'btn btn-primary'])}}
            {!! Form::close() !!}
        </div>
    </div>
@stop
