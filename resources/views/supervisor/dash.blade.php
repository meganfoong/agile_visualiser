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
                <input type="text" class="form-control" rows="1" name="comment_body" id="comment" placeholder="Enter new comment"></input>
                <input type="submit" value="Add comment" class="btn btn-basic">
            </li>
        </form>






    </ul>
</div>

<br>

<div class="row content-list-head">
    <div class="col-auto">
        <h3>Recent Activities</h3>

    </div>
    <form class="col">
        <div class="float-right">
            <div class="input-group input-group-round">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        <i class="material-icons">filter_list</i>
                    </span>
                </div>


                <input type="search" class="form-control filter-list-input" placeholder="Filter Activities"
                    aria-label="Filter ">
            </div>
        </div>
    </form>
</div>

<br>

<div class="card card-team">
    <ul class="list-group list-group-flush">
        <li class="list-group-item list-group-item-action"><b>Monday 13/05/19</b>
            <div class="float-right"><i class="material-icons">keyboard_arrow_up</i>

        <li class="list-group-item list-group-item-success">
            <i class="material-icons">assignment_turned_in</i>
            <b>Megan</b> marked <b>Introduction </b>as Complete
            <div class="float-right">10:00am</div>
        </li>

        <li class="list-group-item list-group-item-info">
            <i class="material-icons">thumb_up_alt</i>
            <b>Jawad </b>approved <b>Introduction </b>
            <div class="float-right">10:00am</div>
        </li>

        <li class="list-group-item list-group-item-info">
            <i class="material-icons">thumb_up_alt</i>
            <b>Jammy </b>approved <b>Introduction </b>
            <div class="float-right">10:00am</div>
        </li>

        <li class="list-group-item list-group-item-info">
            <i class="material-icons">thumb_up_alt</i>
            <b>Derryn</b> approved <b>Introduction </b>
            <div class="float-right">10:00am</div>
        </li>

        <li class="list-group-item list-group-item-primary">
            <i class="material-icons">thumb_up_alt</i>
            <b>Megan </b>approved <b>Introduction </b>
            <div class="float-right">10:00am</div>
        </li>

        <li class="list-group-item list-group-item-warning">
            <i class="material-icons">assignment</i>
            <b>Megan</b> marked <b>Executive Summary</b> as On Track
            <div class="float-right">09:15am</div>
        </li>

        <li class="list-group-item list-group-item-danger">
            <i class="material-icons">assignment_late</i>
            <b>Megan </b>marked <b>Executive Summary </b>as Off Track
            <div class="float-right">09:30am</div>
        </li>

        <li class="list-group-item list-group-item-primary">
            <i class="material-icons">assignment_ind</i>
            <b>Megan</b> assigned <b>Executive Summary</b>
            <div class="float-right">09:15am</div>
        </li>

        <li class="list-group-item list-group-item-secondary">
            <i class="material-icons">edit</i>
            <b>Megan </b>edited <b>Executive Summary</b>
            <div class="float-right">09:00am</div>
        </li>

        <li class="list-group-item list-group-item-secondary">
            <i class="material-icons">insert_drive_file</i>
            <b>Megan </b>created <b>Executive Summary</b>
            <div class="float-right">09:00am</div>
        </li>

        <li class="list-group-item list-group-item-dark">
            <i class="material-icons">work</i>
            <b>Megan </b>created <b>System Analysis & Design Report</b>
            <div class="float-right">09:00am</div>
        </li>
    </ul>
</div>

<br>

<div class="col-auto">
    <h3>Previous Activities</h3>

</div>
<br>
<div class="card card-team">
    <ul class="list-group list-group-flush">
        <li class="list-group-item list-group-item-action"><b>Sunday 12/05/19</b>
            <div class="float-right"><i class="material-icons">keyboard_arrow_down</i>
    </ul>
</div>

<div class="card card-team">
    <ul class="list-group list-group-flush">
        <li class="list-group-item list-group-item-action"><b>Saturday 11/05/19</b>
            <div class="float-right"><i class="material-icons">keyboard_arrow_down</i>
    </ul>
</div>