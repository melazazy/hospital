@extends('dashboard.sidebar')
@section('content')
@if (Auth::user()->type=== 'admin')
    @include('dashboard.layout.dashboards.admin')
@elseif (Auth::user()->type === 'doctor')
    @if (Auth::user()->user_detail['department_id']==23)
        @include('dashboard.layout.dashboards.lab')
    @elseif (Auth::user()->user_detail['department_id']==16)
        @include('dashboard.layout.dashboards.pharm')
    @else
        @include('dashboard.layout.dashboards.doctor')
    @endif
@elseif (Auth::user()->type === 'patient')
    @include('dashboard.layout.dashboards.patient')
@elseif (Auth::user()->type === 'employee')
    @if($type == 'acc')
        @include('dashboard.layout.dashboards.accounting')
    @else
        @include('dashboard.layout.dashboards.reception')
    @endif
@else
No One
@endif

@endsection


