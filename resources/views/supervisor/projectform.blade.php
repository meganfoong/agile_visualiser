<div class="form-group">
    <label for="title">Title:</label>
    <input type="text" class="form-control form-control-sm" id="title" placeholder="Enter title" name="title" required>
    <div class="valid-feedback">
        Valid.
    </div>
    <div class="invalid-feedback">
        Please fill out this field.
    </div>
</div>
<div class="form-group">
    <label for="group">Group:</label>
    <input type="text" class="form-control form-control-sm" id="group" placeholder="Enter group" name="group" required>

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
    <label for="student[]">Students:</label>
    <select name="student[]" class="selectpicker" multiple>
        @foreach ($students as $user)
        @if ($user->is_supervisor == 0)
        <option value="{{$user->id}}" class="text-dark">{{$user->id}} - {{$user->first_name}}</option>
        {{-- <input type="checkbox" name="student[]" value="{{$user->id}}"> {{$user->first_name}}<br> --}}
        @endif
        @endforeach
    </select>
</div>