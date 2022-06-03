@props(['name'])

<label for="{{ $name }}" class="col-3 col-form-label">
    <b>{{ $slot }}</b>
</label>