<?php

namespace App\Http\Controllers\Blog;

use App\Blog\Article;
use App\Blog\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Article $article)
    {
        $articles = $article->publishedList();

        return view( 'blog.article.index', compact('articles') );
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function admin(Article $article)
    {
        $articles = $article->fullList();

        return view( 'dash.blog.article.index', compact('articles') );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Category $category)
    {
        $categories = $category->selectList( 'name', ['id', 'name'] );

        return view( 'dash.blog.article.create', compact('categories') );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Article $article)
    {
        $article->store( $request );

        session()->flash( 'success', 'New Article has been saved.' );

        return redirect()->route( 'dash.blog.article.index' );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Blog\Article $article
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article)
    {
        $article = $article->show();

        return view( 'blog.article.show', compact('article') );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Blog\Article $article
     * @var  \App\Blog\Category $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Article $article, Category $category)
    {
        $article = $article->edit();
        $categories = $category->selectList( 'name', ['id', 'name'] );

        return view( 'dash.blog.article.edit', compact('article', 'categories') );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Blog\Article $article
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Article $article)
    {
        $article->renew( $request );

        session()->flash( 'success', 'Article has been updated.' );

        return redirect()->route( 'dash.blog.article.index' ); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Blog\Article $article
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        $article->remove();

        session()->flash( 'success', 'Article has been removed.' );

        return back();
    }
}
