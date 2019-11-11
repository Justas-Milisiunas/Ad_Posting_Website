@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h3 class="card-text">Visi Vartotojai</h3>
            </div>
            <div class="card-body">
                @if (isset($users) && count($users) > 0)
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">Vardas</th>
                            <th scope="col">El. paštas</th>
                            <th scope="col">Rolė</th>
                            <th scope="col">Mobilus numeris</th>
                            <th scope="col">Užsiregistravo</th>
                            <th scope="col">Skelbimų kūrimas</th>
                            <th scope="col">Sukurti skelbimai</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>{{$user->name}}</td>
                                <td>{{$user->email}}</td>
                                <td>
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
                                </td>
                                <td>
                                    @if (!empty($user->mobile_number))
                                        {{$user->mobile_number}}
                                    @else
                                        Neturi
                                    @endif
                                </td>
                                <td>{{$user->created_at}}</td>
                                <td>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1">
                                        <label class="form-check-label" for="inlineCheckbox1">Gali kurti</label>
                                    </div>
                                </td>
                                <td>
                                    {{Form::submit('Skelbimai', ['class' => 'btn btn-outline-primary'])}}
                                    {!! Form::close() !!}
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                    {{Form::submit('Atnaujinti', ['class' => 'btn btn-primary'])}}
                    {!! Form::close() !!}
                @else
                    <p class="card-text">Nerastas nei vienas vartotojas</p>
                @endif
            </div>
            {{--            TODO: align paginator in the center--}}
            @if (count($users) >= 10)
                <div class="card-footer">
                    {{$users->links()}}
                </div>
            @endif
        </div>
    </div>
@stop
