<div class="d-flex align-items-start mb-4" x-data="{ inputs: [''], maxCount: {{ $count }} }">
    <label class="form-label label me-3 text-start">{{ $label }}</label>

    <div class="d-flex flex-column w-100">
        <template x-for="(input, idx) in inputs" :key="idx">
            <div class="input-group mb-2">
                <input
                    type="text"
                    class="form-control @error($name) is-invalid @enderror sp-input rounded-start"
                    name="{{ $name }}[]"
                    x-model="inputs[idx]"
                    required
                />

                <button
                    type="button"
                    class="btn btn-danger rounded-end"
                    @click="inputs.splice(idx, 1)"
                    x-show="idx > 0"
                >
                    <i class="bi bi-dash"></i>
                </button>
            </div>
        </template>

        <div class="mt-1">
            <button
                type="button"
                class="btn btn-sm btn-success"
                @click="if (inputs.length < maxCount) inputs.push('')"
                :disabled="inputs.length >= maxCount"
            >
                <i class="bi bi-person-plus-fill"></i>
                {{ __('Tambah') }}
            </button>
        </div>
    </div>
</div>
