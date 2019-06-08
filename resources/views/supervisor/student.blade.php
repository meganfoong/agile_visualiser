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
                    <th>Student ID</th>
                    <th>Name</th>
                    <th>PX History</th>
                </tr>
            </thead>

           

            <tbody id="myTable" bgcolor="white">
                <tr>
                    <td>18220197</td>
                    <td>Megan Foong</td>
                    <td><i></i></td>
                </tr>
                <tr>
                    <td>17072670</td>
                    <td>Derryn Alfred</td>
                    <td><a href="">project: vUWS (2018)</td>
                </tr>
                <tr>
                    <td>18603949</td>
                    <td>Jawad Shafiq</td>
                    <td></td>
                </tr>
                <tr>
                    <td>17764533</td>
                    <td>Jammy Leabres</td>
                    <td></td>
                </tr>
                <tr>
                    <td>18044889</td>
                    <td>Benan Ergen</td>
                    <td></td>
                </tr>
                <tr>
                    <td>18607420</td>
                    <td>Christopher Sabat</td>
                    <td></td>
                </tr>
                <tr>
                    <td>17344832</td>
                    <td>Han-Te Tsai</td>
                    <td><a href="">project: vUWS (2018)</td>
                </tr>
                <tr>
                    <td>18494626</td>
                    <td>Hussein Samman</td>
                    <td></td>
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
            @if(Session::has('message'))
                <p >{{ Session::get('message') }}</p>
            @endif

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