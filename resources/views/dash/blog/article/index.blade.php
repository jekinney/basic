@extends('layouts.dash')

@section('title', 'Blog Article List')

@section('content')
    <div class="panel panel-default">

        <header class="panel-heading">
            <h1 class="panel-title">Article List</h1>
        </header>

        <table class="table">
            <thead>
                <tr>
                    <th>Title</th>
                    <th class="text-center" width="10%">Author</th>
                    <th class="text-center" width="10%">Published</th>
                    <th class="text-center" width="10%">Created</th>
                    <th class="text-center" width="10%">Category</th>
                    <th class="text-center" width="10%">Options</th>
                </tr>
            </thead>
            <tbody>
                @foreach ( $articles as $article )
                    <tr>
                        <td>{{ $article->title }}</td>
                        <td class="text-center">{{ $article->author->name }}</td>
                        <td class="text-center">{{ $article->publish_at? $article->publish_at->format( 'm-d-Y h:m a'):'None' }}</td>
                        <td class="text-center">{{ $article->created_at->format( 'm-d-Y h:m a') }}</td>
                        <td class="text-center">{{ $article->category->name }}</td>
                        <td class="text-center">
                            <a href="{{ route('dash.blog.article.edit', $article) }}" class="btn btn-sm btn-info">Edit</a>
                            <button type="button" 
                                data-toggle="modal" 
                                data-target="#delete-{{ $article->id }}" 
                                class="btn btn-sm btn-danger"
                            >
                                Delete
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <footer class="panel-footer text-center">
            {{ $articles->links() }}
        </footer>

    </div>
@endsection
