@extends('layouts.app')


@section('taskMedia')

<img class="mr-8"
@foreach ($project as $item)
    src="https://ui-avatars.com/api/?name={{$item->title}}&rounded=true" />
    @endforeach
<div class="media-body ml-3">
    @foreach ($task as $item)
    <h1 class="mb-0">{{$item->title}}</h1>
    @endforeach
    @foreach ($project as $item)
    <p class="lead">{{$item->title}} </p>
    @endforeach
</div>
@endsection

@if(auth()->user()->is_supervisor == 0)
    @section('studentCrumbs')
    <li class="breadcrumb-item">
        @foreach ($project as $item)
        <a href="{{ URL::to('project', $item->id) }}">
            <i class="material-icons">
                home
            </i>
        </a>
        @endforeach
    </li>
    <li class="breadcrumb-item active" aria-current="page">
        @foreach ($task as $item)
            {{$item->title}}
        @endforeach
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
        @foreach ($project as $item)
        <a href="{{ URL::to('project', $item->id) }}">
            {{$item->title}}
        </a>
        @endforeach
    </li>
    <li class="breadcrumb-item active" aria-current="page">
        @foreach ($task as $item)
            {{$item->title}}
        @endforeach
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
        <a class="nav-item nav-link" id="nav-subContribution-tab" data-toggle="tab" href="#nav-subContribution" role="tab"
            aria-controls="nav-subContribution" aria-selected="false">Contribution</a>
    </li>
</ul>
@endsection

@section('subtask')
@include('task.subtask')
@endsection

@section('subContribution')
@include('task.contribution')
@endsection