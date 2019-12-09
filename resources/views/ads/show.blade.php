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
                            @if (Auth::check() && Auth::user()->role == 1 && Auth::user()->id == $ad->user->id)
                                <a href="/ads/{{$ad->id}}/edit" class="btn btn-outline-primary"
                                   style="margin-right: 5px">Redaguoti</a>
                            @endif
                            @if (Auth::check() && Auth::user()->role == 3)
                                {!! Form::open(['action' => ['AdsController@destroy', $ad->id], 'method' => 'DELETE', 'class' => 'float-right']) !!}
                                {!! Form::submit('Šalinti', ['class' => 'btn btn-outline-danger']) !!}
                                {!! Form::close() !!}
                            @endif
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
                    <small>Peržiūros: <b>{{$ad->views}}</b> Įkėlė <b>{{$ad->user->name}}</b> {{$ad->created_at}}</small>
                </div>

            @endisset
        </div>
        <div class="card" style="margin-top: 10px">
            <div class="card-body">
                <h5 class="card-title">Komentarai</h5>
                <hr>
                @if (isset($ad->comments))
                    @foreach ($ad->comments as $comment)
                        @if ($comment->comment_id == null)
                            <p class="card-text"><b>{{$comment->user->name}}</b> {{$comment->created_at}}</p>
                            <p class="card-text">{{$comment->message}}</p>
                            <hr>
                            <div class="ml-5">
                                @foreach ($comment->replies as $key=>$reply)
                                    <p class="card-text"><b>{{$reply->user->name}}</b> {{$comment->created_at}}</p>
                                    <p class="card-text">{{$reply->message}}</p>
                                    @if ($key != count($comment->replies) - 1)
                                        <hr>
                                    @endif
                                @endforeach
                            </div>
                            @if (count($comment->replies) > 0)
                                <hr>
                            @endif
                        @endif
                    @endforeach
                @endif
                {{--                If user's role is user. Display comment writing form--}}
                @if (Auth::check() && Auth::user()->role == 1)
                    {!! Form::open(['action' => ['CommentsController@store', $ad->id], 'method' => 'POST']) !!}
                    @if (Auth::user()->id == $ad->user_id && count($comments) >= 1)
                        <div class="input-group">
                            {!! Form::select('selected_comment', $comments, null, ['class' => 'form-control']) !!}
                        </div>
                    @endif
                    <div class="input-group" style="margin-top: 15px">
                        {!! Form::textarea('comment', '', ['class' => 'form-control', 'placeholder' => 'Jūsų komentaras', 'style' => 'min-height: 40px; max-height: 150px']) !!}
                    </div>
                    {!! Form::submit('Komentuoti', ['class' => 'btn btn-primary', 'style' => 'margin-top: 15px']) !!}
                    {!! Form::close() !!}
                @elseif(Auth::check() && Auth::user()->role != 1)
                    <p>Negali rašyti komentarų, nes nesate paprastas vartotojas</p>
                @else
                    <p>Negalite rašyti komentarų nes nesate prisijungęs</p>
                @endif
            </div>
        </div>
    </div>
@stop
