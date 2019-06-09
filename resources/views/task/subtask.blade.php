<div class="row content-list-head">
    <div class="col-auto">
        <h3>Sub-tasks</h3>
    </div>

    <button type="button" class="btn btn-sm" data-toggle="modal" data-target="#new_task">
        <i class="material-icons">
            add
        </i>
    </button>

    <form class="col">
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
    </form>
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
                    data-target="#collapseFooter" aria-expanded="false" aria-controls="collapseFooter">
                    <i class="material-icons">
                        more_vert
                    </i>
                </button>

                <div class="card-title">
                    <h5 data-filter-by="text">{{ $item->title }}</h5>
                    <span>{{ $item->description }}</span>
                </div>

                <div>
                    <span>Assigned: {{ $item->assign }}</span>
                </div>
            </div>

            <div class="card-footer collapse" id="collapseFooter">
                @if ($item->assign == Auth::user()->id)
                <button type="button" class="btn btn-sm" data-myid="{{$item->id}}" data-mystatus="{{$item->status}}" data-userid=""
                    data-toggle="modal" data-target="#complete_task">
                    <i class="material-icons">
                        check
                    </i>
                </button>
                @elseif (Auth::user()->is_supervisor == 1)
                <button type="button" class="btn btn-sm" data-myid="{{$item->id}}" data-mystatus="{{$item->status}}" data-complete=""
                    data-toggle="modal" data-target="#realstatus_task">
                    <i class="material-icons">
                        check
                    </i>
                </button>
                @else
                <button type="button" class="btn btn-sm" data-myid="{{$item->id}}" data-userid="" data-toggle="modal"
                    data-target="#approve_task">
                    <i class="material-icons">
                        thumbs_up_down
                    </i>
                </button>
                @endif
                <button type="button" data-myid="{{$item->id}}" data-mytitle="{{$item->title}}"
                    data-mydescription="{{$item->description}}" data-mystatus="{{$item->status}}"
                    data-myassign="{{$item->assign}}" class="btn btn-sm " data-toggle="modal" data-target="#edit_task">
                    <i class="material-icons">
                        update
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
                    <input type="hidden" name="userid" id="userid" value="{{Auth::user()->id}}">
                    @include('task.approveform')
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
                            <option value="0" class="text-success">No</option>
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
        modal.find('.modal-body #assign').val(assign);



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
        var userid = button.data('userid')
        var modal = $(this)

        modal.find('.modal-body #taskid').val(id);
        modal.find('.modal-body #userid').val(userid);
    })

    $('#complete_task').on('show.bs.modal', function (event) {

        var button = $(event.relatedTarget)
        var id = button.data('myid')
        var status = button.data('mystatus')
        var userid = button.data('userid')
        var modal = $(this)

        modal.find('.modal-body #taskid').val(id);
        modal.find('.modal-body #status').val(status);
        modal.find('.modal-body #userid').val(userid);
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
</script>