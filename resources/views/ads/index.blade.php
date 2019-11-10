@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h3>Skelbimai</h3>
            </div>
            <div class="card-body">
                @isset($ads)
                    @if (count($ads) > 0)
                        <div class="row">
                            @foreach ($ads as $key=>$ad)
                                <div class="col-sm-4">
                                    @include('inc.ads_list_item', ['ad' => $ad])
                                    @if (($key + 1) % 3 == 0)
                                        <hr>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    @endif
                @endisset
            </div>
            @isset($ads)
                @if (count($ads) > 0)
                    <div class="card-footer align-self-center">
                        {{$ads->links()}}
                    </div>
                @endif
            @endisset
        </div>
    </div>
@stop
