<?php
/**
 * Created by PhpStorm.
 * User: aravinth
 * Date: 06/09/15
 * Time: 12:07 PM
 */
?>

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
    <link href="{{asset('inshorts/css/animate.css')}}" type="text/css" rel="stylesheet" media="screen,projection"/>
    <link rel="stylesheet" type="text/css" href="{{asset('inshorts/css/animate.css')}}">


    <!-- Social Meta -->

    <meta property="og:locale" content="en_US" />
    <meta property="og:type" content="article" />
    <meta property="og:title" content="{{$post->title}}" />
    <meta property="og:description" content="{{$post->des}}" />
    <meta property="og:url" content="" />
    <meta property="og:site_name" content="pointblank" />
    <meta property="og:image" content="{{$post->image}}" />

    <meta name="twitter:card" content="summary"/>
    <meta name="twitter:description" content="{{$post->des}}"/>
    <meta name="twitter:title" content="{{$post->title}}"/>
    <meta name="twitter:image:src" content="{{$post->image}}"/>



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
            <li><a class="waves-effect waves-light search-btn" href="#!" id="search-icon" data-activates="search-content"><i class="search-ico material-icons">search</i></a></li>

        </ul>

    </div>
</nav>


<nav class="search" id="search-content">
    <div class="nav-wrapper mat-clr1">
        <form>
            <div class="input-field">
                <input id="search" type="search" required>
                <label for="search"><i class="fa fa-search"></i></label>

            </div>
        </form>
    </div>
</nav>

</div>


<div class="contasiner-fluid page">
    <div class="row" style="min-height: 600px;">
        <div class="col m12 s12 l12 single-card">
           

            <div class="col l4 m4 s12">
                @if($post->image != "")
                <img style="width: 100%;" src="{{$post->image}}">
                @endif

                 @if(!empty($post->category))
                
                <?php
                $cat_id = explode(',', $post->category);
                $cat_data = Category::find($cat_id[0]);
                $cat_name = $cat_data->name;
                ?>
                <a href="http://www.facebook.com/sharer.php?u={{route('shareLink',array('id' => $cat_name,'data' => $post->link))}}" class="full-btn waves-effect waves-light btn light-blue darken-4"><i class="fa fa-facebook left"></i>Share on Facebook</a>
                <a href="http://twitter.com/share?text={{$post->title}}&url={{route('shareLink',array('id' => $cat_name,'data' => $post->link))}}" class="full-btn waves-effect waves-light btn no-right-mar light-blue accent-3"><i class="fa fa-twitter left"></i>Share on Twitter</a>
                <a href="{{{$post->url}}}" class="full-btn waves-effect waves-light btn no-right-mar mat-clr">Read More</a>
                <a href="{{route('home')}}" class="full-btn waves-effect waves-light btn no-right-mar mat-clr">More News</a>           
                 @endif
            </div>

            <div class="col l8 m8 s12">
                 @if($post->title != "")
                <h3 style="font-size: 3.5vh;margin-top: 0px;">{{$post->title}}</h3>
                @endif
                @if($post->des != "")
                <p class="text-justify">{{$post->des}}</p>
                @endif

            </div>
        </div>


    </div>

    <footer class="page-footer mat-clr">

        <div class="footer-copyright mat-clr">
            <div class="container">
                <p class="text-center">&copy;2015 <a class="white-text text-lighten-3" href="http://appoets.com">{{Setting::get('footer')}}</a></p>
            </div>
        </div>
    </footer>


    <div id="modal1" class="modal bottom-sheet cat">
        <div class="modal-content">
            <h4>Select Categories
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
        <a href="#!" class="pull-right modal-action modal-close waves-effect waves-green btn-flat"><i class="fa fa-times"></i></a>
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

