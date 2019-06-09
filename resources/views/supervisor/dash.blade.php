@if(Session::has('message'))
                <div class="alert alert-success"><p>{{ Session::get('message') }}</p></div>
            @endif
<div class="row content-list-head">

    <div class="col-auto">
        
        
            <h3>Comments</h3>
    </div>

</div>

<br>

<div class="card card-team">
    <ul class="list-group list-group-flush">
        <li class="list-group-item list-group-item-action"><b>Recent Comments</b>
            <div class="float-right"><i class="material-icons">keyboard_arrow_up</i>
        
        
        @foreach($comments as $comment)
            <li class="list-group-item list-group-item-dark">
                <i class="material-icons">mode_comment</i>
                <b>{{ $comment->first_name }}</b> <i>{{ $comment->body }}</i>
                <div class="float-right">{{ $comment->created_at }}<input type="submit" value="Reply" class="btn btn-basic"></div>
            </li>
        @endforeach
        
        <form method="post" action="{{ route('comment.add') }}">
            @csrf
            <li class="list-group-item list-group-item-light">
                <input type="text" class="form-control" rows="1" name="comment_body" id="comment" placeholder="Enter new comment">
                <input type="submit" value="Add comment" class="btn btn-basic">
            </li>
        </form>

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