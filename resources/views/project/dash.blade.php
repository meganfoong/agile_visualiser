<div class="card card-team">
    <ul class="list-group list-group-flush">
        <li class="list-group-item list-group-item-action">
            <b>Recent Comments</b>
            <div class="float-right">
                <i class="material-icons">keyboard_arrow_up</i>
            </div>
        </li>
        @foreach ($comments as $item)
        <li class="list-group-item list-group-item-dark">
            <i class="material-icons">mode_comment</i>
            
            <b></b> 
           
            
            <i>{{$item->body}}</i>
            <div class="float-right">Just now</div>
        </li>
        @endforeach

        <form method="post" action="">
            @csrf
            <li class="list-group-item list-group-item-light">
                <input type="hidden" name="project_id" id="project_id" value="">
                <input type="hidden" name="user_id" id="user_id" value="{{Auth::user()->id}}">
                <input type="text" class="form-control" rows="1" name="comment_body" id="comment"
                    placeholder="Enter new comment">
                <input type="submit" value="Add comment" class="btn btn-basic">
            </li>
        </form>
    </ul>
</div>