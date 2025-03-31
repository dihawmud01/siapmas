@push("script")
    @vite("resources/js/plugins/filepond.js")
@endpush

<div class="d-flex align-items-center mb-4">
    <label for="{{ $name }}" class="form-label label me-3 text-start">
        {{ $label }}
        @if ($required)
            <span class="text-danger">*</span>
        @endif
    </label>
    <div class="d-flex flex-column w-100">
        <input
            type="{{ $type }}"
            class="form-control sp-input @error($name) is-invalid @enderror"
            name="{{ $name }}"
            placeholder="{{ $placeholder }}"
            value="{{ $type != "file" ? old($name, $value) : "" }}"
            @if ($type == "file")
                accept="{{ $accept }}"
            @endif
            @if ($type == "number")
                min="{{ $min }}"
                max="{{ $max }}"
            @endif
            {{ $required ? "required" : "" }}
        />

        @if ($type == "file")
            <small class="text-muted">
                {{ __("Maks. 2 MB | Format") }}

                @switch($accept)
                    @case("application/pdf")
                        <span>{{ __(".pdf") }}</span>

                        @break
                    @case("image/jpeg,image/png")
                        <span>{{ __(".jpg, .jpeg, atau .png") }}</span>

                        @break
                    @case("application/vnd.openxmlformats-officedocument.wordprocessingml.document")
                        <span>{{ __(".docx") }}</span>

                        @break
                @endswitch
            </small>
        @endif

        @error($name)
            <div class="invalid-feedback d-block" role="alert">{{ $message }}</div>
        @enderror
    </div>
</div>