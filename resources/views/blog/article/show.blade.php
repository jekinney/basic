@extends('layouts.app')

@section('title', 'Blog Article')

@section('content')
    <main class="container">
        <section class="panel panel-default">

            <header class="panel-heading text-center">
                <h1>{{ $article->title }}</h1>
                <h4 class="panel-title">
                    Written by <a href="{{ route('profile.show', $article->author) }}"><strong>{{ $article->author->name }}</strong></a>
                    for <a href="{{ route( 'blog.category.show', $article->category) }}"><strong>{{ $article->category->name }}</strong></a>
                    on {{ $article->publish_at->format('m-d-Y h:m a') }}
                </h4>
            </header>

            <article class="panel-body">
                {!! $article->content !!}
            </article>

        </section>
    </main>
@endsection
