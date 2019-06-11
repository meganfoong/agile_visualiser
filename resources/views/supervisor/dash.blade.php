@if(Session::has('message'))
<div class="alert alert-success">
    <p>{{ Session::get('message') }}</p>
</div>
@endif
<div class="row content-list-head">

    <div class="col-auto">
        @if (!empty($comments) ?? !empty($activities))
        <h3>Dashboard for {{$title}}</h3>
        @else
        <h3>Dashboard</h3>
        @endif
    </div>

    <div class="col-auto">
        <button type="button" class="btn btn-sm" data-toggle="modal" data-target="#choose_project">
            <i class="material-icons">
                search
            </i>
        </button>
    </div>

</div>


@if (!empty($comments))
<div class="card card-team">
    <ul class="list-group list-group-flush">
        <li class="list-group-item list-group-item-action">
            <b>Comments</b>
            <div class="float-right">
                <i class="material-icons">keyboard_arrow_up</i>
            </div>
        </li>
    </ul>
    <ul class="list-group list-group-flush" style="height: 250px; overflow-y: scroll;" id='comment'>
        @foreach ($comments as $item)
        <li class="list-group-item list-group-item-secondary">
            @foreach ($uid as $user)
            @if ($user->id == $item->user_id)
            <img class="mr-8"
                src="https://ui-avatars.com/api/?name={{$user->first_name}}+{{$user->last_name}}&rounded=true&size=25" />
            <b>{{$user->first_name}}: </b>
            @endif
            @endforeach

            <i>{{$item->body}}</i>
            <div class="float-right">
                {{$item->created_at}}
            </div>
        </li>
        @endforeach
    </ul>
    <ul class="list-group">
        <form method="post" action="{{route('project.store')}}">
            @csrf
            <li class="list-group-item list-group-item-light">
                <input type="hidden" name="project_id" id="project_id" value="{{$pid}}">
                <input type="hidden" name="user_id" id="user_id" value="{{Auth::user()->id}}">
                <input type="hidden" name="store" id="store" value="1">
                <div class="row">

                    <div class="col-lg">
                        <input type="text" name="body" class="form-control" rows="2" placeholder="Enter new comment">
                    </div>
                    <div class="col-auto float-right">
                        <button type="submit" class="btn btn-sm">
                            <i class="material-icons">
                                send
                            </i>
                        </button>
                    </div>
                </div>
            </li>
        </form>
    </ul>
</div>
@endif
@if (!empty($activities))
<div class="card card-team">
    <ul class="list-group list-group-flush" style="height: 1000px; overflow-y: scroll;" id='comment'>
        <li class="list-group-item list-group-item-action"><b>Activities</b>
            <div class="float-right"><i class="material-icons">keyboard_arrow_up</i>

                @foreach ($activities as $item)
        <li class="list-group-item list-group-item-{{$item->type}}">

            <i class="material-icons">account_circle</i>
            {{$item->body}}
            <div class="float-right">{{$item->created_at}}</div>
        </li>
        @endforeach
    </ul>
</div>
@endif

<script>
    var comment = document.getElementById("comment");
        comment.scrollTop = objDiv.scrollHeight;
    
        var activity = document.getElementById("activity");
        activity.scrollTop = objDiv.scrollHeight;
    
</script>


<!-- The Modal for choosing a project dash -->
<div class="modal fade" id="choose_project">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h5 class="modal-title">Choose Project</h5><br>

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