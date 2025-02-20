@push("script")
    @vite("resources/js/plugins/filepond.js")
@endpush

<div class="d-flex align-items-center mb-4">
    <label for="{{ $name }}" class="form-label sp-label me-3 text-start">{{ $label }}</label>
    <div class="d-flex flex-column w-100">
        <input
            type="{{ $type }}"
            class="form-control sp-input @error($name) is-invalid @enderror"
            name="{{ $name }}"
            @if ($type != "file")
                value="{{ old($name, $value) }}"
            @else
                accept="{{ $accept }}"
            @endif
            required
        />

        @if ($type == "file")
            <small class="text-muted">
                {{ __("Maks. 10 MB | Format") }}

                @switch($accept)
                    @case("application/pdf")
                        <span>{{ __(".pdf") }}</span>

                        @break
                    @case("application/vnd.openxmlformats-officedocument.wordprocessingml.document")
                        <span>{{ __(".docx") }}</span>

                        @break
                @endswitch
            </small>
        @endif
    </div>
    <span class="error invalid-feedback">{{ $errors->first($name) }}</span>
</div>
