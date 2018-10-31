@extends('layouts.app')

@section('title', 'Blog Category')

@section('content')
    <main class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">

                <div class="panel panel-default">

                    <header class="panel-heading">
                        <h1 class="panel-title">Category Name</h1>
                    </header>

                    <section class="panel-body">
                        @include( 'blog.article.list', ['articles' => $category->articles] )
                    </section>

                </div>

            </div>
        </div>
    </main>
@endsection
