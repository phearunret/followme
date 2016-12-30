<div class="container">
	<div class="row">
		<div class="col-xs-12">
			<h2><?php echo $main_title;?></h2>
		</div>
	</div>
	<hr />
	<div class="row">
		<div class="col-xs-6">
		<?php 
         $prvin= listData('tu_province','prvin_id', 'prvin_desc_en', '[ Select Province ]');
          echo form_dropdown('prvin', $prvin, set_value( 'prvin') ,'class="form-control input-sm prvin_id"  required = "required"');
 		?> 
		</div>
		<div class="col-xs-6">
		<?php 
          
          echo form_dropdown('distr', array('' => '[Select District]'), set_value( 'distr') ,'class="form-control input-sm distr_id"');
 		?> 
		</div>
	</div>
	<hr />
	<div class="row">
		<div class="col-xs-12">
			<table class="table table-bordered">
				<thead>
					<tr>
						<th>ID</th>
						<th>Title</th>
						<th>Latitude</th>
						<th>Longitude</th>
						<th>Trace</th>
						<th>Edit</th>
					</tr>
				</thead>

				<tfoot class="commu_id">
				 
				</tfoot>

			</table>
		</div><!--col-xs-12-->
	</div><!-/row-->
</div><!--container-->
<script type="text/javascript">
     
 $(document).ready(function() {
  
    $( ".prvin_id" ).change(function() {

       $.post('<?php echo base_url('setting/commune/distr');?>', { prvin_id: $('.prvin_id').val() }, function(d) {
   
          $('select.distr_id').html(d);

       });

    });
 });
 </script>
<script type="text/javascript">
     
 $(document).ready(function() {
  
    $( ".distr_id" ).change(function() {

       $.post('<?php echo base_url('setting/commune/distr_id');?>', { distr_id: $('.distr_id').val() }, function(d) {

        $('tfoot.commu_id').html(d);

       });

    });
 });
 </script>