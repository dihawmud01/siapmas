@push('script')
    @vite('resources/js/plugins/filepond.js')
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
            type="file"
            class="form-control sp-input @error($name) is-invalid @enderror"
            name="{{ $name }}[]"
            accept="{{ $accept }}"
            multiple
            {{ $required ? 'required' : '' }}
        />
        <small class="text-muted">
            {{ __('Maks. 2 MB tiap file | Format ') . ($accept == 'application/pdf' ? '.pdf' : '.docx, .jpg, .jpeg, atau .png') }}
        </small>

        @error($name)
            <div class="invalid-feedback d-block" role="alert">{{ $message }}</div>
        @enderror
    </div>
</div>