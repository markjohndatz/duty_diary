@extends('layouts.print')

@section('content')
    <div class="header-box py-3 border-bottom mb-3">
        <h3 class="text-uppercase bg-primary p-2 text-light mb-3">Practicum Duty Diary</h3>
        <div class="row pl-2">
            <div class="col-3">Name of Trainee: </div>
            <div class="col-9 font-weight-bold">{{ $diary['name'] }}</div>
        </div>
        <div class="row pl-2">
            <div class="col-3">Company Name: </div>
            <div class="col-9 font-weight-bold">CREATIVEDEVLABS (CDL INNOVATIVE IT SOLUTIONS)</div>
        </div>
        <div class="row pl-2">
            <div class="col-3">Diary Date: </div>
            <div class="col-9 font-weight-bold">{{ $diary['diary']->created_at->format('m/d/y') }}</div>
        </div>
    </div>
    <h5 class="text-uppercase">Plan Today</h5>
    {!! $diary['diary']->plan_today !!}
    <hr>
    <h5 class="text-uppercase">End-of-Day Report</h5>
    {!! $diary['diary']->end_day !!}
    <hr>
    <h5 class="text-uppercase">Plan Tomorrow</h5>
    {!! $diary['diary']->plan_tomorrow !!}
    <hr>
    <h5 class="text-uppercase">Roadblocks</h5>
    {!! $diary['diary']->roadblock !!}
    <hr>

    <h5 class="text-uppercase">Summary</h5>
    {!! $diary['diary']->summary !!}
    <hr>
    <p class="mt-5">Checked by:</p>
    <img src="{{ asset('storage/'.$diary['signature']) }}" alt="Supervisor's Signature" width="15%" class="position-relative top-1 mt-5">
    <h5 class="mt-5 text-uppercase m-0">{{$diary['supervisor'] }}</h5>
    <p class="m-0">HTE Supervising Officer</p>
    <p class="m-0">Date: {{ now()->format('md/y') }}</p>
@endsection