@props(['name', 'value'])

<select id="{{ $name }}" name="{{ $name }}" class="form-select mb-1">
    <option value="" @if ($value == '') selected @endif>Sélectionner</option>
    <option value="yes" @if ($value == 'yes') selected @endif>YES</option>
    <option value="no" @if ($value == 'no') selected @endif>NO</option>
    <option value="nr" @if ($value == 'nr') selected @endif>Non renseigné</option>
</select>