@extends('layouts.app')

@if(auth()->user()->is_supervisor == 0)
    @section('studentCrumbs')
    <li class="breadcrumb-item">
        <a href="{{ url()->previous() }}">
            <i class="material-icons">
                home
            </i>
        </a>
    </li>
    <li class="breadcrumb-item active" aria-current="page">
        Task
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
    <li class="breadcrumb-item">
        <a href="{{ url()->previous() }}">
            Project
        </a>
    </li>
    <li class="breadcrumb-item active" aria-current="page">
        Task
    </li>
    @endsection
@endif

@section('taskNav')
<ul class="nav nav-tabs nav-justified">
    <li class="nav-item">
        <a class="nav-link active" id="nav-subtask-tab" data-toggle="tab" href="#nav-subtask" role="tab"
            aria-controls="nav-subtask" aria-selected="true">Sub-tasks</a>
    </li>
    <li class="nav-item">
        <a class="nav-item nav-link" id="nav-other-tab" data-toggle="tab" href="#nav-other" role="tab"
            aria-controls="nav-other" aria-selected="false">Other</a>
    </li>
</ul>
@endsection

@section('subtask')
@include('task.subtask')
@endsection

@section('other')

@endsection