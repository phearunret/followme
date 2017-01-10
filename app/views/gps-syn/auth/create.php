


<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5><?php echo $main_title;?></h5>

                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            <i class="fa fa-wrench"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-user">
                            <li><a href="<?php echo base_url('gps-syn/auth/user')?>">Users</a></li>
                        </ul>
                        <a class="close-link">
                            <i class="fa fa-times"></i>
                        </a>
                    </div>
                </div>
                <div class="ibox-content">

                     
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

                    <?php echo form_open();?>
                    <div class="form-group">
                        <label>First name</label>
                        <input class="form-control input-sm" type="text" name="fname" id="fname" placeholder="First Name" value="<?php echo set_value('fname'); ?>" />
                    </div><!--/form-group-->  

                    <div class="form-group">
                        <label>Last name </label>
                         <input class="form-control input-sm" type="text" name="lname" id="lname" placeholder="Last Name" value="<?php echo set_value('lname'); ?>">
                    </div><!--/form-group-->

                    <div class="form-group">
                        <label>Email </label>
                        <input class="form-control input-sm" type="text" name="email" id="email" placeholder="Email" value="<?php echo set_value('email'); ?>">
                    </div><!--/form-group-->  


                    <div class="form-group">
                        <label> Password </label>
                         <input class="form-control input-sm" type="password" name="password" id="password" placeholder="Password">
                    </div><!--/form-group--> 

                    <div class="form-group">
                        <label> Confirm Password </label>
                        <input class="form-control input-sm" type="password" name="conf_password" id="conf_password" placeholder="Confirm Password">
                    </div><!--/form-group--> 

                    <div class="row">
                        <div class="col-sm-3 pull-right text-right">
                            <button class="btn btn-default" type="reset">Reset</button>
                            <button class="btn btn-primary">Save</button>
                        </div>
                    </div>
                    </form>

                </div><!--/ibox-content-->
            </div>
        </div>
    </div>
</div>
<div class="footer">
