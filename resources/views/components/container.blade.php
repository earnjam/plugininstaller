<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>WP Plugin Installer</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="antialiased">
		<div class="relative min-h-screen pt-12 bg-gray-200 bg-center sm:flex sm:justify-center sm:items-start bg-dots-darker dark:bg-dots-lighter dark:bg-gray-900 selection:bg-yoast-green selection:text-yoast-dark-purple">
			<div class="flex flex-col gap-4">
				<div class="max-w-xl p-6 bg-white rounded-lg shadow dark:bg-gray-800 dark:text-gray-50">
					<div class="pb-6 mb-6 border-b">
						<a class="flex gap-4" href="/">
							<x-yoast-icon class="w-4 h-4" />
							<h1 class="mb-4 text-2xl font-bold">Yoast SEO Installer</h1>
						</a>
						<p class="mb-2">This is a simple proof of concept for automatically installing Yoast SEO on a WordPress site.</p>
						<p class="mb-2">After entering the URL of a site, you will be redirected to wp-admin to authorize this application to receive an Application Password. This enables the application to perform operations on your site via the WordPress REST API.</p>
					</div>
					{{ $slot }}
				</div>
				@if($errors->any())
					<div class="p-4 mb-4 text-red-900 bg-red-100 border border-red-800 rounded-lg">
						<ul>
							@foreach($errors->all() as $error)
								<li>Error: {{ $error }}</li>
							@endforeach
						</ul>
					</div>
				@endif
				@if (session('success'))
					<div class="p-4 mb-4 text-[#276461] dark:text-white bg-emerald-50 border border-[#276461] dark:border-emerald-900 dark:bg-[#276461] rounded-lg">
						{{ session('success') }}
					</div>
				@endif
			</div>
		</div>
	</body>
</html>
