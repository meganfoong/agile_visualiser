<div class="row content-list-head">
    <div class="col-auto">
        <h3>Student List</h3>
    </div>
    <button type="button" class="btn btn-sm" data-toggle="modal" data-target="#new_student">
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
                <input type="search" class="form-control filter-list-input" placeholder="Filter Students"
                    aria-label="Filter Students" id="myInput">
            </div>
        </div>
    </form> --}}
</div>
<br>
<div class="card card-team">
    <div class="card-body">
        <table class="table table-hover table-borderless table-sm">
            <thead>
                <tr>
                    <th>Student ID</th>
                    <th>Name</th>
                    <th>PX History</th>
                </tr>
            </thead>

            <tbody id="myTable">
                @foreach ($students as $student)
                <tr>
                    <td>{{$student->id}}</td>
                    <td>{{$student->first_name}} {{$student->last_name}}</td>
                    <td><i></i></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- The Modal for adding students -->
<div class="modal fade" id="new_student">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h5 class="modal-title">Add students</h5><br>

                <div class="modal-options">
                    <button type="button" class="btn btn-outline-danger btn-sm" data-dismiss="modal">
                        <i class="material-icons">
                            close
                        </i>
                        <br>
                    </button>
                </div>
            </div>

            <form method='post' action='{{route('supervisor.store')}}' enctype='multipart/form-data'>
                {{ csrf_field() }}

                <div class="modal-body">
                    <h5>Upload CSV file to add students</h5>

                </div>


                <!-- Modal footer -->
                <div class="modal-footer">
                    <div class="input-group">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name='file' id="file" aria-describedby="file">
                            <label class="custom-file-label" for="file">Choose file</label>
                        </div>
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary" type='submit' name='submit' value='Import'>
                                Upload
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>