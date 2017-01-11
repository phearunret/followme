
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
    <div class="col-lg-2">

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
	                <div class="row">
						<div class="col-xs-12">
						<br>
						<?php 
				         $prvin= listData('tu_province','prvin_id', 'prvin_desc_en', '[ Select Province ]');
				          echo form_dropdown('prvin', $prvin, set_value( 'prvin') ,'class="form-control input-sm prvin_id"  required = "required"');
				 		?> 
						</div>
					</div>
					 <table class="footable table table-district table-stripped" data-page-size="8" data-filter=#filter>
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

						<tfoot class="distr_id">
						 	<tr>
		                        <td colspan="5">
		                            <ul class="pagination pull-right"></ul>
		                        </td>
		                    </tr>    
						</tfoot>

					</table>
			 </div>
            </div>
        </div>
    </div>
</div>
<div class="footer">
<script type="text/javascript">
     
 $(document).ready(function() {
  
    $( ".prvin_id" ).change(function() {

       $.post('<?php echo base_url('gps-syn/maps/district/prvin');?>', { prvin_id: $('.prvin_id').val() }, function(d) {
   
          $('tfoot.distr_id').html(d);

       });

    });
 });
 </script>