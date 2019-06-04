@extends('layouts.app')


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