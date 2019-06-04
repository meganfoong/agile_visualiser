@extends('layouts.app')

@section('projectNav')
<ul class="nav nav-tabs nav-justified">
    <li class="nav-item">
        <a class="nav-link active" id="nav-overview-tab" data-toggle="tab" href="#nav-overview" role="tab"
            aria-controls="nav-overview" aria-selected="true">Overview</a>
    </li>
    <li class="nav-item">
        <a class="nav-item nav-link" id="nav-progress-tab" data-toggle="tab" href="#nav-progress" role="tab"
            aria-controls="nav-progress" aria-selected="false">Progress</a>
    </li>
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