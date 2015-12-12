<?php
/**
 * Created by PhpStorm.
 * User: aravinth
 * Date: 25/7/15
 * Time: 1:28 PM
 */
?>

@extends('moderate.moderateLayout')

@section('content')

    @include('notification.notify')

    <div class="page">

        <div class="col-md-8">
            <div class="card">
                <div class="card-head style-info">
               <header>Edit Post</header>
            </div>
                <div class="card-body">
                    <div class="text-right">
                        <a class="btn ink-reaction btn-raised btn-primary" href="{{route('moderatePost')}}">BACK</a>
                    </div>
                    <form class="form" action="{{route('moderateEditPostProcess')}}" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <input type="text" class="form-control" id="regular1" name="title" value="{{{$post->title}}}">
                            <label for="regular1">Title</label>
                        </div>


                        <div class="form-group">
                            <input type="text" class="form-control" id="regular1" name="publisher" value="{{{$post->publisher}}}">
                            <label for="regular1">Publisher</label>
                        </div>


                        <input type="hidden" name="id" value="{{{$post->id}}}">

                        <div class="input-field col s12 check-box-inline">
                            <?php foreach($category as $cat) {?>
                            <p> <input type="checkbox" name="category[{{$cat->id}}]" value="{{$cat->id}}" id="test{{$cat->id}}" <?php if(in_array($cat->id, $cate)) echo "checked"; ?> />
                                <label for="test{{$cat->id}}">{{$cat->name}}</label>
                            </p>
                            <?php } ?>
                            <br><br>
                        </div>

                        <div class="form-group">
                            <input type="text" class="form-control" id="regular1" name="url" value="{{{$post->url}}}">
                            <label for="regular1">URL</label>
                        </div>
                        <div class="file-field input-field col s12">
                            <div class="tile-content">
                                <div class="tile-icon">
                                    <img src="{{$post->image}}" style="height:300px;margin:10px;">
                                </div>
                            </div>
                            <div class="btn light-blue accent-2" style="padding: 0px 10px;">
                                <span>Choose Picture</span>
                                <input type="file" name="post_img" />
                            </div>
                            <input class="file-path validate" type="text" value="{{$post->image}}"/>

                        </div>

                        <div class="form-group">
                            <textarea name="des" id="textarea1" maxlength="450" class="form-control" rows="3">{{{$post->des}}}</textarea>
                            <label for="textarea1">Description</label>
                        </div>

<!--                         <div class="form-group">

                        <input type="text" class="form-control" id="title_tag" name="title_tag" maxlength="70" value="{{$post->title_tag}}">
                        <label for="regular1">Title Tag</label>
                        <div id="characterLeft"></div>

                        </div> -->

                        <div class="form-group">
                            <input type="text" class="form-control" id="meta_des" name="meta_des" value="{{$post->meta_des}}">
                            <label for="regular1">Meta Description</label>
                            <div id="characterLeft1"></div>
                        </div>

                </div><!--end .card-body -->
            </div><!--end .card -->

        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <button type="submit" class="btn ink-reaction btn-raised btn-warning">Update & Publish</button>
                        <br><br>

                        <div class="input-group date" id="demo-date">
                                <div class="input-group-content">
                                     <input type="text" class="form-control" required name="pub_date" value="{{date('m/d/Y',strtotime($post->created_at))}}">
                                    <label>Publish Date</label>
                                </div>
                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                        </div>

                        <div class="form-group">
                            <input type="text" class="form-control time-mask" required id="pub" name="pub_time" value="{{{date('H:m',strtotime($post->created_at))}}}">
                            <label for="regular1">Change Publish Time</label>
                        </div>

                        <div class="form-group">
                            <input type="text" class="form-control" required id="regular1" name="author" value="{{{$post->author}}}">
                            <label for="regular1">Author</label>
                        </div>

                        <div class="input-field col s12 check-box-inline">
                            <?php foreach($category as $cat) {?>
                            <p> <input type="checkbox"  name="category[{{$cat->id}}]" value="{{$cat->id}}" id="test{{$cat->id}}" <?php if(in_array($cat->id, $cate)) echo "checked"; ?> />
                                <label for="test{{$cat->id}}">{{$cat->name}}</label>
                            </p>
                            <?php } ?>
                            <br><br>
                        </div>

                </div><!--end .card-body -->
            </div><!--end .card -->

        </div>
     </form>


    </div>
    </div>
@stop
