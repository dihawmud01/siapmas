<div class="d-flex align-items-center mb-4">
    <label for="{{ $name }}" class="form-label label me-3 text-start">
        {{ $label }}
        <span class="text-danger">*</span>
    </label>
    <div class="d-flex flex-column w-100">
        <select
            name="{{ $name }}"
            id="{{ $name }}"
            class="@error($name) is-invalid @enderror form-select"
            {{ $required ? 'required' : '' }}
        >
            <option value="" disabled selected>{{ __('-- Pilih --') }}</option>
            @foreach ($options as $value => $optionLabel)
                <option value="{{ $value }}" {{ old($name, $selected) == $value ? 'selected' : '' }}>
                    {{ $optionLabel }}
                </option>
            @endforeach
        </select>

        @error($name)
            <div class="invalid-feedback d-block" role="alert">{{ $message }}</div>
        @enderror
    </div>
</div>
