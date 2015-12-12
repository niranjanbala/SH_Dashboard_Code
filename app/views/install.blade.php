<!DOCTYPE html>
<html lang="en">
	<head>
    <title>PNB - Installation</title>

    <!-- BEGIN META -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords" content="">
    <meta name="description" content="">
    <!-- END META -->

    <!-- BEGIN STYLESHEETS -->
    <link type="text/css" rel="stylesheet" href="{{asset('admins/css/materialize.min.css')}}"  media="screen,projection"/>

    <link href='http://fonts.googleapis.com/css?family=Roboto:300italic,400italic,300,400,500,700,900' rel='stylesheet' type='text/css'/>
    <link type="text/css" rel="stylesheet" href="{{asset('admins/css/theme-default/bootstrap.css?1422792965')}}" />
    <link type="text/css" rel="stylesheet" href="{{asset('admins/css/theme-default/materialadmin.css?1425466319')}}" />
    <link type="text/css" rel="stylesheet" href="{{asset('admins/css/theme-default/font-awesome.min.css?1422529194')}}" />
    <link type="text/css" rel="stylesheet" href="{{asset('admins/css/theme-default/material-design-iconic-font.min.css?1421434286')}}" />
    <link type="text/css" rel="stylesheet" href="{{asset('admins/css/style.css')}}" />
    <link rel="shortcut icon" type="image/png" href="{{Setting::get('logo')}}"/>


    <!-- END STYLESHEETS -->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script type="text/javascript" src="../../assets/js/libs/utils/html5shiv.js?1403934957"></script>
    <script type="text/javascript" src="../../assets/js/libs/utils/respond.min.js?1403934956"></script>
    <![endif]-->
</head>
	<body class="menubar-hoverable header-fixed ">
@include('notification.notify')

<?php 

$timezone = array (
    '(UTC-11:00) Midway Island' => 'Pacific/Midway',
    '(UTC-11:00) Samoa' => 'Pacific/Samoa',
    '(UTC-10:00) Hawaii' => 'Pacific/Honolulu',
    '(UTC-09:00) Alaska' => 'US/Alaska',
    '(UTC-08:00) Pacific Time (US &amp; Canada)' => 'America/Los_Angeles',
    '(UTC-08:00) Tijuana' => 'America/Tijuana',
    '(UTC-07:00) Arizona' => 'US/Arizona',
    '(UTC-07:00) Chihuahua' => 'America/Chihuahua',
    '(UTC-07:00) Mazatlan' => 'America/Mazatlan',
    '(UTC-07:00) Mountain Time (US &amp; Canada)' => 'US/Mountain',
    '(UTC-06:00) Central America' => 'America/Managua',
    '(UTC-06:00) Central Time (US &amp; Canada)' => 'US/Central',
    '(UTC-06:00) Mexico City' => 'America/Mexico_City',
    '(UTC-06:00) Monterrey' => 'America/Monterrey',
    '(UTC-06:00) Saskatchewan' => 'Canada/Saskatchewan',
    '(UTC-05:00) Bogota' => 'America/Bogota',
    '(UTC-05:00) Eastern Time (US &amp; Canada)' => 'US/Eastern',
    '(UTC-05:00) Indiana (East)' => 'US/East-Indiana',
    '(UTC-05:00) Lima' => 'America/Lima',
    '(UTC-05:00) Quito' => 'America/Bogota',
    '(UTC-04:00) Atlantic Time (Canada)' => 'Canada/Atlantic',
    '(UTC-04:30) Caracas' => 'America/Caracas',
    '(UTC-04:00) La Paz' => 'America/La_Paz',
    '(UTC-04:00) Santiago' => 'America/Santiago',
    '(UTC-03:30) Newfoundland' => 'Canada/Newfoundland',
    '(UTC-03:00) Brasilia' => 'America/Sao_Paulo',
    '(UTC-03:00) Buenos Aires' => 'America/Argentina/Buenos_Aires',
    '(UTC-03:00) Greenland' => 'America/Godthab',
    '(UTC-02:00) Mid-Atlantic' => 'America/Noronha',
    '(UTC-01:00) Azores' => 'Atlantic/Azores',
    '(UTC-01:00) Cape Verde Is.' => 'Atlantic/Cape_Verde',
    '(UTC+00:00) Casablanca' => 'Africa/Casablanca',
    '(UTC+00:00) Greenwich Mean Time : Dublin' => 'Etc/Greenwich',
    '(UTC+00:00) Lisbon' => 'Europe/Lisbon',
    '(UTC+00:00) London' => 'Europe/London',
    '(UTC+00:00) Monrovia' => 'Africa/Monrovia',
    '(UTC+00:00) UTC' => 'UTC',
    '(UTC+01:00) Amsterdam' => 'Europe/Amsterdam',
    '(UTC+01:00) Belgrade' => 'Europe/Belgrade',
    '(UTC+01:00) Berlin' => 'Europe/Berlin',
    '(UTC+01:00) Bratislava' => 'Europe/Bratislava',
    '(UTC+01:00) Brussels' => 'Europe/Brussels',
    '(UTC+01:00) Budapest' => 'Europe/Budapest',
    '(UTC+01:00) Copenhagen' => 'Europe/Copenhagen',
    '(UTC+01:00) Ljubljana' => 'Europe/Ljubljana',
    '(UTC+01:00) Madrid' => 'Europe/Madrid',
    '(UTC+01:00) Paris' => 'Europe/Paris',
    '(UTC+01:00) Prague' => 'Europe/Prague',
    '(UTC+01:00) Rome' => 'Europe/Rome',
    '(UTC+01:00) Sarajevo' => 'Europe/Sarajevo',
    '(UTC+01:00) Skopje' => 'Europe/Skopje',
    '(UTC+01:00) Stockholm' => 'Europe/Stockholm',
    '(UTC+01:00) Vienna' => 'Europe/Vienna',
    '(UTC+01:00) Warsaw' => 'Europe/Warsaw',
    '(UTC+01:00) West Central Africa' => 'Africa/Lagos',
    '(UTC+01:00) Zagreb' => 'Europe/Zagreb',
    '(UTC+02:00) Athens' => 'Europe/Athens',
    '(UTC+02:00) Bucharest' => 'Europe/Bucharest',
    '(UTC+02:00) Cairo' => 'Africa/Cairo',
    '(UTC+02:00) Harare' => 'Africa/Harare',
    '(UTC+02:00) Helsinki' => 'Europe/Helsinki',
    '(UTC+02:00) Istanbul' => 'Europe/Istanbul',
    '(UTC+02:00) Jerusalem' => 'Asia/Jerusalem',
    '(UTC+02:00) Pretoria' => 'Africa/Johannesburg',
    '(UTC+02:00) Riga' => 'Europe/Riga',
    '(UTC+02:00) Sofia' => 'Europe/Sofia',
    '(UTC+02:00) Tallinn' => 'Europe/Tallinn',
    '(UTC+02:00) Vilnius' => 'Europe/Vilnius',
    '(UTC+03:00) Baghdad' => 'Asia/Baghdad',
    '(UTC+03:00) Kuwait' => 'Asia/Kuwait',
    '(UTC+03:00) Minsk' => 'Europe/Minsk',
    '(UTC+03:00) Nairobi' => 'Africa/Nairobi',
    '(UTC+03:00) Riyadh' => 'Asia/Riyadh',
    '(UTC+03:00) Volgograd' => 'Europe/Volgograd',
    '(UTC+03:30) Tehran' => 'Asia/Tehran',
    '(UTC+04:00) Abu Dhabi' => 'Asia/Muscat',
    '(UTC+04:00) Baku' => 'Asia/Baku',
    '(UTC+04:00) Moscow' => 'Europe/Moscow',
    '(UTC+04:00) Tbilisi' => 'Asia/Tbilisi',
    '(UTC+04:00) Yerevan' => 'Asia/Yerevan',
    '(UTC+04:30) Kabul' => 'Asia/Kabul',
    '(UTC+05:00) Karachi' => 'Asia/Karachi',
    '(UTC+05:00) Tashkent' => 'Asia/Tashkent',
    '(UTC+05:30) New Delhi' => 'Asia/Calcutta',
    '(UTC+05:45) Kathmandu' => 'Asia/Katmandu',
    '(UTC+06:00) Almaty' => 'Asia/Almaty',
    '(UTC+06:00) Dhaka' => 'Asia/Dhaka',
    '(UTC+06:00) Ekaterinburg' => 'Asia/Yekaterinburg',
    '(UTC+06:30) Rangoon' => 'Asia/Rangoon',
    '(UTC+07:00) Bangkok' => 'Asia/Bangkok',
    '(UTC+07:00) Jakarta' => 'Asia/Jakarta',
    '(UTC+07:00) Novosibirsk' => 'Asia/Novosibirsk',
    '(UTC+08:00) Chongqing' => 'Asia/Chongqing',
    '(UTC+08:00) Hong Kong' => 'Asia/Hong_Kong',
    '(UTC+08:00) Krasnoyarsk' => 'Asia/Krasnoyarsk',
    '(UTC+08:00) Kuala Lumpur' => 'Asia/Kuala_Lumpur',
    '(UTC+08:00) Perth' => 'Australia/Perth',
    '(UTC+08:00) Singapore' => 'Asia/Singapore',
    '(UTC+08:00) Taipei' => 'Asia/Taipei',
    '(UTC+08:00) Ulaan Bataar' => 'Asia/Ulan_Bator',
    '(UTC+08:00) Urumqi' => 'Asia/Urumqi',
    '(UTC+09:00) Irkutsk' => 'Asia/Irkutsk',
    '(UTC+09:00) Seoul' => 'Asia/Seoul',
    '(UTC+09:00) Tokyo' => 'Asia/Tokyo',
    '(UTC+09:30) Adelaide' => 'Australia/Adelaide',
    '(UTC+09:30) Darwin' => 'Australia/Darwin',
    '(UTC+10:00) Brisbane' => 'Australia/Brisbane',
    '(UTC+10:00) Canberra' => 'Australia/Canberra',
    '(UTC+10:00) Guam' => 'Pacific/Guam',
    '(UTC+10:00) Hobart' => 'Australia/Hobart',
    '(UTC+10:00) Melbourne' => 'Australia/Melbourne',
    '(UTC+10:00) Port Moresby' => 'Pacific/Port_Moresby',
    '(UTC+10:00) Sydney' => 'Australia/Sydney',
    '(UTC+10:00) Yakutsk' => 'Asia/Yakutsk',
    '(UTC+11:00) Vladivostok' => 'Asia/Vladivostok',
    '(UTC+12:00) Auckland' => 'Pacific/Auckland',
    '(UTC+12:00) Fiji' => 'Pacific/Fiji',
    '(UTC+12:00) International Date Line West' => 'Pacific/Kwajalein',
    '(UTC+12:00) Kamchatka' => 'Asia/Kamchatka',
    '(UTC+12:00) Magadan' => 'Asia/Magadan',
    '(UTC+12:00) Wellington' => 'Pacific/Auckland',
    '(UTC+13:00) Nuku\'alofa' => 'Pacific/Tongatapu'
);
 ?>
		<!-- BEGIN HEADER-->
		<header id="header" >
			<div class="headerbar">
				<!-- Brand and toggle get grouped for better mobile display -->
				<div class="headerbar-left">
					<ul class="header-nav header-nav-options">
						<li class="header-nav-brand" >
							<div class="brand-holder">
								
									<span class="text-lg text-bold text-primary">CUSTOMIZE POINT BLANK NEWS</span>
								
							</div>
						</li>
						
					</ul>
				</div>
				
			</div>
		</header>
		<!-- END HEADER-->

		<!-- BEGIN BASE-->
		<div id="base">

			<!-- BEGIN OFFCANVAS LEFT -->
			<div class="offcanvas">
			</div><!--end .offcanvas-->
			<!-- END OFFCANVAS LEFT -->

			<!-- BEGIN CONTENT-->
			<div id="content">
				<section>
					
					<div class="section-body contain-lg">

						<!-- BEGIN INTRO -->
						<div class="row">
							<div class="col-lg-12">
								<h1 class="text-primary">Website Configuration wizard</h1>
							</div><!--end .col -->
						</div><!--end .row -->
						<!-- END INTRO -->

						<!-- BEGIN FORM WIZARD -->
						<div class="row">
							<div class="col-lg-12">
								<div class="card">
									<div class="card-body ">
										<div id="rootwizard1" class="form-wizard form-wizard-horizontal">
											<form class="form floating-label" id="install_form" method="POST" enctype="multipart/form-data" action="{{route('installSubmit')}}">
												<div class="form-wizard-nav">
													<div class="progress" style="width:100% !important;"><div class="progress-bar progress-bar-primary"></div></div>
													<ul class="nav nav-justified">
														<li class="active"><a href="#tab1" data-toggle="tab"><span class="title">DATABASE CONFIGURATION</span></a></li>
														<li><a href="#tab2" data-toggle="tab"><span class="title">ADMIN CONFIGURATION</span></a></li>
														<li><a href="#tab3" data-toggle="tab"><span class="title">WEBSITE CONFIGURATION</span></a></li>
													</ul>
												</div><!--end .form-wizard-nav -->
												<div class="tab-content clearfix">
													<div class="tab-pane active" id="tab1">
														<br/><br/>
														<div class="form-group">
															<input type="text" id="database_name" name="database_name" id="Address" class="form-control">
															<label for="Address" class="control-label">Database Name</label>
														</div>
														<div class="form-group">
															<input type="text" id="username" name="username" id="Address" class="form-control">
															<label for="Address" class="control-label">Database Username</label>
														</div>
														<div class="form-group">
															<input type="password" id="password" name="password" id="Address" class="form-control">
															<label for="Address" class="control-label">Database Password</label>
														</div>
														
													</div><!--end #tab1 -->
													<div class="tab-pane" id="tab2">
														<br/><br/>
														<div class="form-group">
															<input type="email"  name="admin_username" id="Address" class="form-control">
															<label for="Address" class="control-label">Admin Email</label>
														</div>
														<div class="form-group">
															<input type="password"  name="admin_password" id="Address" class="form-control">
															<label for="Address" class="control-label">Admin Password</label>
														</div>
														<div class="form-group">
															<input type="text"  name="mandrill_secret" id="Address" class="form-control">
															<label for="Address" class="control-label">Mandrill Secret</label>
														</div>
														<div class="form-group">
															<input type="text" name="mandrill_username" id="Address" class="form-control">
															<label for="Address" class="control-label">Mandrill Password</label>
														</div>
														
														<div class="form-group floating-label">
								                            <select id="time" name="timezone" class="form-control" required>
								                                <option value="">-Select Timezone-</option>
								                                @foreach($timezone as $key => $value)
								                                    <option value="{{$value}}" <?php if($value == Setting::get('timezone')) echo "selected"; ?> >{{$key}}</option>
								                                @endforeach

								                            </select>
								                            <label for="time">Select Timezone</label>

								                        </div>
													</div><!--end #tab2 -->
													<div class="tab-pane" id="tab3">
														<br/><br/>
														<div class="form-group">
									                        <input type="text" class="form-control" id="regular1" name="sitename" value="{{Setting::get('sitename')}}">
									                        <label for="regular1">Site Title</label>
									                    </div>

									                    <!-- <div class="form-group">
									                        <input type="text" class="form-control" id="regular1" name="footer" value="{{Setting::get('footer')}}">
									                        <label for="regular1">FOOTER TEXT</label>￼
									                    </div> -->

									                    <div class="file-field input-field col s12">
									                        <div class="btn light-blue accent-2" style="padding: 0px 10px;">
									                            <span>Choose Logo</span>
									                            <input type="file" name="picture" />
									                        </div>
									                        <input class="file-path validate" type="text"/>
									                        <p>Note: Upload Only .png images</p>

									                    </div>
									                    <button type="submit" class="btn ink-reaction btn-raised btn-primary">Submit</button>
													</div><!--end #tab3 -->
												</div><!--end .tab-content -->
												<ul class="pager wizard">
													<li class="previous first"><a class="btn-raised" href="javascript:void(0);">First</a></li>
													<li class="previous"><a class="btn-raised" href="javascript:void(0);">Previous</a></li>
													<li class="next last"><a class="btn-raised" href="javascript:void(0);">Last</a></li>
													<li class="next"><a class="btn-raised" href="javascript:void(0);">Next</a></li>
												</ul>
											</form>
										</div><!--end #rootwizard -->
									</div><!--end .card-body -->
								</div><!--end .card -->
							</div><!--end .col -->
						</div><!--end .row -->
						<!-- END FORM WIZARD -->

					</div><!--end .section-body -->
				</section>
			</div><!--end #content-->
			<!-- END CONTENT -->

			

    <!-- BEGIN JAVASCRIPT -->
<script src="{{asset('admins/js/libs/jquery/jquery-1.11.2.min.js')}}"></script>
<script type="text/javascript" src="{{asset('admins/js/materialize.min.js')}}"></script>
<script src="{{asset('admins/js/libs/jquery/jquery-migrate-1.2.1.min.js')}}"></script>
<script src="{{asset('admins/js/libs/bootstrap/bootstrap.min.js')}}"></script>
<script src="{{asset('admins/js/libs/spin.js/spin.min.js')}}"></script>
<script src="{{asset('admins/js/libs/autosize/jquery.autosize.min.js')}}"></script>
<script src="{{asset('admins/js/libs/nanoscroller/jquery.nanoscroller.min.js')}}"></script>
<script src="{{asset('admins/js/core/source/App.js')}}"></script>
<script src="{{asset('admins/js/core/source/AppNavigation.js')}}"></script>
<script src="{{asset('admins/js/core/source/AppOffcanvas.js')}}"></script>
<script src="{{asset('admins/js/core/source/AppCard.js')}}"></script>
<script src="{{asset('admins/js/core/source/AppForm.js')}}"></script>
<script src="{{asset('admins/js/core/source/AppNavSearch.js')}}"></script>
<script src="{{asset('admins/js/core/source/AppVendor.js')}}"></script>
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.js"></script>
<script src="{{asset('admins/js/libs/jquery-validation/dist/jquery.validate.min.js')}}"></script>
<script src="{{asset('admins/js/core/demo/Demo.js')}}"></script>
        <script src="{{asset('admins/js/core/demo/DemoFormWizard.js')}}"></script>
        <script src="{{asset('admins/js/libs/wizard/jquery.bootstrap.wizard.min.js')}}"></script>
<!-- END JAVASCRIPT -->
<script type="text/javascript">
    $(document).ready(function(){

        $("#install_form").validate({
            rules: {
                database_name: "required",
                // username: "required",
                // password: "required",
                // admin_username: "required",
                // admin_password: "required"
            }
        });
    });
</script>
	</body>
</html>
