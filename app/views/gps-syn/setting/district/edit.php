<div class="container">
	
		<?php if(count($query)):?>
		<div class="row">
			<div class="col-xs-6">
				<h2><?php echo $main_title;?> - <?php echo $query->distr_desc_en;?></h2>
			</div>
			<div class="col-xs-3 pull-right">
			<div style="height:15px;"></div>
			<?php echo anchor('setting/district', 'Records', array('class' => 'btn btn-default'));?>
			</div>
		</div>
		<hr />
		<div class="row">
		<div class="col-xs-12">
			 <?php echo $this->session->flashdata('msg'); ?>
			<?php echo form_open();?>
			<?php echo form_hidden('id', $query->distr_id);?>

			  <div class="form-group">
			    <label>Latitude</label>
			    <input type="text" class="form-control" name="distr_nu_latitude" value="<?php echo $query->distr_nu_latitude;?>">
			    <span class="text-danger"><?php echo form_error('distr_nu_latitude'); ?></span>
			  </div>
			  <div class="form-group">
			    <label>Longitude</label>
			    <input type="text" class="form-control" name="distr_nu_longitude" value="<?php echo $query->distr_nu_longitude;?>">
			    <span class="text-danger"><?php echo form_error('distr_nu_longitude'); ?></span>
			  </div>
			  
			  <button type="submit" class="btn btn-default">Edit</button>
			</form>
		

		</div><!--col-xs-12-->
	</div><!-/row-->
		<?php endif;?>
	<div style="height:30px;"></div>
</div><!--container-->