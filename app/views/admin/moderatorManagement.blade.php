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

<div class="page">
    <div class="col-md-12">
        <div class="card">
            <div class="card-head style-primary">
               <header>Moderators</header>
            </div>
            <div class="card-body">
                <table class="table no-margin">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th>Action</th>

                    </tr>
                    </thead>
                    <tbody>
                    @foreach($moderators as $user)
                    <tr>
                        <td>{{$user->id}}</td>
                        <td>{{$user->first_name}}</td>
                        <td>{{$user->email}}</td>
                        <td>
                            @if($user->is_activated != 0)
                                Activated
                            @else
                                Not activated
                            @endif
                        </td>
                        <td>
                            @if($user->is_activated != 0)
                                <a title="Un Approve" class="btn ink-reaction btn-floating-action btn-warning" href="{{route('adminModeratorDecline', array('id' => $user->id))}}"><i class="fa fa-times"></i></a>
                            @else
                                <a title="Approve" class="btn ink-reaction btn-floating-action btn-primary" href="{{route('adminModeratorActivate', array('id' => $user->id))}}"><i class="fa fa-check"></i></a>
                            @endif


                            <a  title="Edit Moderator" class="btn ink-reaction btn-floating-action btn-info" href="{{route('adminModeratorEdit', array('id' => $user->id))}}"><i class="fa fa-edit"></i></a>

                            <a title="Delete" onclick="return confirm('Are you sure?')" class="btn ink-reaction btn-floating-action btn-danger" href="{{route('adminModeratorDelete',array('id' => $user->id))}}"><i class="fa fa-trash"></i></a>
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
                <div align="right" id="paglink"><?php echo $moderators->links(); ?></div>
            </div><!--end .card-body -->
        </div><!--end .card -->

    </div>

</div>
</div>

<div class="fixed-action-btn" style="bottom: 45px; right: 24px;">
    <a class="btn-floating btn-large red">
        <i class="md md-person" style="font-size: 25px;line-height: 65px;"></i>
    </a>
    <ul>

        <li><a class="btn-floating yellow darken-1" href="{{route('adminModeratorManagement')}}" style="transform: scaleY(0.4) scaleX(0.4) translateY(40px); opacity: 0;"><i class="md md-visibility" style="line-height:40px;"></i></a></li>

        <li><a class="btn-floating blue" href="{{route('addModerate')}}" style="transform: scaleY(0.4) scaleX(0.4) translateY(40px); opacity: 0;"><i class="md md-add" style="line-height:40px;"></i></a></li>

    </ul>
</div>
@stop