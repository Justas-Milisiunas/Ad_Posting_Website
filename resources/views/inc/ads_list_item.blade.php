<div class="card">
{{--    <div class="card-header" style="text-decoration: none">--}}
{{--        {{$ad->name}}--}}
{{--    </div>--}}
{{--    TODO: Add tint on hover--}}
    <div class="card-img-top">
        <img src="https://image.cnbcfm.com/api/v1/image/106141453-1569002923097evporsche_taycan_turbo_2019_porsche_ag.jpg?v=1569003053&w=1400&h=950" style="width: 100%;">
    </div>
        <ul class="list-group list-group-flush">
            <li class="list-group-item list-group-item-secondary"><b>{{$ad->name}}</b></li>
            <li class="list-group-item text-truncate">{{$ad->description}}</li>
            <li class="list-group-item">
                <small>
                    {{$ad->created_at}} įkėlė {{$ad->user->name}}
                </small>
            </li>
        </ul>
    <a href="/ads/{{$ad->id}}" class="stretched-link"></a>
</div>
