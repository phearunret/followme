<div class="container">
	
		<?php if(count($query)):?>
		<div class="row">
			<div class="col-xs-6">
				<h2><?php echo $main_title;?> - <?php echo $query->commu_desc_en;?></h2>
			</div>
			<div class="col-xs-2 pull-right">
			<div style="height:15px;"></div>
			<?php echo anchor('setting/commune', 'Records', array('class' => 'btn btn-default btn-block'));?>
			</div>
		</div>
		<hr />
		<div class="row">
		<div class="col-xs-12">
			 <?php echo $this->session->flashdata('msg'); ?>
			<?php echo form_open('setting/commune/edit/'. $id );?>
			<?php echo form_hidden('id', $query->commu_id);?>

			  <div class="form-group">
			    <label>Latitude</label>
			    <input type="text" class="form-control" name="commu_nu_latitude" id="newLat" value="<?php echo $query->commu_nu_latitude;?>">
			    <span class="text-danger"><?php echo form_error('commu_nu_latitude'); ?></span>
			  </div>
			  <div class="form-group">
			    <label>Longitude</label>
			    <input type="text" class="form-control" name="commu_nu_longitude" id="newLng" value="<?php echo $query->commu_nu_longitude;?>">
			    <span class="text-danger"><?php echo form_error('commu_nu_longitude'); ?></span>
			  </div>
			  <div class="row">
			  	<div class="col-xs-2 pull-right">
			  		<button type="submit" class="btn btn-default btn-block">Edit</button>
			  	</div>
			  </div>
			  
			</form>

			<div style="height: 20px;"></div>

			<?php echo $map['js']; ?>
			<?php echo $map['html']; ?>
		

		</div><!--col-xs-12-->
	</div><!-/row-->
		<?php endif;?>
	<div style="height:30px;"></div>
</div><!--container-->


	<script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
	<script type="text/javascript">
		function updateDatabase(newLat, newLng)
		{
			$('#newLat').val(newLat);
			$('#newLng').val(newLng);
		}
	</script>