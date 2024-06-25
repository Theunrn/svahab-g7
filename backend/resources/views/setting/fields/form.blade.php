<div class="form-group">
    <label for="field_name">Field Name:</label>
    <input type="text" class="form-control" id="field_name" name="field_name" value="{{ old('field_name', $field->field_name) }}">
</div>

<div class="form-group">
    <label for="field_location">Field Location:</label>
    <input type="text" class="form-control" id="field_location" name="field_location" value="{{ old('field_location', $field->field_location) }}">
</div>

<div class="form-group">
    <label for="field_type">Field Type:</label>
    <input type="text" class="form-control" id="field_type" name="field_type" value="{{ old('field_type', $field->field_type) }}">
</div>

<div class="form-group">
    <label for="field_size">Field Size:</label>
    <input type="number" class="form-control" id="field_size" name="field_size" value="{{ old('field_size', $field->field_size) }}">
</div>

<div class="form-group">
    <label for="number_of_players">Number of Players:</label>
    <input type="number" class="form-control" id="number_of_players" name="number_of_players" value="{{ old('number_of_players', $field->number_of_players) }}">
</div>

<div class="form-group">
    <label for="lighting_availability">Lighting Availability:</label>
    <input type="text" class="form-control" id="lighting_availability" name="lighting_availability" value="{{ old('lighting_availability', $field->lighting_availability) }}">
</div>