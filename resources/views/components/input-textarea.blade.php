<div class="d-flex align-items-start mb-4">
    <label for="{{ $name }}" class="form-label label me-3 text-start">
        {{ $label }}
    </label>
    <div class="d-flex flex-column w-100">
        <textarea
            name="{{ $name }}"
            id="{{ $name }}"
            class="form-control @error($name) is-invalid @enderror"
            rows="{{ $rows }}"
        >
{{ $value }}</textarea
        >

        @error($name)
            <div class="invalid-feedback d-block" role="alert">{{ $message }}</div>
        @enderror
    </div>
</div>
