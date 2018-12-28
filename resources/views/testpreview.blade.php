<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <meta name="robots" content="index,archive,follow">

    <meta name="description" content="{{ $event->description }}">

	<meta property="og:tags">

	<meta property="og:title" content="{{ $event->name }} By {{ $event->category->name }}"/>

	<meta property="og:description" content="{{ $event->description }}">
	

	<meta property="og:type" content="article"/>
	<meta property="og:image" content="{{ asset('storage/' . $event->poster_image) }}"/>
	<meta property="og:site_name" content="Xplore 19"/>
	<meta property="og:url" content="{{ route('display_event', $event->slug) }}"/>

	<meta property="fb:app_id" content="300872960546512"/>
	<meta property="fb:pages" content="335205793240413"/>

	<meta property="article:author" content="https://www.facebook.com/xplore19"/> 
	<meta property="article:publisher" content="https://www.facebook.com/xplore19"/>

    <title>{{ $event->name }}</title>
</head>
<body>
<img src="{{ asset('storage/' . $event->poster_image) }}" alt="{{ $event->name }}">
<h1>{{ $event->name }}</h1>
<p>Sample description abount event must show here</p>

</body>
</html>