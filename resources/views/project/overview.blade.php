@foreach ($projects as $item)
<div class="row content-list-head">
    <div class="col-auto">
        <h3>Overview</h3>
    </div>
    <div class="col-auto">
        <button type="button"
        data-myid="{{$item->id}}" data-brief="{{$item->brief}}" data-milestones="{{$item->milestones}}" 
        data-mysupervisor="{{$item->supervisorDetails}}" data-myclient="{{$item->clientDetails}}"
         class="btn btn-sm float-right" data-toggle="modal" data-target="#edit_project">
            <i class="material-icons">
                edit
            </i>
        </button>
    </div>
</div>


<div class="card card-team">
    <div class="card-body">
        <div class="card-title">
            <h5 data-filter-by="text">Project Brief</h5>
        </div>
        {!! nl2br(e($item->brief)) !!}
    </div>
</div>

<div class="card card-team">
    <div class="card-body">
        <div class="card-title">
            <h5 data-filter-by="text">Milestones</h5>
        </div>
        {!! nl2br(e($item->milestones)) !!}
    </div>
</div>

<div class="card card-team">
    <div class="card-body">
        <div class="card-title">
            <h5 data-filter-by="text">Supervisor Details</h5>
        </div>
        {!! nl2br(e($item->supervisorDetails)) !!}
    </div>
</div>

<div class="card card-team">
    <div class="card-body">
        <div class="card-title">
            <h5 data-filter-by="text">Client Details</h5>
        </div>
        {!! nl2br(e($item->clientDetails)) !!}
    </div>
</div>
@endforeach

<!-- The Modal for editing a project -->
<div class="modal fade" id="edit_project">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h5 class="modal-title">Update Project</h5><br>

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
            <form method="POST" action="{{route('project.update', 'redirect')}}" class="was-validated">
                {{method_field('PATCH')}}
                {{ csrf_field() }}
                <div class="modal-body">
                    <input type="hidden" name="projectid" id="projectid" value="">
                    @include('project.overviewform')
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
    $('#edit_project').on('show.bs.modal', function (event) {

        var button = $(event.relatedTarget)
        var id = button.data('myid')
        var brief = button.data('brief')
        var milestones = button.data('milestones')
        var supervisor = button.data('mysupervisor')
        var client = button.data('myclient')
        var modal = $(this)

        modal.find('.modal-body #projectid').val(id);
        modal.find('.modal-body #brief').val(brief);
        modal.find('.modal-body #milestones').val(milestones);
        modal.find('.modal-body #supervisorDetails').val(supervisor);
        modal.find('.modal-body #clientDetails').val(client);


    })
</script>