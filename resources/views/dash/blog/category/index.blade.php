@extends('layouts.dash')

@section('title', 'Blog Category List')

@section('content')
    <div class="row">

        <div class="col-md-6 col-md-offset-3">

            <div class="panel panel-default">

                <header class="panel-heading">
                    <div class="row">
                        <h1 class="panel-title col-md-10">Category List</h1>
                        <div class="col-md-2 text-right">
                            <button type="button" data-toggle="modal" data-target="#create-category" class="btn btn-xs btn-info">Add Category</button>
                        </div>
                    </div>
                </header>

                <table class="table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th class="text-center" width="15%">Articles</th>
                            <th class="text-center" width="20%">Options</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ( $categories as $category )
                            <tr>
                                <td>{{ $category->name }}</td>
                                <td class="text-center">{{ $category->articles_count }}</td>
                                <td class="text-center">
                                    <button type="button" 
                                        data-toggle="modal" 
                                        data-target="#edit-{{ $category->id }}" 
                                        class="btn btn-sm btn-info"
                                    >
                                        Edit
                                    </button>
                                    <button type="button" 
                                        data-toggle="modal" 
                                        data-target="#delete-{{ $category->id }}" 
                                        class="btn btn-sm btn-danger"
                                    >
                                        Delete
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>

        </div>

    </div>

    @include( 'dash.blog.category.edit_modal', $categories )
    @include( 'dash.blog.category.delete_modal', $categories )
    @include( 'dash.blog.category.create_modal' )
@endsection
