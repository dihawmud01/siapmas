<div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
    <label for="title">{{ __('Judul') }}</label>
    <input type="text" name="title"
           class="form-control @error('title') is-invalid @enderror" id="title"
           placeholder="Title"
           @if(isset($post->title))value="{{ $post->title }}@endif">
    @if ($errors->has('title'))
        <span class="help-block">
              <strong class="text-danger">{{ $errors->first('title') }}</strong>
      </span>
    @endif
</div>

<div class="form-group{{ $errors->has('content') ? ' has-error' : '' }}">
    <label for="content">{{ __('Konten') }}</label>
    <textarea name="content" class="form-control @error('content') is-invalid @enderror" id="content" rows="7"
              placeholder="Content ...">@if(isset($post->content))
            {{ $post->content }}
        @endif</textarea>
    @if ($errors->has('content'))
        <span class="help-block">
          <strong class="text-danger">{{ $errors->first('content') }}</strong>
      </span>
    @endif
</div>

<div class="{{ $errors->has('category_id') ? ' has-error' : '' }}">
    <label for="category_id">{{ __('Kategori') }}</label>
    <select class="form-control @error('category_id') is-invalid @enderror" id="categoryId" name="category_id">
        @foreach($categories as $key => $value)
            <option value="{{ $key }}"
                    @if(isset($post))
                        @if($key === $post->category_id) selected
                @endif
                @endif>
                {{ $value }}
            </option>
        @endforeach
    </select>
    @if ($errors->has('category_id'))
        <span class="help-block">
          <strong class="text-danger">{{ $errors->first('categories') }}</strong>
      </span>
    @endif
</div>

<div class="row mb-3">
    <legend class="col-form-label col-sm-2 pt-0">{{ __('Tag') }}</legend>
    <div class="col-sm-10">
        @foreach($tags as $key => $value)
            <div class="form-check">
                <input name="tags[]" class="form-check-input" type="checkbox" id="gridCheck1" value="{{ $key }}"
                       @if(isset($post))
                           @if(in_array($key, $post->tags->pluck('id')->all(), true)) checked @endif
                    @endif ><label class="form-check-label" for="gridCheck1">
                    {{ $value }}
                </label>
            </div>
        @endforeach
    </div>
</div>

<div class="form-group{{ $errors->has('images') ? ' has-error ':''}}">
    <div class="input-group">
        <div class="custom-file">
            <label class="custom-file-label" for="img">{{ __('Gambar') }}</label>
            <input type="file" name="img" class="form-control mb-3" id="img">
        </div>
    </div>
    @if(isset($post) && $post->img !== null)
        <img id="previewImg"
             src="{{ asset('storage/images/' . $post->img) }}"
             class="img-thumbnail mt-2"
             height="150"
             width="150"
             alt="..." />
    @endif
    @if ($errors->has('images'))
        <span class="help-block">
          <strong class="text-danger">{{ $errors->first('images') }}</strong>
      </span>
    @endif
</div>


@auth
    @if (in_array(auth()->user()->role_id, [1, 2]))
        <div class="form-group">
            <label>{{ __('Akitf: *') }}</label>
            <label class="radio-inline">
                <input id="yes" name="active" type="radio" value="1" @if(isset($post->active))
                    @checked($post->active === 1)
                    @endif> {{ __('Iya') }}
            </label>
            <label class="radio-inline">
                <input id="no" name="active" type="radio" value="0" checked @if(isset($post->active))
                    @checked($post->active === 0)
                    @endif> {{ __('Tidak') }}
            </label>
        </div>
    @endif
@endauth
