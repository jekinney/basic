@foreach ( $categories as $category )
	<div class="modal fade" id="edit-{{ $category->id }}" tabindex="-1" role="dialog" aria-labelledby="categoryEditor{{ $category->id }}">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            	<form action="{{ route('dash.blog.category.update', $category) }}" method="post">
            		<input type="hidden" name="_method" value="patch">
            		{{ csrf_field() }}

	                <div class="modal-header">
	                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	                    <h4 class="modal-title" id="categoryEditor{{ $category->id }}">Edit Category</h4>
	                </div>

	                <div class="modal-body">

	                	<div class="form-group">
	                		<label for="name">Name</label>
	                		<input type="text" name="name" id="name" value="{{ old('name')?? $category->name }}" class="form-control">
	                	</div>	                    

	                </div>

	                <div class="modal-footer">
	                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	                    <button type="submit" class="btn btn-primary">Save</button>
	                </div>

	            </form>
            </div>
        </div>
    </div>
@endforeach