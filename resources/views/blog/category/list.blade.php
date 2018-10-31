<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
    @foreach ( $categories as $category )
        <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="heading{{ $category->id }}">
                <h4 class="panel-title">
                    <a role="button" 
                        data-toggle="collapse" 
                        data-parent="#accordion" 
                        href="#collapse{{ $category->id }}" 
                        aria-expanded="true"
                        aria-controls="collapse{{ $category->id }}"
                        class="clearfix" 
                    >
                        <span class="pull-left">{{ $category->name }}</span>
                        <span class="pull-right">{{ $category->articles_count }} articles</span>
                    </a>
                </h4>
            </div>
            <div id="collapse{{ $category->id }}" 
                    class="panel-collapse collapse" 
                    role="tabpanel" 
                    aria-labelledby="heading{{ $category->id }}"
                >
                <div class="panel-body">
                    @include( 'blog.article.list', ['articles' => $category->articles] )
                </div>
            </div>
        </div>
    @endforeach
</div>