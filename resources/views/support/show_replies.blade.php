@foreach( $replies as $reply )
	<div class="media" style="border: 1px #d3e0e9 solid; padding: 7px;">
	  	<div class="media-body">
	    	<h4 class="media-heading">
	    		{{ $reply->user? $reply->user->name: $reply->support->name }} replied on {{ $reply->created_at->format('m-d-Y H:m a') }}
	    	</h4>
	    	{{ $reply->message }}
	  	</div>
	</div>
@endforeach