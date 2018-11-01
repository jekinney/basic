@foreach ( $categories as $category )
	<div class="modal fade" id="delete-{{ $category->id }}" tabindex="-1" role="dialog" aria-labelledby="categoryRemover{{ $category->id }}">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            	<form action="{{ route('dash.blog.category.delete', $category) }}" method="post">
            		<input type="hidden" name="_method" value="delete">
            		{{ csrf_field() }}

	                <div class="modal-header">
	                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	                    <h4 class="modal-title" id="categoryRemover{{ $category->id }}">Remove Category</h4>
	                </div>

	                <div class="modal-body texct-center">

	                	<strong>Are you sure you want to remove {{ $category->name }}?</strong>                    

	                </div>

	                <div class="modal-footer">
	                    <button type="button" class="btn btn-primary" data-dismiss="modal">No</button>
	                    <button type="submit" class="btn btn-danger">Yes</button>
	                </div>

	            </form>
            </div>
        </div>
    </div>
@endforeach