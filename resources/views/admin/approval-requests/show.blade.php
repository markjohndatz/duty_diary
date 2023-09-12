@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-8 col-12">
                        <h4 class="m-0">
                            <i class="fas fa-solid fa-book-open"></i>
                            {{ $diary['title']}}
                        </h4>
                    </div>
                    <div class="col-md-4 col-12 text-right">
                        <a href="{{ back()->getTargetUrl() }}" class="btn btn-sm btn-secondary">
                            <i class="fas fa-solid fa-chevron-left"></i>
                            Back
                        </a>
                        <a href="{{ route('approval-requests.print', $diary['diary']->id) }}" class="btn btn-sm btn-warning" target="_blank">
                            <i class="fas fa-solid fa-print"></i>
                        </a>
                        @if (Auth::user()->role_as == 1 || Auth::user()->role_as == 2)
                            @if ($diary['diary']->status == 0)
                                <button class="btn btn-sm btn-success" onclick="approveDiary({{$diary['diary']->id}})">
                                    <i class="fas fa-check"></i> Approve
                                </button>

                                @include('admin.approval-requests.partials._scripts')
                                
                            @endif
                        @endif
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="header-box py-3 border-bottom mb-3">
                    <h3 class="text-uppercase bg-primary p-2 text-light">Practicum Duty Diary</h3>
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
                <h5 class="mt-5 text-uppercase m-0">{{$diary['supervisor'] }}</h5>
                <p class="m-0">HTE Supervising Officer</p>
                <p class="m-0">Date: {{ now()->format('md/y') }}</p>
            </div>
        </div>
    </div>
@endsection