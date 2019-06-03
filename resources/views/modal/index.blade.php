@extends('layouts.app')

@section('content')

<head>
    <link href="{{ asset ('css/style.css')}}" rel="stylesheet">
</head>

<div class="container">
    <!-- Button to Open the Modal -->
    <button type="button" class="btn btn-sm" data-toggle="modal" data-target="#myModal"><i class="material-icons">
            more_vert
        </i>
    </button>

    <br>

    <div class="row">
        @foreach ($modals as $item)
        <div class="col-md-6">

            <div class="card card-team">
                <div class="progress">
                    <div class="progress-bar bg-{{ $item->status }}" role="progressbar" style="width: 100%"
                        aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <div class="card-body">


                    <!-- Button to Open the Modal -->
                    <button type="button" data-myid="{{$item->id}}" data-mytitle="{{$item->title}}"
                        data-mydescription="{{$item->description}}" data-mystatus="{{$item->status}}"
                        data-myassign="{{$item->assign}}" data-myapprove="{{$item->approve}}" class="btn btn-sm"
                        data-toggle="modal" data-target="#edit">
                        <i class="material-icons">
                            more_vert
                        </i>
                    </button>

                    <button class="btn btn-danger" data-myid="{{$item->id}}" data-toggle="modal"
                        data-target="#delete">Delete</button>

                    <div class="card-options">
                        <i class="material-icons">lock_open</i>
                    </div>
                    <div class="card-title">
                    <a href="{{ URL::to('modal', $item->id) }}">
                            <h5 data-filter-by="text">{{ $item->title }}</h5>
                        </a>
                        <span>{{ $item->description }}</span>
                    </div>
                    <ul class="avatars">
                        <!-- 
                        <li>
                            <a href="#" data-to+ggle="tooltip" title="">
                                <img alt="Megan" class="avatar" src=".jpg" />
                            </a>
                        </li>

                        <li>
                            <a href="#" data-toggle="tooltip" title="">
                                <img alt="Derryn" class="avatar" src=".jpg" />
                            </a>
                        </li>

                        <li>
                            <a href="#" data-toggle="tooltip" title="">
                                <img alt="Jawad" class="avatar" src=".jpg" />
                            </a>
                        </li>

                        <li>
                            <a href="#" data-toggle="tooltip" title="">
                                <img alt="Jammy" class="avatar" src=".jpg" />
                            </a>
                        </li>
                        -->
                        <li>
                            {{ $item->assign }}
                        </li>
                        <li>
                            {{ $item->approve }}
                        </li>
                        <li>
                            {{ $item->id }}
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

<!-- The Modal for adding a card -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-body">
                <h5 class="modal-title">Add Task</h5>
                <div class="modal-options">
                    <button type="button" class="btn btn-outline-danger btn-sm" data-dismiss="modal"><i
                            class="material-icons">
                            close
                        </i>
                </div><br>

                <!-- Modal body -->

                <form method="POST" action="{{route('modal.store')}}" class="was-validated">
                    {{ csrf_field() }}
                    @include('modal.edit')
                    <br>
                    <br>

                    <!-- Modal footer -->

                    <div class="float-right">
                        <button type="submit" class="btn btn-outline-primary btn-sm">
                            <i class="material-icons"> check </i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- The Modal for updating a card-->
<div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-body">
                <h5 class="modal-title">Modify Task</h5>
                <div class="modal-options">
                    <button type="button" class="btn btn-outline-danger btn-sm" data-dismiss="modal"><i
                            class="material-icons">
                            close
                        </i>
                </div><br>

                <!-- Modal body -->
                <form method="POST" action="{{route('modal.update', 'test')}}" class="was-validated">
                    {{method_field('PATCH')}}
                    {{ csrf_field() }}

                    <input type="hidden" name="modal_id" id="mod_id" value="">
                    @include('modal.edit')
                    <br>
                    <br>

                    <!-- Modal footer -->

                    <div class="float-right">
                        <button type="submit" class="btn btn-outline-primary btn-sm">
                            <i class="material-icons"> check </i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- The Modal for deleting a card-->
<div class="modal modal-danger fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h4 class="modal-title text-center" id="myModalLabel">Delete Confirmation</h4>
            </div>
            <form action="{{route('modal.destroy','test')}}" method="post">
                {{method_field('delete')}}
                {{csrf_field()}}
                <div class="modal-body">
                    <p class="text-center">
                        Are you sure you want to delete this?
                    </p>
                    <input type="hidden" name="modal_id" id="mod_id" value="">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" data-dismiss="modal">No, Cancel</button>
                    <button type="submit" class="btn btn-warning">Yes, Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection