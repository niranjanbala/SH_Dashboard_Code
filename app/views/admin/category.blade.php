<?php
/**
 * Created by PhpStorm.
 * User: aravinth
 * Date: 9/7/15
 * Time: 11:59 PM
 */
?>
@extends('admin.adminLayout')

@section('content')

@include('notification.notify')

<div class="page">
    <div class="col-md-12">
        <div class="card">
            <div class="card-head style-primary">
               <header>Categories</header>
            </div>
            <div class="card-body">
                
                <table class="table no-margin">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Action</th>
                        <th>Position</th>

                    </tr>
                    </thead>
                    <tbody>
                    <form action="{{route('catOrderType')}}" method="post">
                        <?php $i=1; ?>
                    @foreach($categories as $category)
                    <tr>
                        <input type = "hidden" name="id[{{$category->id}}]" value = "{{$category->id}}">
                        <td>{{$category->id}}</td>
                        <td>{{$category->name}}</td>
                        <td>
                            {{--<a class="btn ink-reaction btn-floating-action btn-info" href="{{route('addCategory')}}"><i class="fa fa-plus"></i></a>--}}
                            <a class="btn ink-reaction btn-floating-action btn-info" href="{{route('editCategory', array('id' => $category->id))}}"><i class="fa fa-edit"></i></a>
                            <a onclick="return confirm('Are you sure?')" class="btn ink-reaction btn-floating-action btn-danger" href="{{route('deleteCategory',array('id' => $category->id))}}"><i class="fa fa-trash"></i></a>
                        </td>
                        <td>
                            <div class="form-group" style="width:50px;">
                                <input type="text" class="form-control" id="regular1" name="name[{{$category->id}}]" value="{{$category->order_type}}">
                            </div>
                        </td>   
                    </tr>
                    <?php $i++; ?>
                    @endforeach
                    </tbody>

                </table>
                <button type="submit" class="btn ink-reaction btn-raised btn-primary pull-right">Submit</button>
                </form>
                <div align="right" id="paglink"><?php echo $categories->links(); ?></div>
            </div><!--end .card-body -->
        </div><!--end .card -->

    </div>
</div>

<div class="fixed-action-btn" style="bottom: 45px; right: 24px;">
    <a class="btn-floating btn-large red">
        <i class="md md-star" style="font-size: 25px;line-height: 65px;"></i>
    </a>
    <ul>
        <li><a class="btn-floating yellow darken-1" href="{{route('adminCategory')}}" style="transform: scaleY(0.4) scaleX(0.4) translateY(40px); opacity: 0;"><i class="md md-visibility" style="line-height:40px;"></i></a></li>

        <li><a class="btn-floating blue" href="{{route('addCategory')}}" style="transform: scaleY(0.4) scaleX(0.4) translateY(40px); opacity: 0;"><i class="md md-add" style="line-height:40px;"></i></a></li>

    </ul>
</div>

@stop