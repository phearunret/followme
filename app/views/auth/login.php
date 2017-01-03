<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title> Login | Followmee </title>
    <?php echo link_tag(array('href'=>'assets/images/icons/gle-log.ico','rel'=>'shortcut icon')); ?>

    <link href="<?php echo base_url('assets/css/bootstrap.min.css')?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/font-awesome/css/font-awesome.css')?>" rel="stylesheet">

    <link href="<?php echo base_url('assets/css/gps/animate.css')?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/css/gps/style.min.css')?>" rel="stylesheet">
</head>

<body class="gray-bg">

<div class="middle-box text-center loginscreen animated fadeInDown">
    <div>
        <div>

            <h1 class="logo-name"> GL </h1>

        </div>
        <h3>Welcome to GL</h3>
        <p>
            Group Lease Public Company Limited has expertise in hire-purchase of motorcycles as it has been in the motorcycle leasing business for over 20 years.
        </p>
        <p>Login in. To see it in action.</p>
        <?php if(!empty(validation_errors()))
        {?>
            <div class="alert alert-danger">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <?php echo validation_errors(); ?>
            </div>
        <?php
        }
        if(!empty($this->session->flashdata('success')))
        {?>
            <div class="alert alert-success">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <?php echo $this->session->flashdata('success'); ?>
            </div>
        <?php }
        ?>
        <?php
        if(!empty($this->session->flashdata('failure')))
        {?>
            <div class="alert alert-danger">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <?php echo $this->session->flashdata('failure'); ?>
            </div>
        <?php
        }
        ?>
        <form class="m-t" role="form" action="<?php echo base_url('auth/user'); ?>" method="post">
            <div class="form-group">
                <input name="email" type="email" class="form-control" placeholder="Email" required="required">
            </div>
            <div class="form-group">
                <input name="password" type="password" class="form-control" placeholder="Password" required="required">
            </div>
            <button type="submit" class="btn btn-primary block full-width m-b">Login</button>
        </form>
        <p class="m-t"> <small> GL Finance | Group Lease Public <br /> Company Limited &copy; 2017</small> </p>
    </div>
</div>

<!-- Mainly scripts -->
<script src="<?php echo base_url('assets/js/jquery-2.1.1.js')?>"></script>
<script src="<?php echo base_url('js/bootstrap.min.js')?>"></script>

</body>

</html>


