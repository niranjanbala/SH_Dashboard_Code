<!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8">
	<title>404 - Page Not Found</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	
	<!-- Favicon and touch icons -->
	<link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{asset('404/images/apple-touch-icon-144-precomposed.png')}}">
	<link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{asset('404/images/apple-touch-icon-114-precomposed.png')}}">
	<link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{asset('404/images/apple-touch-icon-72-precomposed.png')}}">
	<link rel="apple-touch-icon-precomposed" href="{{asset('404/images/apple-touch-icon-57-precomposed.png')}}">
	
	<!--stylesheets-->	
	<link rel="stylesheet" href="{{asset('404/css/popup.css')}}" media="screen" type="text/css" />
    <link rel="stylesheet" href="{{asset('404/css/style.css')}}" media="screen" type="text/css" />
</head>

<body>
	<div class="global-border"></div>
    <div class="left">
		<div class="content">
			<div class="logo">
				<a href="javascript:void(0);"><img src="{{Setting::get('logo')}}" alt="logo"/></a>
			</div>
				<h1>404</h1>
				<h2>Page not found! Don't worry, <br/>sometimes it happens even for the best of us.</h2>
				<a class="btn-orange" href="{{route('home')}}">Back to Home</a>
		</div>
    </div>
    <div class="right">
	    <div class="content">
			<div id="main">
			  <div id="left" class="border">
				<table id="container"></table>
			  </div>

			  <div id="right">
				<div id="info">
				  <div id="score">Score: 0</div>
				  <div id="level">Level: 0</div>
				  <div id="lines">Lines: 0</div>
				</div>

				<div class="border-mini">
				  <table id="preview"></table>
				</div>

				<div id="controls">
				  <a href="javascript:;" style="
    width: auto;
    border: none;
    border-radius: 5px;
    font-size: 13px;
    line-height: 18px;
    text-decoration: none;
    background: #e96645;
    color: #fff;
    text-shadow: none;
    text-transform: uppercase;" id="play">Start Game </a>
				  <div id="keysinfo">
					<strong>CONTROLS:</strong>
					<p>
					  ARROWS = [ Left, Right, Down ]<br>
					  SPACEBAR = [ Rotate ]<br>
					  ENTER = [ Pause, Resume ]
					</p>
					<p class="small">Tip: Hold the down key and <br>earn extra points.</p>
				  </div>
				</div>
			  </div>
			</div>
		</div>
    </div>
	<div class="clear"></div>
	
	<!-- JavaScript -->
	<script src="{{asset('404/js/mootools.js')}}" type="text/javascript"></script>
	<script src="{{asset('404/js/uTetris-1.0.js')}}" type="text/javascript"></script>
	<script src="{{asset('404/js/jquery.min.js')}}" type="text/javascript"></script>
	<script src="{{asset('404/js/popup.js')}}" type="text/javascript"></script>
	<script src="{{asset('404/js/index.js')}}" type="text/javascript"></script>
</body>

</html>