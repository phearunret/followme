<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Forget Password</title>
    <link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/css/styles.css" rel="stylesheet">
  </head>
  <body id="account">
   <div id="home">
      <section>
         <div class="container registration-form">
            <div class="col-md-12">
               <div class="clearfix"></div>
               <div class="panel panel-default">
                  <div class="panel-heading">Forget Password</div>
                  <div class="panel-body table-responsive">
                     <div class="col-md-12">
                        <div class="modal-body">
                          <div class="col-md-6 col-sm-6 col-xs-8 padding-left-none bg-login">
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
                            <form id="loginform" autocomplete="off" method="post" action="<?php echo base_url('auth/user/forget_password'); ?>">
                              <input type="text" placeholder="Email" id="email" class="form-control" name="email">
                              <div class="pull-right">
                                 <button class="btn" type="submit">Send Reset Link</button>
                              </div>
                            </form>
                              <div class="pull-left">
                                 <a href="<?php echo base_url('auth/user/'); ?>"><button class="btn">Login</button></a>
                              </div>
                          </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
        </div>
      </section>
      <div class="clearfix"></div>
      <script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.min.js"></script>
      <script type="text/javascript" src="<?php echo base_url(); ?>js/bootstrap.js"></script>
      
    </div>
  </body>
</html>