@push('script')
    @vite('resources/js/plugins/filepond.js')
@endpush

<div class="d-flex align-items-center mb-4">
    <label for="{{ $name }}" class="form-label sp-label me-3 text-start">{{ $label }}</label>
    <div class="d-flex flex-column w-100">
        <input
            type="file"
            class="form-control sp-input @error($name) is-invalid @enderror"
            name="{{ $name }}[]"
            accept="{{ $accept }}"
            multiple
            required
        />
        <small class="text-muted">
            {{ __('Maks. 10 MB tiap file | Format .docx, .jpg, .jpeg, .png, atau .mp4') }}
        </small>
    </div>
    <span class="error invalid-feedback">{{ $errors->first($name) }}</span>
</div>
