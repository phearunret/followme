
<?php if(count($query)):?>
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
	<?php echo anchor('gps-syn/maps/commune', 'Records', array('class' => 'btn btn-default btn-block'));?>
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
			<?php echo form_open();?>
			<?php echo form_hidden('id', $query->commu_id);?>

			  <div class="form-group">
			    <label>Latitude</label>
			    <input type="text" class="form-control" name="commu_nu_latitude" value="<?php echo $query->commu_nu_latitude;?>">
			    <span class="text-danger"><?php echo form_error('commu_nu_latitude'); ?></span>
			  </div>
			  <div class="form-group">
			    <label>Longitude</label>
			    <input type="text" class="form-control" name="commu_nu_longitude" value="<?php echo $query->commu_nu_longitude;?>">
			    <span class="text-danger"><?php echo form_error('commu_nu_longitude'); ?></span>
			  </div>
			  
			  <button type="submit" class="btn btn-default">Edit</button>
			<?php echo form_close();?>
			<?php endif;?>
			<div style="height:30px;"></div>
			</div>
            </div>
        </div>
    </div>
</div>
<div class="footer">
		