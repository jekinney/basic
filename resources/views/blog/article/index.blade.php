@extends('layouts.app')

@section('title', 'Blog Articles')

@section('content')
    <main class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <section class="panel panel-default">

                    <header class="panel-heading">
                        <h1 class="panel-title">Articles</h1>
                        <div class="text-center" style="margin: -22px;">
                            {{ $articles->links() }}
                        </div>
                    </header>

                    @include( 'blog.article.list', $articles )

                    <footer class="panel-footer text-center">
                        {{ $articles->links() }}
                    </footer>

                </section>
            </div>
        </div>
    </main>
@endsection
