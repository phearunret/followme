<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <?php echo link_tag(array('href'=>'assets/images/icons/gle-log.ico','rel'=>'shortcut icon')); ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> <?php echo $main_title;?> | Followmee </title>
    <link href="<?php echo base_url('assets/css/bootstrap.min.css')?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/font-awesome/css/font-awesome.css')?>" rel="stylesheet">
    <!-- FooTable -->
    <link href="<?php echo base_url('assets/css/plugins/footable/footable.core.css')?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/css/gps/animate.css')?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/css/gps/style.css')?>" rel="stylesheet">
    <!-- Mainly scripts -->
    <script src="<?php echo base_url('assets/js/jquery.js')?>"></script>

</head>

<body>

<div id="wrapper">

    <nav class="navbar-default navbar-static-side" role="navigation">
        <div class="sidebar-collapse">
            <ul class="nav metismenu" id="side-menu">
                <li class="nav-header">
                    <div class="dropdown profile-element"> <span>
                            <img alt="image" class="img-circle" src="<?php echo base_url('assets/images/thumbs/profile_small.jpg')?>" />
                             </span>
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold"> Phearun Reth </strong>
                             </span> <span class="text-muted text-xs block">Art Director <b class="caret"></b></span> </span> </a>
                        <ul class="dropdown-menu animated fadeInRight m-t-xs">
                            <li><a href="profile.html">Profile</a></li>
                            <li><a href="contacts.html"> Authentication </a></li>
                            <li><a href="<?php echo base_url('gps-syn/auth/user/change_password')?>">Change password </a></li>
                            <li class="divider"></li>
                            <li><a href="<?php echo base_url('gps-syn/auth/user/logout')?>">Logout</a></li>
                        </ul>
                    </div>
                    <div class="logo-element">
                        GL
                    </div>
                </li>
                <li>
                    <a href="index.html"><i class="fa fa-map-marker"></i> <span class="nav-label">Maps</span> <span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li><a href="<?php echo base_url('gps-syn/maps/province')?>">Province</a></li>
                        <li><a href="<?php echo base_url('gps-syn/maps/district')?>"> District </a></li>
                        <li><a href="<?php echo base_url('gps-syn/maps/commune')?>">Commune</a></li>
                    </ul>

                <li>
                    <a><i class="fa fa-bars"></i> <span class="nav-label"> Overdue </span> <span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li><a href="index.html"> Over 90 days </a></li>
                    </ul>
                </li>
                <li>
                    <a><i class="fa fa-comments"></i> <span class="nav-label"> Notication </span> <span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li><a href="<?php echo base_url('gps-syn/maps/fcco')?>""> FCO</a></li>
                    </ul>
                </li>               
            </ul>

        </div>
    </nav>

    <div id="page-wrapper" class="gray-bg">
        <div class="row border-bottom">
            <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
                <div class="navbar-header">
                    <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
                    <!--
                    <form role="search" class="navbar-form-custom" action="search_results.html">
                        <div class="form-group">
                            <input type="text" placeholder="Search for something..." class="form-control" name="top-search" id="top-search">
                        </div>
                    </form>
                    -->
                </div>
                <ul class="nav navbar-top-links navbar-right">
                    <li>
                        <span class="m-r-sm text-muted welcome-message">Welcome to <?php echo $this->session->userdata('logged_in')['fname'].' '.$this->session->userdata('logged_in')['lname']; ?>.</span>
                    </li>
                    <li class="dropdown">
                        <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                            <i class="fa fa-envelope"></i>  <span class="label label-warning">16</span>
                        </a>
                        <ul class="dropdown-menu dropdown-messages">
                            <li>
                                <div class="dropdown-messages-box">
                                    <a href="profile.html" class="pull-left">
                                        <!-- <img alt="image" class="img-circle" src="img/a7.jpg"> -->
                                    </a>
                                    <div class="media-body">
                                        <small class="pull-right">46h ago</small>
                                        <strong>Mike Loreipsum</strong> started following <strong>Monica Smith</strong>. <br>
                                        <small class="text-muted">3 days ago at 7:58 pm - 10.06.2014</small>
                                    </div>
                                </div>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <div class="dropdown-messages-box">
                                    <a href="profile.html" class="pull-left">
                                        <!-- <img alt="image" class="img-circle" src="img/a4.jpg"> -->
                                    </a>
                                    <div class="media-body ">
                                        <small class="pull-right text-navy">5h ago</small>
                                        <strong>Chris Johnatan Overtunk</strong> started following <strong>Monica Smith</strong>. <br>
                                        <small class="text-muted">Yesterday 1:21 pm - 11.06.2014</small>
                                    </div>
                                </div>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <div class="dropdown-messages-box">
                                    <a href="profile.html" class="pull-left">
                                        <!-- <img alt="image" class="img-circle" src="img/profile.jpg"> -->
                                    </a>
                                    <div class="media-body ">
                                        <small class="pull-right">23h ago</small>
                                        <strong>Monica Smith</strong> love <strong>Kim Smith</strong>. <br>
                                        <small class="text-muted">2 days ago at 2:30 am - 11.06.2014</small>
                                    </div>
                                </div>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <div class="text-center link-block">
                                    <a href="mailbox.html">
                                        <i class="fa fa-envelope"></i> <strong>Read All Messages</strong>
                                    </a>
                                </div>
                            </li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                            <i class="fa fa-bell"></i>  <span class="label label-primary">8</span>
                        </a>
                        <ul class="dropdown-menu dropdown-alerts">
                            <li>
                                <a href="mailbox.html">
                                    <div>
                                        <i class="fa fa-envelope fa-fw"></i> You have 16 messages
                                        <span class="pull-right text-muted small">4 minutes ago</span>
                                    </div>
                                </a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="profile.html">
                                    <div>
                                        <i class="fa fa-twitter fa-fw"></i> 3 New Followers
                                        <span class="pull-right text-muted small">12 minutes ago</span>
                                    </div>
                                </a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="grid_options.html">
                                    <div>
                                        <i class="fa fa-upload fa-fw"></i> Server Rebooted
                                        <span class="pull-right text-muted small">4 minutes ago</span>
                                    </div>
                                </a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <div class="text-center link-block">
                                    <a href="notifications.html">
                                        <strong>See All Alerts</strong>
                                        <i class="fa fa-angle-right"></i>
                                    </a>
                                </div>
                            </li>
                        </ul>
                    </li>


                    <li>
                        <a href="<?php echo base_url('gps-syn/auth/user/logout')?>">
                            <i class="fa fa-sign-out"></i> Log out
                        </a>
                    </li>
                </ul>

            </nav>
        </div>