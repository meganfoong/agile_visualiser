@extends('layouts.app')

@section('supervisorMedia')
<img class="mr-8"
    src="https://ui-avatars.com/api/?name={{Auth::user()->first_name}}+{{Auth::user()->last_name}}&rounded=true" />
<div class="media-body ml-3">
    <h1 class="mb-0"> {{Auth::user()->first_name}} {{Auth::user()->last_name}}</h1>
    <p class="lead">Supervisor</p>
</div>
@endsection

@section('supervisorCrumbs')
<li class="breadcrumb-item">
    <i class="material-icons">
        home
    </i>
</li>
@endsection


@section('supervisorNav')
<ul class="nav nav-tabs nav-justified">
    <li class="nav-item">
        <a class="nav-link active" id="nav-dashboard-tab" data-toggle="tab" href="#nav-dashboard" role="tab"
            aria-controls="nav-dashboard" aria-selected="true">Dashboard</a>
    </li>
    <li class="nav-item">
        <a class="nav-item nav-link" id="nav-projects-tab" data-toggle="tab" href="#nav-projects" role="tab"
            aria-controls="nav-projects" aria-selected="false">Projects</a>
    </li>
    <li class="nav-item">
        <a class="nav-item nav-link" id="nav-students-tab" data-toggle="tab" href="#nav-students" role="tab"
            aria-controls="nav-students" aria-selected="false">Students</a>
    </li>

</ul>
@endsection

@section('dashboard')
@include('supervisor.dash')
@endsection

@section('project')
@include('supervisor.project')
@endsection

@section('student')
@include('supervisor.student')
@endsection