<div class="row content-list-head">
    <div class="col-auto">
        <h3>Tasks</h3>
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
                <button type="button" data-myid="{{$item->id}}" data-mytitle="{{$item->title}}"
                    data-mydescription="{{$item->description}}" data-mystatus="{{$item->status}}"
                    data-startDate="{{$item->startDate}}" data-dueDate="{{$item->dueDate}}"
                    class="btn btn-sm float-right" data-toggle="modal" data-target="#edit_task">
                    <i class="material-icons">
                        more_vert
                    </i>
                </button>

                <div class="card-title">
                    <a href="{{ URL::to('task', $item->id) }}">
                        <h5 data-filter-by="text">{{ $item->title }}</h5>
                    </a>
                    <span>{{ $item->description }}</span>


                </div>

                <button type="button" class="btn btn-sm float-right" data-myid="{{$item->id}}" data-toggle="modal"
                    data-target="#delete_task">
                    <i class="material-icons">
                        delete
                    </i>
                </button>

                <div>
                    <span>Start: {{$item->startDate}} End: {{$item->dueDate}}</span>
                </div>
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

                    @include('project.taskform')
                    <input type="hidden" name="project_id" id="project_id" value="{{request()->route('project')}}">
                    <div class="form-group">
                        <input type="hidden" name="status" id="status" value="dark">
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
                    @include('project.taskform')
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

<script>
    $('#edit_task').on('show.bs.modal', function (event) {

        var button = $(event.relatedTarget)
        var id = button.data('myid')
        var title = button.data('mytitle')
        var description = button.data('mydescription')
        var status = button.data('mystatus')
        var startDate = button.data('startDate')
        var dueDate = button.data('dueDate')
        var modal = $(this)

        modal.find('.modal-body #taskid').val(id);
        modal.find('.modal-body #title').val(title);
        modal.find('.modal-body #des').val(description);
        modal.find('.modal-body #status').val(status);
        modal.find('.modal-body #startDate').val(startDate);
        modal.find('.modal-body #dueDate').val(dueDate);



    })


    $('#delete_task').on('show.bs.modal', function (event) {

        var button = $(event.relatedTarget)

        var id = button.data('myid')
        var modal = $(this)

        modal.find('.modal-body #taskid').val(id);
    }) 
</script>