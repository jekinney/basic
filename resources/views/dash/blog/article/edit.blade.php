@extends('layouts.dash')

@section('title', 'Blog Article Editor')

@section('content')
    <div class="panel panel-default">

        <header class="panel-heading">
            <h1 class="panel-title">Article  Editor</h1>
        </header>

        <form action="{{ route('dash.blog.article.update', $article) }}" method="post" class="panel-body">
        	<input type="hidden" name="_method" value="patch">
        	{{ csrf_field() }}

        	<div class="row">

        		<div class="form-group col-md-6">
        			<label for="category">Category</label>
        			<select name="category_id" id="category" class="form-control">
        				@foreach ( $categories as $category )
        					<option value="{{ $category->id }}" @if ( $article->category_id === $category->id ) selected @endif>
        						{{ $category->name }}
        					</option>
        				@endforeach
        			</select>
        		</div>

        		<div class="form-group col-md-6">
        			<label for="publish">Publish Date</label>
        			<input type="text" 
        				name="publish_at" 
        				id="publish" 
        				value="{{ old('publish_at')?? $article->formatDate( $article->publish_at ) }}" 
        				class="form-control"
        			>
        		</div>

        	</div>

        	<div class="form-group">
        		<label for="title">Title</label>
        		<input type="text" name="title" id="title" value="{{ old('title')?? $article->title }}" class="form-control">
        	</div>

        	<div class="form-group">
        		<label for="content">Article Content</label>
        		<textarea name="content" id="content" class="form-control">{{ old('content')?? $article->content }}</textarea>
        	</div>

        	<div class="form-group text-right">
        		<button type="submit" class="btn btn-info">Save</button>
        	</div>

        </form>
    </div>
@endsection