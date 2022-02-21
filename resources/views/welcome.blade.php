@extends('layout')
@section('content')
    <div class="flex-center position-ref full-height">
        <div class="content">
            <div class="title m-b-md">
                2022 Premier Lig Simulator :)
            </div>
            <div class="links">
                <a href="{{url('weeks')}}">Weeks</a>
                <a href="{{url('teams')}}">Teams</a>
                <a href="{{url('fixture')}}">Fixture</a>
                <a href="{{url('match')}}">Match</a>
            </div>
        </div>
    </div>
@endsection
