<div class="row content-list-head">
    <div class="col-auto">
        <h3>Dashboard</h3>


    </div>

    <div class="col-auto">
        <button type="button" class="btn btn-sm" data-toggle="modal" data-target="#choose_project">
            <i class="material-icons">
                more_vert
            </i>
        </button>
    </div>




</div>

<!-- The Modal for adding a project -->
<div class="modal fade" id="choose_project">
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
            <form method="POST" action="{{route('supervisor.store')}}" class="was-validated">
                {{ csrf_field() }}
                <div class="modal-body">
                    <div class="col-auto">
                        <div class="form-group">
                            <label for="project">Project:</label>
                            <select name="projectid" id="projectid" class="custom-select custom-select-sm">
                                @foreach ($projects as $item)
                                <option value="{{$item->id}}" class="text-dark">{{$item->title}}</option>
                                @endforeach
                            </select>
                        </div>
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