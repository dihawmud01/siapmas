@section('title')
    {{ __('Postingan') }}
@endsection

@extends('admins.layout')
@section('content')
    <div class="card info-card sales-card">
        <div class="container">
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">{{ __('Postingan') }} "{{ $post->title }}"</h3>
                                </div>

                                <form
                                    role="form"
                                    method="post"
                                    action="{{ route('news.update', $post->id) }}"
                                    enctype="multipart/form-data"
                                >
                                    @csrf
                                    @method('PUT')
                                    <div class="card-body">
                                        @include('admins.news.form')
                                    </div>

                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-primary">{{ __('Simpan') }}</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
@endsection
