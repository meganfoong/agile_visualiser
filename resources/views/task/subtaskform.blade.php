<div class="form-group">
    <label for="uname">Title:</label>
    <input type="text" class="form-control form-control-sm" id="title" placeholder="Title" name="title" required>
    <div class="valid-feedback">Valid.</div>
    <div class="invalid-feedback">Please fill out this field. </div>
</div>

<div class="form-group">
    <label for="description">Description:</label>
    <textarea class="form-control" rows="2" id="des" name="description"></textarea>
</div>

<div class="form-group">
    <input type="hidden" name="status" id="status" value="dark">
</div>

{{-- 
<div class="form-group">
    <label for="startDate">Start Date:</label>
    <input type="date" class="form-control form-control-sm" id="startDate" name="startDate">
</div>

<div class="form-group">
    <label for="dueDate">Due Date:</label>
    <input type="date" class="form-control form-control-sm" id="dueDate" name="dueDate">
</div> --}}


{{-- <div class="form-group">
    <label for="assign">Assign:</label>
    <select name="assign" class="custom-select custom-select-sm">
        @foreach ($aid as $item)
        @if ($item->is_supervisor == 0)
        <option value="{{$item->id}}" class="text-dark">{{$item->first_name}}</option>
        @endif
        @endforeach
    </select>
</div> --}}

<!-- <div class="form-check-inline">
    <div class="custom-control custom-checkbox mb-6">
        <input type="checkbox" class="custom-control-input" id="assign" name="assign" value="assigned">
        <label class="custom-control-label" for="assign">Assign Task</label>
    </div>
</div> -->

<!-- <div class="form-check-inline">
    <div class="custom-control custom-checkbox mb-6">
        <input type="checkbox" class="custom-control-input" id="approve" name="approve" value="approved">
        <label class="custom-control-label" for="approve">Approve Task</label>
    </div>
</div> -->