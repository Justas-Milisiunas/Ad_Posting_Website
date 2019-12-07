@extends('layouts.app')

<!-- The Modal -->
<div class="modal" id="myModal">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Modal Heading</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                Modal body..
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h3 class="card-text">Visi Vartotojai</h3>
            </div>
            <div class="card-body">
                @if (isset($users) && count($users) > 0)
                    <div class="row">
                        <div class="col col-2">
                            <h5 class="card-title">Vardas</h5>
                        </div>
                        <div class="col col-2">
                            <h5 class="card-title">El. paštas</h5>
                        </div>
                        <div class="col">
                            <h5 class="card-title">Rolė</h5>
                        </div>
                        <div class="col">
                            <h5 class="card-title">Mobilus numeris</h5>
                        </div>
                        <div class="col col-2">
                            <h5 class="card-title">Užsiregistravo</h5>
                        </div>
                        <div class="col">
                            <h5 class="card-title">Skelbimų kūrimas</h5>
                        </div>
                        <div class="col">
                            <h5 class="card-title">Sukurti skelbimai</h5>
                        </div>
                    </div>
                    @foreach ($users as $user)
                        @include('inc.user_ads_dialog', ['user' => $user])
                        <div class="row" style="height: 40px">
                            <div class="col col-2">
                                {{$user->name}}
                            </div>
                            <div class="col col-2">
                                {{$user->email}}
                            </div>
                            <div class="col">
                                @switch($user->role)
                                    @case(1)
                                    Vartotojas
                                    @break
                                    @case(2)
                                    Administratorius
                                    @break
                                    @case(3)
                                    Moderatorius
                                    @break
                                @endswitch
                            </div>
                            <div class="col">
                                @if (!empty($user->mobile_number))
                                    {{$user->mobile_number}}
                                @else
                                    Neturi
                                @endif
                            </div>
                            <div class=" col-2">
                                {{$user->created_at}}
                            </div>
                            <div class="col">
                                @if ($user->role == 1 && $user->create_ad == false)
                                    <a href="/admin/allow/{{$user->id}}" class="btn btn-outline-success btn-sm">
                                        Leisti
                                    </a>
                                @endif
                            </div>
                            <div class="col">
                                @if ($user->role == 1)
                                    @if (sizeof($user->ads) == 0)
                                        Neturi
                                    @else
                                        <button type="button" class="btn btn-outline-primary btn-sm" data-toggle="modal"
                                                data-target="#userAds">
                                            Skelbimai
                                        </button>
                                    @endif
                                @endif
                            </div>
                        </div>
                    @endforeach
                @else
                    <p class="card-text">Nerastas nei vienas vartotojas</p>
                @endif
            </div>
                <div class="card-footer">
                    {{$users->links()}}
                </div>
        </div>
    </div>
@stop
