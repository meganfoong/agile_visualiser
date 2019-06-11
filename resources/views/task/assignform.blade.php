<div class="form-group">
    <label for="assign">Assign:</label>
    <select name="assign" class="custom-select custom-select-sm">
        @foreach ($aid as $item)
        @if ($item->is_supervisor == 0)
        <option value="{{$item->id}}" class="text-dark">{{$item->first_name}}</option>
        @endif
        @endforeach
    </select>
</div>