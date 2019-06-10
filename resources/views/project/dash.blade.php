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

        <form method="post" action="{{ route('comment.add') }}">
            @csrf
            <li class="list-group-item list-group-item-light">
                <input type="text" class="form-control" rows="1" name="comment_body" id="comment"
                    placeholder="Enter new comment">
                <input type="submit" value="Add comment" class="btn btn-basic">
            </li>
        </form>
    </ul>
</div>