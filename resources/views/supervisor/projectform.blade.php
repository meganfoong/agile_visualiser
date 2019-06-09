<ul class="nav nav-tabs justify-content-center">
    <li class="nav-item">
        <a class="nav-link active" id="nav-project_details-tab" data-toggle="tab" href="#project_details" role="tab"
            aria-controls="project_details" aria-selected="true">
            Details
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-item nav-link" id="nav-project_student-tab" data-toggle="tab" href="#project_students" role="tab"
            aria-controls="project_studentst" aria-selected="false">
            Students
        </a>
    </li>
</ul>

<br>

<div class="tab-content" id="myTabContent">
    <!-- Details tab starts here -->
    <div class="tab-pane fade show active" id="project_details" role="tabpanel"
        aria-labelledby="nav-project_details-tab">
        <div class="form-group">
            <label for="title">Title:</label>
            <input type="text" class="form-control form-control-sm" id="title" placeholder="Enter title" name="title"
                required>

            <div class="valid-feedback">
                Valid.
            </div>
            <div class="invalid-feedback">
                Please fill out this field.
            </div>
        </div>
        <div class="form-group">
            <label for="group">Group:</label>
            <input type="text" class="form-control form-control-sm" id="group" placeholder="Enter group" name="group"
                required>

            <div class="valid-feedback">
                Valid.
            </div>
            <div class="invalid-feedback">
                Please fill out this field.
            </div>
        </div>
        <div class="form-group">
            <label for="startDate">Start Date:</label>
            <input type="date" class="form-control form-control-sm" id="startDate" name="startDate">
        </div>
        <div class="form-group">
            <label for="endDate">End Date:</label>
            <input type="date" class="form-control form-control-sm" id="endDate" name="endDate">
        </div>
        <div class="form-group">
                <select name="student[]" class="selectpicker" multiple>
                @foreach ($users as $user)
                    @if ($user->is_supervisor == 0) 
                    <option value="{{$user->id}}" class="text-dark">{{$user->first_name}}</option> 
                    {{-- <input type="checkbox" name="student[]" value="{{$user->id}}"> {{$user->first_name}}<br> --}}
                    @endif
                @endforeach
                </select>
            </div>
    </div>
    <!-- Details end -->

    <!-- Student tab starts here -->
    <div class="tab-pane fade" id="project_students" role="tabpanel" aria-labelledby="nav-project_students-tab">
        <input class="form-control" id="myInput" type="text" placeholder="Filter Students">
        <br>
        <div class="form-group">
            <select name="student[]" class="selectpicker" multiple>
            @foreach ($users as $user)
                @if ($user->is_supervisor == 0) 
                <option value="{{$user->id}}" class="text-dark">{{$user->first_name}}</option> 
                {{-- <input type="checkbox" name="student[]" value="{{$user->id}}"> {{$user->first_name}}<br> --}}
                @endif
            @endforeach
            </select>
        </div>
    </div>
    <!-- Student end -->
</div>