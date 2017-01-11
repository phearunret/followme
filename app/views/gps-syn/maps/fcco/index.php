
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
</div>
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
			<table class="table table-bordered">
				<thead>
					<tr>
						<th>FCC ID</th>
						<th>IMG</th>
						<th>Latitude</th>
						<th>Longitude</th>
						<th>Delete</th>
					</tr>
				</thead>

				<tfoot>
				<?php if(count($query)):?>
					<?php foreach( $query as $row ):?>
					<tr>
						<td><?php echo $row->sec_usr_id;?></td>
						<td><?php echo img('assets/images/uploads/' . $row->leodu_photopath,'' ,array('width' => '50'));?></td>
						<td><?php echo $row->leodu_latitue;?></td>
						<td><?php echo $row->leodu_longtitue;?></td>
						
						<td>
							<?php echo anchor('gps-syn/fcco/delete/' . $row->leodu_id, 'Delete');?>
						</td>
					</tr>
					<?php endforeach;?>
				<?php endif;?>
				</tfoot>

			</table>
		 </div>
            </div>
        </div>
    </div>
</div>
<div class="footer">