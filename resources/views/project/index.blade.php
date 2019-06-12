@extends('layouts.app')

@section('projectMedia')
@foreach ($projects as $item)
<img class="mr-8" src="https://ui-avatars.com/api/?name={{$item->title}}&rounded=true" />
<div class="media-body ml-3">
    <h1 class="mb-0">{{$item->title}}</h1>
    <ul class="avatars">
        <li>
            <p class="lead">{{$item->group}} - </p>
        </li>

        @foreach ($item->users as $user)
        <li>
            @if ($user->is_supervisor == 0)
            <img class="mr-8"
                src="https://ui-avatars.com/api/?name={{$user->first_name}}+{{$user->last_name}}&rounded=true&size=25" />
            {{$user->first_name}}
            @endif
        </li>
        @endforeach
    </ul>




</div>
@endforeach
@endsection

@if(auth()->user()->is_supervisor == 0)
@section('studentCrumbs')
<li class="breadcrumb-item">
    <i class="material-icons">
        home
    </i>
</li>
@endsection
@elseif (auth()->user()->is_supervisor == 1)
@section('supervisorCrumbs')
<li class="breadcrumb-item">
    <a href="{{ URL::to('supervisor') }}">
        <i class="material-icons">
            home
        </i>
    </a>
</li>
<li class="breadcrumb-item active" aria-current="page">
    @foreach ($projects as $item)
    {{$item->title}}
    @endforeach
</li>
@endsection
@endif

@section('projectNav')
<ul class="nav nav-tabs nav-justified">
    <li class="nav-item">
        <a class="nav-link active" id="nav-dash-tab" data-toggle="tab" href="#nav-dash" role="tab"
            aria-controls="nav-dash" aria-selected="true">Dashboard</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="nav-overview-tab" data-toggle="tab" href="#nav-overview" role="tab"
            aria-controls="nav-overview" aria-selected="true">Overview</a>
    </li>
    {{-- <li class="nav-item">
        <a class="nav-item nav-link" id="nav-progress-tab" data-toggle="tab" href="#nav-progress" role="tab"
            aria-controls="nav-progress" aria-selected="false">Progress</a>
    </li> --}}
    <li class="nav-item">
        <a class="nav-item nav-link" id="nav-tasks-tab" data-toggle="tab" href="#nav-tasks" role="tab"
            aria-controls="nav-tasks" aria-selected="false">Tasks</a>
    </li>
    <li class="nav-item">
        <a class="nav-item nav-link" id="nav-contribution-tab" data-toggle="tab" href="#nav-contribution" role="tab"
            aria-controls="nav-contribution" aria-selected="false">Contribution</a>
    </li>

</ul>
@endsection

@section('dash')
@include('project.dash')
@endsection

@section('overview')
@include('project.overview')
@endsection

@section('progress')
@include('project.progress')
@endsection

@section('task')
@include('project.task')
@endsection

@section('contribution')
@include('project.contribution')
@endsection