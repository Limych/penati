<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
{{-- TODO: Совместить этот файл с app.blade.php в одной целое --}}
	{!! $template->renderMeta($title) !!}

	@stack('scripts')
</head>
<body class="admin @yield('body-classes')">
	@yield('content')

	{!! $template->meta()->renderScripts(true) !!}
	@stack('footer-scripts')
</body>
</html>
