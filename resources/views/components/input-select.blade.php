<div class="d-flex align-items-center mb-4">
    <label for="{{ $name }}" class="form-label label me-3 text-start">{{ $label }}</label>
    <div class="d-flex flex-column w-100">
        <select
            name="{{ $name }}"
            id="{{ $name }}"
            class="@error($name) is-invalid @enderror form-select"
        >
            <option value="" disabled selected>{{ __('-- Pilih --') }}</option>
            @foreach ($options as $value => $text)
                <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }}>
                    {{ $text }}
                </option>
            @endforeach
        </select>
    </div>

    <span class="error invalid-feedback">{{ $errors->first($name) }}</span>
</div>
