<div class="container">

		<div class="row">
			<div class="col-xs-6">
				<h2> <?php echo $main_title;?> </h2>
			</div>
			<div class="col-xs-3 pull-right">
			<div style="height:15px;"></div>
			<?php echo anchor('setting/fcco', 'Records', array('class' => 'btn btn-default'));?>
			</div>
		</div>
		<hr />
		<div class="row">
		<div class="col-xs-12">
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
		

		</div><!--col-xs-12-->
	</div><!-/row-->
	<div style="height:30px;"></div>
</div><!--container-->