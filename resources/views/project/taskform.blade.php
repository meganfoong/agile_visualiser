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


{{-- <div class="form-group">
    <label for="status">Status:</label>
    <select name="status" class="custom-select custom-select-sm">
        <option value="dark" class="text-dark">Select</option>
        <option value="success" class="text-success">Complete</option>
        <option value="warning" class="text-warning">On Track</option>
        <option value="danger" class="text-danger">Off Track</option>
    </select>
</div> --}}

<div class="form-group">
    <label for="startDate">Start Date:</label>
    <input type="date" class="form-control form-control-sm" id="startDate" name="startDate">
</div>
<div class="form-group">
    <label for="dueDate">Due Date:</label>
    <input type="date" class="form-control form-control-sm" id="dueDate" name="dueDate">
</div>