<div class="content-list-body row">
    <div class="col-auto">
        <h3>Current Projects</h3>


    </div>
    <div class="col-auto">
        <button type="button" class="btn btn-sm" data-toggle="modal" data-target="#new_project">
            <i class="material-icons">
                add
            </i>
        </button>
    </div>

    {{-- <div class="col float-right">
        <div class="float-right">
            <div class="input-group input-group-round">
                <div class="input-group-prepend" >
                    <span class="input-group-text" >
                        <i class="material-icons">filter_list</i>
                    </span>
                </div>
                <input type="search" class="form-control filter-list-input" placeholder="Filter Projects" aria-label="Filter Projects">
            </div>
        </div>
    </div> --}}
</div>

<br>

<!--end of content list head-->
<div class="content-list-body row">
    @foreach ($projects as $item)
    <div class="col-md-6">
        <div class="card card-team">
            <div class="progress">
                <div class="progress-bar bg-success" role="progressbar" style="width: 100%" aria-valuenow="100"
                    aria-valuemin="0" aria-valuemax="100"></div>
            </div>
            <div class="card-body">
                <button class="btn btn-sm float-right" type="button" data-toggle="collapse"
                    data-target="#collapseFooter{{ $item->id }}" aria-expanded="false" aria-controls="collapseFooter">
                    <i class="material-icons">
                        more_vert
                    </i>
                </button>

                <div class="card-title">
                    <a href="{{ URL::to('project', $item->id) }}">
                        <h5 data-filter-by="text">{{$item->title}}</h5>
                    </a>
                    <span>{{$item->group}}</span>

                </div>

                <div>
                    <span>Start: {{$item->startDate}} End: {{$item->endDate}}</span>
                </div>

                <ul class="avatars">
                    @foreach ($item->users as $assign)
                    <li>
                        @if ($assign->is_supervisor == 0)
                        <img alt="" class="avatar"
                            src="https://ui-avatars.com/api/?name={{$assign->first_name}}+{{$assign->last_name}}&rounded=true&size=25" />
                        {{$assign->first_name}}
                        @endif
                    </li>
                    @endforeach
                </ul>
            </div>

            <div class="card-footer collapse" id="collapseFooter{{ $item->id }}">
                <button type="button" data-myid="{{$item->id}}" data-mytitle="{{$item->title}}"
                    data-mygroup="{{$item->group}}" data-startDate="{{$item->startDate}}"
                    data-endDate="{{$item->endDate}}" class="btn btn-sm" data-toggle="modal"
                    data-target="#edit_project">
                    <i class="material-icons">
                        edit
                    </i>
                </button>

                <button type="button" class="btn btn-sm float-right" data-myid="{{$item->id}}" data-toggle="modal"
                    data-target="#delete_project">
                    <i class="material-icons">
                        delete
                    </i>
                </button>
            </div>
        </div>
    </div>
    @endforeach
</div>

<br>
{{-- 
<div class="row content-list-head">
    <div class="col">
        <h3>Past Projects</h3>
    </div>

    <div class="col">
        <div class="float-right">

            <i class="material-icons" onclick="myFunction()">visibility_off</i>
        </div>
    </div>
</div>

<br>

<div id="myDIV">
    <div class="content-list-body row">
        <div class="col-md-6">
            <div class="lock">
                <div id="overlay" onclick="off()">
                </div>
                <div class="card card-team">
                    <div class="progress">
                        <div class="progress-bar bg-danger" role="progressbar" style="width: 100%" aria-valuenow="100"
                            aria-valuemin="0" aria-valuemax="100">
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="card-options">
                            <i class="material-icons" onclick="on()">lock</i>
                        </div>
                        <div class="card-title">
                            <a href="#">
                                <h5 data-filter-by="text">Project vUWS</h5>
                            </a>
                            <span>PA0001</span>
                        </div>
                        <ul class="avatars">
                            <li>
                                <a href="#" data-toggle="tooltip" title="">
                                    <img alt="Derryn" class="avatar" src=".jpg" />
                                </a>
                            </li>

                            <li>
                                <a href="#" data-toggle="tooltip" title="">
                                    <img alt="Han-te" class="avatar" src=".jpg" />
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> --}}

<!-- The Modal for adding a project -->
<div class="modal fade" id="new_project">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h5 class="modal-title">New Project</h5><br>

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
            <form method="POST" action="{{route('project.store')}}" class="was-validated">
                {{ csrf_field() }}
                <div class="modal-body">
                    @include('supervisor.projectform')
                    <input type="hidden" name="student[]" value="{{ Auth::user()->id }} ">
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
                    <input type="hidden" name="student[]" value="{{Auth::user()->id}}">
                    @include('supervisor.projectform')
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
<div class="modal fade" id="delete_project">
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
            <form method="POST" action="{{route('project.destroy', 'redirect')}}" class="was-validated">
                {{method_field('delete')}}
                {{ csrf_field() }}
                <div class="modal-body">
                    <h3>Are you sure you want to delete project?</h3>
                    <input type="hidden" name="projectid" id="projectid" value="">
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
        var title = button.data('mytitle')
        var group = button.data('mygroup')
        var startDate = button.data('startDate')
        var endDate = button.data('endDate')
        var modal = $(this)

        modal.find('.modal-body #projectid').val(id);
        modal.find('.modal-body #title').val(title);
        modal.find('.modal-body #group').val(group);
        modal.find('.modal-body #startDate').val(startDate);
        modal.find('.modal-body #endDate').val(endDate);


    })


    $('#delete_project').on('show.bs.modal', function (event) {

        var button = $(event.relatedTarget)

        var id = button.data('myid')
        var modal = $(this)

        modal.find('.modal-body #projectid').val(id);
    }) 
</script>