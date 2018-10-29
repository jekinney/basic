<div class="panel panel-default">

	<header class="panel-heading text-center">
		<h2 class="panel-title">Side Nav</h2>
	</header>

	<nav>
		<ul class="nav nav-pills nav-stacked">
			@if ( auth()->user()->hasPerm('access-dash') )
				<li class="" role="presentation"><a href="{{ route('dash.home') }}">Dashboard</a></li>
			@endif
			@if ( auth()->user()->hasPerm('view-user') )
				<li class="" role="presentation"><a href="{{ route('dash.user.index') }}">Users</a></li>
			@endif
			@if ( auth()->user()->hasPerm('view-role') )
				<li class="" role="presentation"><a href="{{ route('dash.role.index') }}">Roles</a></li>
			@endif
			@if ( auth()->user()->hasPerm('view-assigned-support') )
				<li class="" role="presentation"><a href="{{ route('dash.support.index') }}">Support</a></li>
			@endif
			@if ( auth()->user()->hasPerm('view-health') )
				<li class="" role="presentation"><a href="">Health</a></li>
			@endif
		</ul>
	</nav>

</div>
