<div class="row content-list-head">
    <div class="col-auto">
        <h3>Student List</h3>
    </div>
    <button type="button" class="btn btn-sm" data-toggle="modal" data-target="#new_student">
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


                <input type="search" class="form-control filter-list-input" placeholder="Filter Students"
                    aria-label="Filter Students" id="myInput">
            </div>
        </div>
    </form>
</div>
<br>
<div class="card card-team">
    <div class="card-body">

        <table class="table table-hover table-borderless table-sm">
            <thead>
                <tr>
                    <th>Student</th>
                    <th>Name</th>
                    <th>PX History</th>
                </tr>
            </thead>
     
            <tbody id="myTable" bgcolor="white">
            @foreach ($students as $student)
                <tr>    
                   
                    <td>{{$student->userid}}</td>
                    <td>{{$student->first_name}} {{$student->last_name}}</td>
                    <td><i></i></td>
                    
                </tr>
            @endforeach
                <tr>
                    <td>18220197</td>
                    <td>Megan Foong</td>
                    <td><i></i></td>
                </tr>
                
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
                <h5 class="modal-title">Add students using CSV</h5><br>

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
        <!-- CSV Message -->
        <div>
            

            <!--CSV  Form -->
            <form method='post' action='/uploadFile' enctype='multipart/form-data' >
                {{ csrf_field() }}
                <input type='file' name='file' >
                <input type='submit' name='submit' value='Import'>
            </form>
        </div>

        </div>
    </div>
</div>