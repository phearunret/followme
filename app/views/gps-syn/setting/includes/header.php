<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?php echo $main_title;?></title>
    <?php echo link_tag(array('href'=>'assets/images/icons/gle-log.ico','rel'=>'shortcut icon')); ?>  
    <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url('assets/css/bootstrap.min.css');?>" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="<?php echo base_url('assets/css/style.css');?>" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="<?php echo base_url('assets/font-awesome/css/font-awesome.min.css');?>" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <!-- jQuery -->
    <script src="<?php echo base_url('assets/js/jquery.js');?>"></script>

</head>

<body>

    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-fixed-top topnav" role="navigation">
        <div class="container topnav">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand topnav" href="<?php echo base_url();?>">GL Finance</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <!--
                     
                    <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">

                      <i class="fa fa-globe" aria-hidden="true"></i> 
                      <span class="badge badge-notify">3</span>
                      <span class="caret"></span></a>
                      <ul class="dropdown-menu">
                        <li>
                            <a href="#"> 
                            <img width="30" src="<?php echo base_url('assets/images/thumbs/IMG-019.jpg');?>"> 
                            Mrs. Phors - Phnom Penh, <span class="text-warning text-size">  Uplaod Photo 25 minutes ago </span>
                            </a>
                        </li>
                        <li role="separator" class="divider"></li>
                         <li>
                            <a href="#"> 
                            <img width="30" src="<?php echo base_url('assets/images/thumbs/IMG-019.jpg');?>"> 
                            Mrs. Phors - Phnom Penh, <span class="text-warning text-size">  Uplaod Photo 25 minutes ago </span>
                            </a>
                        </li>
                        <li role="separator" class="divider"></li>
                         <li>
                            <a href="#"> 
                            <img width="30" src="<?php echo base_url('assets/images/thumbs/IMG-019.jpg');?>"> 
                            Mrs. Phors - Phnom Penh, <span class="text-warning text-size">  Uplaod Photo 25 minutes ago </span>
                            </a>
                        </li>
                
                        <li role="separator" class="divider"></li>
                        <li><a href="#"> See Notifications </a></li>
                      </ul>
                    </li>

                    -->

                    <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                       Statistics<span class="caret"></span></a>
                      <ul class="dropdown-menu">
                        <li><a href="<?php echo base_url('geo/t');?>"> <i class="fa fa-map-marker" aria-hidden="true"></i>  Overdue Geo Chart </a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="<?php echo base_url('geo/f');?>"> <i class="fa fa-map-marker" aria-hidden="true"></i>  Never late Geo Chart </a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="<?php echo base_url('pie/t');?>"> <i class="fa fa-pie-chart" aria-hidden="true"></i>  Overdue Pie Chart </a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="<?php echo base_url('pie/f');?>"> <i class="fa fa-pie-chart" aria-hidden="true"></i>  Never late Pie Chart </a></li>
                      </ul>
                    </li>

                    <li>
                        <a href="#about">About Us</a>
                    </li>
                    <li>
                        <a href="#help">Help</a>
                    </li>
                    <li>
                        <a href="#contact">Contact</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
    <!-- Header -->
    <div style="height: 50px;"></div>
    <a name="about"></a>