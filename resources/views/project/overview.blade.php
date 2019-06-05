<div class="row content-list-head">
    <div class="col-auto">
        <h3>Overview</h3>
    </div>
    <div class="col-auto">
        <button type="button" class="btn btn-sm float-right" data-toggle="modal" data-target="#edit">
            <i class="material-icons">
                more_vert
            </i>
        </button>
    </div>

</div>

<div class="card card-team">
    <div class="card-body">
        <div class="card-title">
            <h5 data-filter-by="text">Project Brief</h5>
        </div>
    </div>
</div>

<div class="card card-team">
    <div class="card-body">
        <div class="card-title">
            <h5 data-filter-by="text">Milestones</h5>
        </div>
    </div>
</div>

<div class="card card-team">
    <div class="card-body">
        <div class="card-title">
            <h5 data-filter-by="text">Supervisor Details</h5>
        </div>
    </div>
</div>

<div class="card card-team">
    <div class="card-body">
        <div class="card-title">
            <h5 data-filter-by="text">Client Details</h5>
        </div>
    </div>
</div>


<!-- The Modal for editing a task -->
<div class="modal fade" id="edit">
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