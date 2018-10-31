<ul class="list-group">
	@foreach ( $articles as $article )
		<li class="list-group-item">
			<div class="panel panel-default">
				<header class="panel-heading">
					<h2 class="panel-title">
						<a href="{{ route('blog.article.show', $article) }}">{{ $article->title }}</a>
					</h2>
				</header>
				<article class="panel-body">
					{{ $article->description }}
				</article>
				<footer class="panel-footer text-right">
					<a href="{{ route('blog.article.show', $article) }}" class="btn btn-sm btn-primary">Read More</a>
				</footer>
			</div>
		</li>
	@endforeach
</ul>