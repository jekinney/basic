<?php

namespace App\Http\Controllers\Blog;

use App\Blog\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Category $category)
    {
        $categories = $category->publishedList();

        return view( 'blog.category.index', compact('categories') );
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function admin(Category $category)
    {
        $categories = $category->fullList();

        return view( 'dash.blog.category.index', compact('categories') );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view( 'dash.blog.category.create' );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Category $category)
    {
        $category->store( $request );

        session()->flash( 'success', 'New Category has been saved.' );

        return redirect()->route( 'dash.category.index' );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Blog\Category $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        $category = $category->show();

        return view( 'blog.category.show', compact('category') );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Blog\Category $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        $category = $category->edit();

        return view( 'dash.blog.category.edit', compact('category') );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Blog\Category $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $category->renew( $request );

        return redirect()->route( 'dash.category.index' );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Blog\Category $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->remove();

        session()->flash( 'success', 'Category has been removed.' );

        return back();
    }
}
