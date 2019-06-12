<div class="row content-list-head">
    <div class="col-auto">
        <h3>Sub-tasks</h3>
    </div>

    <button type="button" class="btn btn-sm" data-toggle="modal" data-target="#new_task">
        <i class="material-icons">
            add
        </i>
    </button>

    {{-- <form class="col">
        <div class="float-right">
            <div class="input-group input-group-round">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        <i class="material-icons">filter_list</i>
                    </span>
                </div>

                <input type="search" class="form-control filter-list-input" placeholder="Filter Projects"
                    aria-label="Filter Projects">
            </div>
        </div>
    </form> --}}
</div>

<br>

<div class="content-list-body row">
    @foreach ($tasks as $item)
    <div class="col-md-6">
        <div class="card card-team">
            <div class="progress">
                <div class="progress-bar bg-{{ $item->status }}" role="progressbar" style="width: 100%"
                    aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
            <div class="card-body">


                <button class="btn btn-sm float-right" type="button" data-toggle="collapse"
                    data-target="#collapseFooter{{ $item->id }}" aria-expanded="false" aria-controls="collapseFooter">
                    <i class="material-icons">
                        more_vert
                    </i>
                </button>

                <div class="card-title">
                    <div class="row">
                        <div class="col-auto">
                            <a href="{{ URL::to('task', $item->id) }}">
                                <h5 data-filter-by="text">{{ $item->title }}</h5>
                            </a>
                        </div>

                        <div class="col-auto">
                            @if ($item->status == 'success')
                            <span class="d-inline badge badge-{{$item->status}}">Complete</span>
                            @elseif ($item->status == 'warning')
                            <span class="badge badge-{{$item->status}}">On Track</span>
                            @elseif ($item->status == 'danger')
                            <span class="badge badge-{{$item->status}}">Off Track</span>
                            @endif
                        </div>
                    </div>
                    <span>{{ $item->description }}</span>
                </div>

                <div>
                    @foreach ($aid as $user)
                    @if ($user->id == $item->assign)
                    <span>Assigned: {{ $user->first_name }}</span>
                    @endif
                    @endforeach
                </div>

                <div>
                    @if (!empty($uid))
                    <span>Approved: </span>
                    @foreach ($uid as $approve)
                    @foreach ($approve->tasks as $subtask)
                    @if ($subtask->id == $item->id)
                    <span>{{$approve->first_name}}</span>
                    @endif
                    @endforeach
                    @endforeach
                    @endif
                </div>

                @if ($item->complete == 1)
                <hr>
                <div class="text-center">
                    {{$item->title}} confirmed complete by Supervisor
                </div>
                @endif
            </div>

            <div class="card-footer collapse" id="collapseFooter{{ $item->id }}">
                @if ($item->assign == Auth::user()->id && $item->status != 'success')
                <button type="button" class="btn btn-sm" data-myid="{{$item->id}}" data-toggle="modal"
                    data-target="#complete_task">
                    <i class="material-icons">
                        check
                    </i>
                </button>

                <button type="button" class="btn btn-sm" data-myid="{{$item->id}}" data-mystatus="{{$item->status}}"
                    data-toggle="modal" data-target="#status_task">
                    <i class="material-icons">
                        bar_chart
                    </i>
                </button>
                @elseif (Auth::user()->is_supervisor == 1)
                <button type="button" class="btn btn-sm" data-myid="{{$item->id}}" data-mystatus="{{$item->status}}"
                    data-complete="" data-toggle="modal" data-target="#realstatus_task">
                    <i class="material-icons">
                        check
                    </i>
                </button>
                @elseif ($item->assign != Auth::user()->id)
                <button type="button" class="btn btn-sm" data-myid="{{$item->id}}" data-toggle="modal"
                    data-target="#approve_task">
                    <i class="material-icons">
                        thumbs_up_down
                    </i>
                </button>
                @endif
                @if ($item->status != 'success')
                <button type="button" data-myid="{{$item->id}}" data-myassign="{{$item->assign}}" class="btn btn-sm "
                    data-toggle="modal" data-target="#assign_task">
                    <i class="material-icons">
                        person
                    </i>
                </button>
                @endif
                <button type="button" data-myid="{{$item->id}}" data-mytitle="{{$item->title}}"
                    data-mydescription="{{$item->description}}" data-mystatus="{{$item->status}}" class="btn btn-sm "
                    data-toggle="modal" data-target="#edit_task">
                    <i class="material-icons">
                        edit
                    </i>
                </button>

                <button type="button" class="btn btn-sm float-right" data-myid="{{$item->id}}" data-toggle="modal"
                    data-target="#delete_task">
                    <i class="material-icons">
                        delete
                    </i>
                </button>
            </div>
        </div>
    </div>
    @endforeach
</div>

<!-- The Modal for adding a task -->
<div class="modal fade" id="new_task">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h5 class="modal-title">New Task</h5><br>

                <div class="modal-options">
                    <button type="button" class="btn btn-outline-danger btn-sm" data-dismiss="modal">
                        <i class="material-icons">
                            close
                        </i>
                        <br>
                    </button>
                </div>
            </div>

            <!-- Modal Body -->
            <form method="POST" action="{{route('task.store')}}" class="was-validated">
                {{ csrf_field() }}
                <div class="modal-body">

                    @include('task.subtaskform')
                    <input type="hidden" name="parent_id" id="parent_id" value="{{$tid}}">
                    <input type="hidden" name="project_id" id="project_id" value="{{$pid}}">

                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <div class="float-right">
                        <button type="submit" class="btn btn-outline-primary btn-sm">
                            <i class="material-icons">
                                check
                            </i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- The Modal for editing a task -->
<div class="modal fade" id="edit_task">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h5 class="modal-title">Update Task</h5><br>

                <div class="modal-options">
                    <button type="button" class="btn btn-outline-danger btn-sm" data-dismiss="modal">
                        <i class="material-icons">
                            close
                        </i>
                        <br>
                    </button>
                </div>
            </div>

            <!-- Modal Body -->
            <form method="POST" action="{{route('task.update', 'redirect')}}" class="was-validated">
                {{method_field('PATCH')}}
                {{ csrf_field() }}
                <div class="modal-body">
                    <input type="hidden" name="taskid" id="taskid" value="">
                    @include('task.subtaskform')
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <div class="float-right">
                        <button type="submit" class="btn btn-outline-primary btn-sm">
                            <i class="material-icons">
                                check
                            </i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- The Modal for deleting a task -->
<div class="modal fade" id="delete_task">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h5 class="modal-title">Delete Task</h5><br>

                <div class="modal-options">
                    <button type="button" class="btn btn-outline-danger btn-sm" data-dismiss="modal">
                        <i class="material-icons">
                            close
                        </i>
                        <br>
                    </button>
                </div>
            </div>

            <!-- Modal Body -->
            <form method="POST" action="{{route('task.destroy', 'redirect')}}" class="was-validated">
                {{method_field('delete')}}
                {{ csrf_field() }}
                <div class="modal-body">
                    <h3>Are you sure you want to delete task?</h3>
                    <input type="hidden" name="taskid" id="taskid" value="">
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <div class="float-right">
                        <button type="submit" class="btn btn-outline-primary btn-sm">
                            <i class="material-icons">
                                check
                            </i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- The Modal for approving a task -->
<div class="modal fade" id="approve_task">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h5 class="modal-title">Approve Task</h5><br>

                <div class="modal-options">
                    <button type="button" class="btn btn-outline-danger btn-sm" data-dismiss="modal">
                        <i class="material-icons">
                            close
                        </i>
                        <br>
                    </button>
                </div>
            </div>

            <!-- Modal Body -->
            <form method="POST" action="{{route('task.update', 'redirect')}}" class="was-validated">
                {{method_field('PATCH')}}
                {{ csrf_field() }}
                <div class="modal-body">
                    <input type="hidden" name="taskid" id="taskid" value="">
                    @include('task.approveform')
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <div class="float-right">
                        <button type="submit" class="btn btn-outline-primary btn-sm">
                            <i class="material-icons">
                                check
                            </i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- The Modal for completing a task -->
<div class="modal fade" id="complete_task">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h5 class="modal-title">Complete Task</h5><br>

                <div class="modal-options">
                    <button type="button" class="btn btn-outline-danger btn-sm" data-dismiss="modal">
                        <i class="material-icons">
                            close
                        </i>
                        <br>
                    </button>
                </div>
            </div>

            <!-- Modal Body -->
            <form method="POST" action="{{route('task.update', 'redirect')}}" class="was-validated">
                {{method_field('PATCH')}}
                {{ csrf_field() }}
                <div class="modal-body">
                    <input type="hidden" name="taskid" id="taskid" value="">
                    <input type="hidden" name="approve" id="approve" value="1">
                    <input type="hidden" name="status" id="status" value="success">
                    <h3>Are you sure you want to complete task?</h3>
                    <h3>This cannot be reverted!</h3>


                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <div class="float-right">
                        <button type="submit" class="btn btn-outline-primary btn-sm">
                            <i class="material-icons">
                                check
                            </i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- The Modal for the real status of a task -->
<div class="modal fade" id="realstatus_task">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h5 class="modal-title">Complete Task</h5><br>

                <div class="modal-options">
                    <button type="button" class="btn btn-outline-danger btn-sm" data-dismiss="modal">
                        <i class="material-icons">
                            close
                        </i>
                        <br>
                    </button>
                </div>
            </div>

            <!-- Modal Body -->
            <form method="POST" action="{{route('task.update', 'redirect')}}" class="was-validated">
                {{method_field('PATCH')}}
                {{ csrf_field() }}
                <div class="modal-body">
                    <input type="hidden" name="taskid" id="taskid" value="">
                    <div class="form-group">
                        <label for="complete">Is the task complete?</label>
                        <select name="complete" class="custom-select custom-select-sm">
                            <option value="1" class="text-dark">Yes</option>
                            <option value="2" class="text-success">No</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="status">Status:</label>
                        <select name="status" class="custom-select custom-select-sm">
                            <option value="dark" class="text-dark">Select</option>
                            <option value="success" class="text-success">Complete</option>
                            <option value="warning" class="text-warning">On Track</option>
                            <option value="danger" class="text-danger">Off Track</option>
                        </select>
                    </div>

                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <div class="float-right">
                        <button type="submit" class="btn btn-outline-primary btn-sm">
                            <i class="material-icons">
                                check
                            </i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- The Modal for the assigning a user to a task -->
<div class="modal fade" id="assign_task">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h5 class="modal-title">Assign user to Task</h5><br>

                <div class="modal-options">
                    <button type="button" class="btn btn-outline-danger btn-sm" data-dismiss="modal">
                        <i class="material-icons">
                            close
                        </i>
                        <br>
                    </button>
                </div>
            </div>

            <!-- Modal Body -->
            <form method="POST" action="{{route('task.update', 'redirect')}}" class="was-validated">
                {{method_field('PATCH')}}
                {{ csrf_field() }}
                <div class="modal-body">
                    <input type="hidden" name="taskid" id="taskid" value="">
                    @include('task.assignform')
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <div class="float-right">
                        <button type="submit" class="btn btn-outline-primary btn-sm">
                            <i class="material-icons">
                                check
                            </i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- The Modal for updating status of task -->
<div class="modal fade" id="status_task">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h5 class="modal-title">Change status</h5><br>

                <div class="modal-options">
                    <button type="button" class="btn btn-outline-danger btn-sm" data-dismiss="modal">
                        <i class="material-icons">
                            close
                        </i>
                        <br>
                    </button>
                </div>
            </div>

            <!-- Modal Body -->
            <form method="POST" action="{{route('task.update', 'redirect')}}" class="was-validated">
                {{method_field('PATCH')}}
                {{ csrf_field() }}
                <div class="modal-body">
                    <input type="hidden" name="taskid" id="taskid" value="">
                    @include('task.statusform')
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <div class="float-right">
                        <button type="submit" class="btn btn-outline-primary btn-sm">
                            <i class="material-icons">
                                check
                            </i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $('#edit_task').on('show.bs.modal', function (event) {

        var button = $(event.relatedTarget)
        var id = button.data('myid')
        var title = button.data('mytitle')
        var description = button.data('mydescription')
        var status = button.data('mystatus')
        var assign = button.data('myassign')
        var modal = $(this)

        modal.find('.modal-body #taskid').val(id);
        modal.find('.modal-body #title').val(title);
        modal.find('.modal-body #des').val(description);
        modal.find('.modal-body #status').val(status);
    })


    $('#delete_task').on('show.bs.modal', function (event) {

        var button = $(event.relatedTarget)

        var id = button.data('myid')
        var modal = $(this)

        modal.find('.modal-body #taskid').val(id);
    })

    $('#approve_task').on('show.bs.modal', function (event) {

        var button = $(event.relatedTarget)
        var id = button.data('myid')
        var modal = $(this)

        modal.find('.modal-body #taskid').val(id);

    })

    $('#complete_task').on('show.bs.modal', function (event) {

        var button = $(event.relatedTarget)
        var id = button.data('myid')
        var modal = $(this)

        modal.find('.modal-body #taskid').val(id);


    })

    $('#realstatus_task').on('show.bs.modal', function (event) {

        var button = $(event.relatedTarget)
        var id = button.data('myid')
        var status = button.data('mystatus')
        var complete = button.data('complete')
        var modal = $(this)

        modal.find('.modal-body #taskid').val(id);
        modal.find('.modal-body #status').val(status);
        modal.find('.modal-body #complete').val(complete);
    })

    $('#assign_task').on('show.bs.modal', function (event) {

        var button = $(event.relatedTarget)
        var id = button.data('myid')
        var assign = button.data('myassign')
        var modal = $(this)

        modal.find('.modal-body #taskid').val(id);
        modal.find('.modal-body #assign').val(assign);
    })

    $('#status_task').on('show.bs.modal', function (event) {

        var button = $(event.relatedTarget)
        var id = button.data('myid')
        var status = button.data('mystatus')
        var modal = $(this)

        modal.find('.modal-body #taskid').val(id);
        modal.find('.modal-body #status').val(status);
})
</script>