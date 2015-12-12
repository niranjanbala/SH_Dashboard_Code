<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
  <title>{{Setting::get('sitename')}}</title>

  <!-- CSS  -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
  <link href="{{asset('inshorts/css/materialize.css')}}" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="{{asset('inshorts/css/style.css')}}" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link rel="stylesheet" type="text/css" href="{{asset('inshorts/css/animate.css')}}">
    <link rel="shortcut icon" type="image/png" href="{{Setting::get('logo')}}"/>

    
  <style type="text/css">

.loading-bar {
    padding: 10px 20px;
    display: block;
    text-align: center;
    box-shadow: inset 0px -45px 30px -40px rgba(0, 0, 0, 0.05);
    border-radius: 5px;
    margin: 20px 0;
    font-size: 1em;
    font-family: "museo-sans", sans-serif;
    border: 1px solid #ddd;
    margin-right: 1px;
    font-weight: bold;
    cursor: pointer;
    position: relative;
    clear: both;
}

.loading-bar:hover {
    box-shadow: inset 0px 45px 30px -40px rgba(0, 0, 0, 0.05);
}

.time-ago{
  font-size:12px;
  margin-top: 12px;
}

</style>

    <!-- Social Meta -->

    <meta property="og:locale" content="en_US" />
    <meta property="og:type" content="article" />
    <meta property="og:title" content="{{Setting::get('sitename')}}" />
    <meta property="og:description" content="Short News Content - Easy to Read - Highlighted News" />
    <meta property="og:url" content="" />
    <meta property="og:site_name" content="pointblank" />
    <meta property="og:image" content="{{Setting::get('logo')}}" />

    <meta name="twitter:card" content="summary"/>
    <meta name="twitter:description" content="Short News Content - Easy to Read - Highlighted News"/>
    <meta name="twitter:title" content="{{Setting::get('sitename')}}"/>
    <meta name="twitter:image:src" content="{{Setting::get('logo')}}"/>

    @if(Setting::get('analytics_code') != "")
  {{Setting::get('analytics_code')}}
  @endif



</head>
<body>
		

<div class="static-nav">
  <nav class="top-menu">
    <div class="nav-wrapper mat-clr">
      <a href="{{route('home')}}" class="brand-logo"><img src="{{Setting::get('logo')}}"></a>
      <!-- <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a> -->
     
      <ul class="right">  

        <li><a data-target="modal2" class="waves-effect waves-light modal-trigger"><i class="fa fa-mobile"></i></a></li> 

        <li><a data-target="modal1" class="waves-effect waves-light modal-trigger"><i class="fa fa-bars"></i></a></li>      
             
        <li><a class="waves-effect waves-light search-btn" href="javascript:void(0);" id="search-icon" data-activates="search-content"><i class="search-ico material-icons">search</i></a></li>      
               
      </ul>
      
    </div>
  </nav>


   <nav class="search" id="search-content">
    <div class="nav-wrapper mat-clr1">
      <form action="{{route('search')}}" method="get">
        <div class="input-field">
          <input id="search" type="search" name="q" required>
          <label for="search"><i class="fa fa-search"></i></label>

        </div>
      </form>
    </div>
  </nav>

</div>

  <div class="container-fluid page">
 	<div class="row" id="content">


    <!-- ajax content will load here!! -->


    </div>
   </div>


  <footer class="page-footer mat-clr">
 
    <div class="footer-copyright mat-clr">
      <div class="container">
      <p class="text-center"> <a class="white-text text-lighten-3" href="http://appoets.com">{{Setting::get('footer')}}</a></p>
      </div>
    </div>
  </footer>


  <div id="modal1" class="modal bottom-sheet cat">
    <div class="modal-content">
      <h4>Select Category
        <a href="#!" class="pull-right modal-action modal-close waves-effect waves-green btn-flat"><i class="fa fa-times"></i></a>
      </h4>
      <div class="popup-top"></div>
        @foreach($cats as $cat)
      <a href="{{route('selectCat',array('id' => $cat->id))}}" class="cat-link">
        <img src="{{{$cat->pics}}}">
        <span>{{{$cat->name}}}</span>
      </a>
        @endforeach
    </div>
    
  </div>

  <div id="modal2" class="modal bottom-sheet cat">
    <div class="modal-content">
      <h4>Get it on
        <a href="javascript:void(0);" class="pull-right modal-action modal-close waves-effect waves-green btn-flat"><i class="fa fa-times"></i></a>
      </h4>
      <div class="popup-top"></div>
      
      <a href="{{Setting::get('ios_app')}}" class="cat-link app" target="_blank">
        <img src="{{asset('image/appstore.png')}}">
      </a>

      <a href="{{Setting::get('google_play')}}" class="cat-link app" target="_blank">
        <img src="{{asset('image/playstore.png')}}">
      </a>

      <a href="{{Setting::get('website_link')}}" class="cat-link app" target="_blank">
        <img src="{{asset('image/webapp.png')}}">
      </a>
      
    </div>
    
  </div>


  <!--  Scripts-->
  <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>

  <script src="{{asset('inshorts/js/materialize.js')}}"></script>
  <script src="{{asset('inshorts/js/init.js')}}"></script>

  <!-- ajax loading script -->

  <script type="text/javascript">
var path = "{{route('ajaxloading')}}";
var q;
<?php if(isset($_GET['q'])){ ?>
q = "{{$_GET['q']}}";
<?php }else{ ?>
q = "";
<?php } ?>


    (function($) {

    $.fn.scrollPagination = function(options) {
        
        var settings = { 
            nop     : 6, // The number of posts per scroll to be loaded
            offset  : 0, // Initial offset, begins at 0 in this case
            error   : 'No More Posts!', // When the user reaches the end this is the message that is
                                        // displayed. You can change this if you want.
            delay   : 500, // When you scroll down the posts will load after a delayed amount of time.
                           // This is mainly for usability concerns. You can alter this as you see fit
            scroll  : true // The main bit, if set to false posts will not load as the user scrolls. 
                           // but will still load if the user clicks.
        }
        
        // Extend the options so they work with the plugin
        if(options) {
            $.extend(settings, options);
        }
        
        // For each so that we keep chainability.
        return this.each(function() {       
            
            // Some variables 
            $this = $(this);
            $settings = settings;
            var offset = $settings.offset;
            var busy = false; // Checks if the scroll action is happening 
                              // so we don't run it multiple times
            
            // Custom messages based on settings
            if($settings.scroll == true) $initmessage = 'Scroll for more or click here';
            else $initmessage = 'Click for more';
            
            // Append custom messages and extra UI
            $this.append('<div class="content"></div><div class="loading-bar">'+$initmessage+'</div> ');
            
            function getData() {
                
                // Post data to ajax.php
                $.post(path, {
                        
                    action        : 'scrollpagination',
                    number        : $settings.nop,
                    offset        : offset,
                    query             : q
                        
                }, function(data) {
                        
                    // Change loading bar content (it may have been altered)
                    $this.find('.loading-bar').html($initmessage);
                    // $('.progress').hide();
                        
                    // If there is no data returned, there are no more posts to be shown. Show error
                    if(data == "") { 
                        $this.find('.loading-bar').html($settings.error);   
                        // $('.progress').hide();
                    }
                    else {
                        
                        // Offset increases
                        offset = offset+$settings.nop; 
                            
                        // Append the data to the content div
                        $this.find('.content').append(data);
                        
                        // No longer busy!  
                        busy = false;
                    }   
                        
                });
                    
            }   
            
            getData(); // Run function initially
            
            // If scrolling is enabled
            if($settings.scroll == true) {
                // .. and the user is scrolling
                $(window).scroll(function() {
                    
                    // Check the user is at the bottom of the element
                    if($(window).scrollTop() + $(window).height() > $this.height() && !busy) {
                        
                        // Now we are working, so busy is true
                        busy = true;
                        
                        // Tell the user we're loading posts
                        $this.find('.loading-bar').html('<div class="progress"><div class="indeterminate"></div></div>');
                        
                        // Run the function to fetch the data inside a delay
                        // This is useful if you have content in a footer you
                        // want the user to see.
                        setTimeout(function() {
                            
                            getData();
                            
                        }, $settings.delay);
                            
                    }   
                });
            }
            
            // Also content can be loaded by clicking the loading bar/
            $this.find('.loading-bar').click(function() {
            
                if(busy == false) {
                    busy = true;
                    getData();
                }
            
            });
            
        });
    }

})(jQuery);

</script>

<!-- end ajax loading script -->

<!-- initiate ajax loading -->
<script>

$(document).ready(function() {

    $('#content').scrollPagination({

        nop     : 6, // The number of posts per scroll to be loaded
        offset  : 0, // Initial offset, begins at 0 in this case
        error   : 'No More News!', // When the user reaches the end this is the message that is
                                    // displayed. You can change this if you want.
        delay   : 300, // When you scroll down the posts will load after a delayed amount of time.
                       // This is mainly for usability concerns. You can alter this as you see fit
        scroll  : true // The main bit, if set to false posts will not load as the user scrolls. 
                       // but will still load if the user clicks.
        
    });
    
});

</script>

<!-- other scripts -->

<!-- including google analytics script -->



<script type="text/javascript">
    $(document).ready(function(){


      $('#search-icon').click(function(){ $('#search-content').toggle('slide');});


      $('.modal-trigger').leanModal({
      dismissible: true, // Modal can be dismissed by clicking outside of the modal
      opacity: .5, // Opacity of modal background
      in_duration: 300, // Transition in duration
      out_duration: 200, // Transition out duration
      
    }
  );
   
    });
</script>


  </body>
</html>
