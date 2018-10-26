<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Basic Site Dashboard</title>

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    </head>
    <body>
        
        <div id="app">
            @include( 'layouts.partials.top_nav' )
            <div class="container-fluid">
            	<div class="row">
            		<aside class="col-md-2">
            			@include( 'layouts.partials.dash.left_nav' )
            		</aside>
            		<main class="col-md-10">
                        @include( 'layouts.partials.flash' )
                        <div class="row">
            			    @yield( 'content' )
                        </div>
            		</main>
            	</div>
            </div>
        </div>

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}"></script>
    </body>
</html>