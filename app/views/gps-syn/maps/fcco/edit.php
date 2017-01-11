
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2><?php echo $main_title;?></h2>
        <ol class="breadcrumb">
            <li>
                <a>Tables</a>
            </li>
            <li class="active">
                <strong><?php echo $main_title;?></strong>
            </li>
        </ol>
    </div>
    <div class="col-xs-2 pull-right">
		<div style="height:15px;"></div>
		<?php echo anchor('gps-syn/fcco', 'Records', array('class' => 'btn btn-default'));?>
	</div>
</div>
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5> <?php echo $main_title;?> </h5>

                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            <i class="fa fa-wrench"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-user">
                            <li><a href="#">Create</a>
                            </li>
                            <li><a href="<?php echo base_url('gps-syn/auth/user/logout')?>">Logout</a>
                            </li>
                        </ul>
                        <a class="close-link">
                            <i class="fa fa-times"></i>
                        </a>
                    </div>
                </div>
			 <div class="ibox-content">
			 
			<?php echo $this->session->flashdata('msg'); ?>
			<?php echo form_open_multipart();?>
			<div class="from-group">
				<label>FCC ID</label>
				<?php 
         			$fcco= listData('td_bo_applicant','appli_bo_id', 'appli_bo_id', '[ Select FCCO ]');
         			 echo form_dropdown('appli_bo_id', $fcco, set_value( 'appli_bo_id') ,'class="form-control input-sm"  required = "required"');
 					?> 
			</div>

			  <div class="form-group">
			    <label>Latitude</label>
			    <input type="text" class="form-control" name="leodu_latitue">
			    <span class="text-danger"><?php echo form_error('leodu_latitue'); ?></span>
			  </div>

			  <div class="form-group">
			    <label>Longitude</label>
			    <input type="text" class="form-control" name="leodu_longtitue">
			    <span class="text-danger"><?php echo form_error('leodu_longtitue'); ?></span>
			  </div>

			  <div class="form-group">
			    <label>Picture</label>
			     <input type="file" name="picture" />
			  </div>
			  
			  <button type="submit" name="btnSave" class="btn btn-default"> Save </button>
			</form>
		 </div>
            </div>
        </div>
    </div>
</div>
<div class="footer">
	<div style="height:30px;"></div>
