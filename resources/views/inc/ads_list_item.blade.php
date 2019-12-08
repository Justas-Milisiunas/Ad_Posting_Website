<div class="card">
    {{--    <div class="card-header" style="text-decoration: none">--}}
    {{--        {{$ad->name}}--}}
    {{--    </div>--}}
    {{--    TODO: Add tint on hover--}}
    <div class="card-img-top">
        @if (isset($ad->images))
            <img
                src="{{asset('storage/uploads/'.$ad->images[0]->link)}}" class="card-img">
        @endif
    </div>
    <ul class="list-group list-group-flush">
        <li class="list-group-item list-group-item-secondary">
            <div class="row">
                <div class="col">
                    <b>{{$ad->name}}</b>
                </div>
                <div class="col text-right">
                    <b>{{$ad-> price}}€</b>
                </div>
            </div>
        </li>
        <li class="list-group-item">
            <small>
                {{$ad->created_at}} įkėlė {{$ad->user->name}}
            </small>
        </li>
    </ul>
    <a href="/ads/{{$ad->id}}" class="stretched-link"></a>
</div>
