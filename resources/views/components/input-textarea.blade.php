<div class="d-flex align-items-start mb-4">
    <label for="{{ $name }}" class="form-label label me-3 text-start">{{ $label }}</label>
    <div class="d-flex flex-column w-100">
        <textarea
            name="{{ $name }}"
            id="{{ $name }}"
            class="form-control @error($name) is-invalid @enderror"
            rows="{{ $rows }}"
        >
{{ $value }}</textarea
        >
    </div>
    <span class="error invalid-feedback">{{ $errors->first($name) }}</span>
</div>
