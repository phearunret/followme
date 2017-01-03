<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Signup</title>
        <link href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>" rel="stylesheet">
        <link href="<?php echo base_url('assets/css/styles.css'); ?>" rel="stylesheet">
       
    </head>
    <body id="account">
            <section>
                <div class="container registration-form">
                    <div class="panel panel-default">
                            <div class="panel-heading">Signup</div>
                            <div class="panel-body table-responsive">
                                <div class="modal-body">
                                    <div class="col-md-6 col-sm-12 col-xs-6 padding-left-none">
                                        <?php if(!empty(validation_errors()))
                                            {?>
                                               <div class="alert alert-danger">
                                                  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                                     <?php echo validation_errors(); ?>
                                               </div>
                                            <?php }
                                            ?>
                                        <?php
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
                                            <?php }
                                            ?>
                                        <form id="signupform" autocomplete="off" method="post" action="<?php echo base_url('auth/user/signup'); ?>">
                                            <input class="form-control" type="text" name="fname" id="fname" placeholder="First Name" value="<?php echo set_value('fname'); ?>" />
                                            <input class="form-control" type="text" name="lname" id="lname" placeholder="Last Name" value="<?php echo set_value('lname'); ?>">
                                            <input class="form-control" type="text" name="email" id="email" placeholder="Email" value="<?php echo set_value('email'); ?>">
                                            <input class="form-control" type="password" name="password" id="password" placeholder="Password">
                                            <input class="form-control" type="password" name="conf_password" id="conf_password" placeholder="Confirm Password">

                                            <div class="pull-right">
                                                <button class="btn" type="reset">Reset</button>
                                                <button class="btn">Submit</button>
                                            </div>
                                        </form
                                        <div class="pull-left">
                                            <a href="<?php echo base_url('auth/user/'); ?>"><button class="btn">Login</button></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </section>
        </div>
    </body>
</html>