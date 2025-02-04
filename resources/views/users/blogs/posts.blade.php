@section('title')
    {{ __('Blog') }}
@endsection

@extends('users.layout')
@section('content')
    <div class="container mt-5 pt-5">
        <div class="row">
            <div class="col-lg-8">
                <article class="my-5">
                    <header class="mb-4">
                        @if ($posts->img)
                            <figure class="mb-4">
                                <img
                                        class="img-fluid rounded"
                                        src="{{ asset('storage/images/' . $posts->img) }}"
                                        alt="{{ __('Gambar Dari') }} {{ $posts->title }}"
                                />
                            </figure>
                        @endif

                        <h1 class="fw-bolder mb-1">{{ $posts->title }}</h1>
                        <div class="text-muted my-2">
                            <i class="bi bi-clock"></i>
                            {{ $posts->created_at->diffForHumans() }}
                            <i class="bi bi-person-fill mx-2">{{ __('Diunggah oleh:') }}</i>
                            <a href="{{ route('profile.user', ['slug' => $posts->user->slug]) }}">
                                {{ $posts->user->username }}
                                @if ($posts->user->centang == '1')
                                    <i class="fas fa-check-circle text-primary"></i>
                                @endif
                            </a>
                            <i class="bi bi-eye-fill mx-2">{{ __('Dilihat:') }}</i>
                            {{ $posts->viewed }} {{ __('kali') }}
                        </div>
                    </header>

                    <section class="mb-5">
                        <div class="card bg-light">
                            <div class="card-body" style="color: black">
                                <p class="fs-5 mb-4">
                                    {!! $posts->content !!}
                                </p>
                            </div>
                        </div>
                    </section>
                    @if ($posts->tags->count())
                        <i class="bi bi-tags"></i>
                        {{ __('Tags:') }}
                        @foreach ($posts->tags as $tag)
                            <a
                                    class="badge bg-secondary text-decoration-none link-light"
                                    href="{{ route('tag', ['slug' => $tag->slug]) }}"
                            >
                                {{ $tag->title }}
                            </a>
                        @endforeach
                    @endif
                </article>

                <div class="row pt-30 justify-center">
                    <div class="col-xl-8 col-lg-9 col-md-11">
                        <div class="row y-gap-20 items-center justify-between">
                            <div class="col-auto">
                                <div class="d-flex items-center">
                                    <div class="lh-1 text-dark-1 fw-500 mr-20">{{ __('Bagikan') }}</div>
                                    <div class="d-flex x-gap-15">
                                        <a
                                                target="_blank"
                                                href="https://www.facebook.com/sharer.php?u={{ route('posts.detail', ['slug' => $posts->slug]) }}"
                                                title="{{ __('Bagikan via Facebook') }}"
                                        >
                                            <i
                                                    class="fab fa-facebook-f btn btn-success sm-btn mb-2 ml-3 rounded pl-2 pr-2"
                                            ></i>
                                        </a>
                                        <a
                                                target="_blank"
                                                href="https://api.whatsapp.com/send?text={{ route('posts.detail', ['slug' => $posts->slug] }}&title={{ $posts->title }}"
                                                title="{{ __('Bagikan via WhatsApp') }}"
                                        >
                                            <i
                                                    class="fab fa-whatsapp btn btn-success sm-btn mb-2 ml-3 rounded pl-2 pr-2"
                                            ></i>
                                        </a>
                                        <a
                                                target="_blank"
                                                href="https://twitter.com/share?url={{ route('posts.detail', ['slug' => $posts->slug]) }}&text={{ $posts->title }}"
                                                title="{{ __('Bagikan via X') }}"
                                        >
                                            <i
                                                    class="fab fa-twitter btn btn-success sm-btn mb-2 ml-3 rounded pl-2 pr-2"
                                            ></i>
                                        </a>
                                        <a
                                                target="_blank"
                                                href="https://www.linkedin.com/shareArticle?mini=true&url={{ route('posts.detail', ['slug' => $posts->slug]) }}&title={{ $posts->title }}"
                                                title="{{ __('Bagikan via LinkedIn') }}"
                                        >
                                            <i
                                                    class="fab fa-linkedin-in btn btn-success sm-btn mb-2 ml-3 rounded pl-2 pr-2"
                                            ></i>
                                        </a>
                                        <a
                                                target="_blank"
                                                href="mailto:?subject={{ $posts->title }}&body={{ __('Lihat situs ini:') }} {{ route('posts.detail', ['slug' => $posts->slug]) }}"
                                                title="{{ __('Bagikan via email) }}"
                                        >
                                            <i
                                                    class="far fa-envelope btn btn-success sm-btn mb-2 ml-3 rounded pl-2 pr-2"
                                            ></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

{{--                <section class="mb-5">--}}
{{--                    <div class="card bg-light">--}}
{{--                        <div class="card-body">--}}
{{--                            <form method="POST" class="mb-4" action="{{ route('comments.store') }}">--}}
{{--                                @csrf--}}
{{--                                <input type="hidden" name="post_id" value="{{ $posts->id }}" />--}}
{{--                                <textarea--}}
{{--                                        name="comment"--}}
{{--                                        required--}}
{{--                                        class="form-control"--}}
{{--                                        rows="3"--}}
{{--                                        placeholder="{{ __('Komentarmu...') }}"--}}
{{--                                ></textarea>--}}
{{--                                <button type="submit" class="btn btn-success">{{ __('Kirim') }}</button>--}}
{{--                            </form>--}}
{{--                            @foreach ($posts->comments as $comment)--}}
{{--                                <div class="d-flex mb-4">--}}
{{--                                    <div class="flex-shrink-0">--}}
{{--                                        <img--}}
{{--                                                class="rounded-circle"--}}
{{--                                                style="width: 50px; height: 50px; object-fit: cover"--}}
{{--                                                src="{{ asset('storage/images/' . $comment->user->images) }}"--}}
{{--                                                alt=""--}}
{{--                                        />--}}
{{--                                    </div>--}}
{{--                                    <div class="ms-3">--}}
{{--                                        <h6 class="fst-italic fw-semibold">--}}
{{--                                            <a href="/profile/{{ $comment->user->slug }}">--}}
{{--                                                {{ $comment->user->username }}--}}
{{--                                                @if ($comment->user->centang == '1')--}}
{{--                                                    <i class="fas fa-check-circle text-primary"></i>--}}
{{--                                                @endif--}}
{{--                                            </a>--}}
{{--                                        </h6>--}}
{{--                                        <p class="fst-normal">{{ $comment->comment }}</p>--}}
{{--                                        <p class="fw-light">{{ $comment->created_at->diffForHumans() }}</p>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            @endforeach--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </section>--}}
{{--            </div>--}}

            @include('users.partials.sidebar')
        </div>
    </div>
@endsection
