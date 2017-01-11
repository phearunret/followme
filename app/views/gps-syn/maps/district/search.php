
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
            <?php echo anchor('gps-syn/maps/district', 'Records', array('class' => 'btn btn-default btn-block'));?>
            </div>
        </div>
		<div class="row">
		<div class="col-xs-12">
			 <?php echo $this->session->flashdata('msg'); ?>
			<?php echo form_open('gps-syn/maps/district/edit/'. $id );?>
			<?php echo form_hidden('id', $query->distr_id);?>

			  <div class="form-group">
			    <label>Latitude</label>
			    <input type="text" class="form-control" name="distr_nu_latitude" id="newLat" value="<?php echo $query->distr_nu_latitude;?>">
			    <span class="text-danger"><?php echo form_error('distr_nu_latitude'); ?></span>
			  </div>
			  <div class="form-group">
			    <label>Longitude</label>
			    <input type="text" class="form-control" name="distr_nu_longitude" id="newLng" value="<?php echo $query->distr_nu_longitude;?>">
			    <span class="text-danger"><?php echo form_error('distr_nu_longitude'); ?></span>
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
<div class="footer">

	<script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
	<script type="text/javascript">
		function updateDatabase(newLat, newLng)
		{
			$('#newLat').val(newLat);
			$('#newLng').val(newLng);
		}
	</script>