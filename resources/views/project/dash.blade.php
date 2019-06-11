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
                        <input type="text" class="form-control" rows="2" placeholder="Enter new comment">
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

<script>
    var objDiv = document.getElementById("comment");
objDiv.scrollTop = objDiv.scrollHeight;

</script>