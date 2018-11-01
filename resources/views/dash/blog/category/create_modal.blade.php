<div class="modal fade" id="create-category" tabindex="-1" role="dialog" aria-labelledby="createCategory">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        	<form action="{{ route('dash.blog.category.store') }}" method="post">
        		{{ csrf_field() }}

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="createCategory">Create a Category</h4>
                </div>

                <div class="modal-body">

                	<div class="form-group">
                		<label for="name">Name</label>
                		<input type="text" name="name" id="name" value="{{ old('name') }}" class="form-control">
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