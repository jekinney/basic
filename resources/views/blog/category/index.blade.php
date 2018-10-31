@extends('layouts.app')

@section('title', 'Blog Categories')

@section('content')
    <main class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <section class="panel panel-default">

                    <header class="panel-heading">
                        <h1 class="panel-title">Blog Categories</h1>
                    </header>
                    
                    <section class="panel-body">
                        
                        @include( 'blog.category.list', $categories )

                    </section>

                </section>
            </div>
        </div>
    </main>
@endsection
