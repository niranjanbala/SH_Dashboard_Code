<?php
/**
 * Created by PhpStorm.
 * User: aravinth
 * Date: 9/7/15
 * Time: 11:59 PM
 */
?>
@extends('moderate.moderateLayout')

@section('content')

    <div class="page">
        <div class="col-md-12">
            <div class="card">
                <div class="card-head style-info">
               <header>Posts</header>
                </div>
                <div class="card-body">
                    <table class="table no-margin">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Action</th>

                        </tr>
                        </thead>
                        <tbody>
                        @foreach($posts as $post)
                            <tr>
                                <td>{{$post->id}}</td>
                                <td>{{$post->title}}</td>
                                <td>{{substr($post->des, 0, 50)}}</td>
                                <td>
                                    <!-- <a class="btn ink-reaction btn-floating-action btn-info" href="{{route('moderateAddPost')}}"><i class="fa fa-plus"></i></a> -->
                                    <a class="btn ink-reaction btn-floating-action btn-info" href="{{route('moderateEditPost', array('id' => $post->id))}}"><i class="fa fa-edit"></i></a>
                                    <a class="btn ink-reaction btn-floating-action btn-info" href="{{route('moderateViewPost', array('id' => $post->id))}}"><i class="fa fa-eye"></i></a>
                                    <a onclick="return confirm('Are you sure?')" class="btn ink-reaction btn-floating-action btn-danger" href="{{route('moderateDeletePost',array('id' => $post->id))}}"><i class="fa fa-trash"></i></a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div align="right" id="paglink"><?php echo $posts->links(); ?></div>
                </div><!--end .card-body -->
            </div><!--end .card -->

        </div>
    </div>

    <div class="fixed-action-btn" style="bottom: 45px; right: 24px;">
        <a class="btn-floating btn-large red">
            <i class="md md-star" style="font-size: 25px;line-height: 65px;"></i>
        </a>
        <ul>
            <li><a class="btn-floating yellow darken-1" href="{{route('moderatePost')}}" style="transform: scaleY(0.4) scaleX(0.4) translateY(40px); opacity: 0;"><i class="md md-visibility" style="line-height:40px;"></i></a></li>

            <li><a class="btn-floating blue" href="{{route('moderateAddPost')}}" style="transform: scaleY(0.4) scaleX(0.4) translateY(40px); opacity: 0;"><i class="md md-add" style="line-height:40px;"></i></a></li>

        </ul>
    </div>

@stop