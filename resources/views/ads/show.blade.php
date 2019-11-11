@extends('layouts.app')

@section('content')
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="/ads">Skelbimai</a>
                </li>
                <li class="breadcrumb-item active">{{$ad->name}}</li>
            </ol>
        </nav>
        <div class="card">
            @isset($ad)
                <div class="card-header">
                    <div class="row">
                        <div class="col-sm-8">
                            <h3>{{$ad->name}}</h3>
                        </div>
                        <div class="col-sm-4 text-right">
                            <a href="/ads/{{$ad->id}}/edit" class="btn btn-outline-primary" style="margin-right: 5px">Redaguoti</a>
{{--                            <a href="/ads/{{$ad->id}}" class="btn btn-outline-danger">Šalinti</a>--}}
                            {!! Form::open(['action' => ['AdsController@destroy', $ad->id], 'method' => 'DELETE', 'class' => 'float-right']) !!}
                            	{!! Form::submit('Šalinti', ['class' => 'btn btn-outline-danger']) !!}
                            {!! Form::close() !!}
{{--                            {!! Form::open(['action' => ['AdsController@destroy', $post->id], 'method' => 'DELETE', 'class' => 'float-right']) !!}--}}
{{--                            --}}{{--            {{Form::hidden('_method', 'DELETE')}}--}}
{{--                            {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}--}}
{{--                            {!! Form::close() !!}--}}
                        </div>
                    </div>
                </div>
                <div class="card-body row">
                    <div class="col-sm-8">
                        @include('inc.images_carousel', ['images' => $ad->images])
                    </div>
                    <div class="col-sm-4">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">
                                <img src="/storage/images/price.png" style="width: 32px; margin-right: 5px">
                                <b>{{$ad-> price}}€</b>
                            </li>
                            <li class="list-group-item">
                                <img src="/storage/images/email.png" style="width: 32px; margin-right: 5px">
                                {{$ad->user->email}}
                            </li>
                            <li class="list-group-item">
                                <img src="/storage/images/phone.png" style="width: 32px; margin-right: 5px">
                                {{$ad->user->mobile_number}}
                            </li>
                            <li class="list-group-item">{{$ad->description}}</li>
                        </ul>
                    </div>
                </div>
                <div class="card-footer">
                    <small>Įkėlė <b>{{$ad->user->name}}</b> {{$ad->created_at}}</small>
                </div>

            @endisset
        </div>
        <div class="card" style="margin-top: 10px">
            <div class="card-body">
                <h5 class="card-title">Komentarai</h5>
                <hr>
                @foreach ($ad->comments as $comment)
                    <p class="card-text"><b>{{$comment->user->name}}</b> {{$comment->created_at}}</p>
                    <p class="card-text">{{$comment->message}}</p>
                    <hr>
                @endforeach
                {{--                TODO : Make comments writing functionality                --}}
                <div class="input-group">
                    <textarea class="form-control" aria-label="With textarea" placeholder="Jūsų komentaras"
                              style="min-height: 40px; max-height: 150px"></textarea>
                </div>
                <a href="#" style="margin-top: 15px" class="btn btn-primary">Komentuoti</a>
            </div>
        </div>
    </div>
@stop
