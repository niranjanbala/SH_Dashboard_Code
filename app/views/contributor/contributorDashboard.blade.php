<?php
/**
 * Created by PhpStorm.
 * User: aravinth
 * Date: 9/7/15
 * Time: 11:59 PM
 */
?>
@extends('contributor.contributorLayout')

@section('content')

<!-- BEGIN OFFCANVAS RIGHT -->
<div id="content">

    <!-- BEGIN BLANK SECTION -->
    <section>
        <div class="section-header">
            <ol class="breadcrumb">
                <li class="active">Dashboard</li>
            </ol>
        </div><!--end .section-header -->
        <div class="section-body">

            <div class="row">

                <div class="col-md-3 col-sm-6">
                    <div class="card">
                        <div class="card-body no-padding">
                            <div class="alert alert-callout alert-info no-margin">
                                <h1 class="pull-right text-info"><i class="md md-photo"></i></h1>
                                <strong class="text-xl">{{{$post_count}}}</strong><br>
                                <span class="opacity-50">Total Posts</span>
                            </div>
                        </div><!--end .card-body -->
                    </div><!--end .card -->
                </div>

            </div>

        </div><!--end .section-body -->
    </section>

    <!-- BEGIN BLANK SECTION -->
</div><!--end #content-->


</body>
</html>


@stop