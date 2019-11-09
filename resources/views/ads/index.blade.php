@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h3>Skelbimai</h3>
            </div>
            <div class="card-body">

            </div>
            @isset($ads)
                @if (count($ads) > 0)
                    <div class="card-footer">
                        {{$ads->links()}}
                    </div>
                @endif
            @endisset
        </div>
    </div>
@stop
