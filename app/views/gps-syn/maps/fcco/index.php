<div class="container">
	<div class="row">
		<div class="col-xs-12">
			<h2><?php echo $main_title;?></h2>
			<hr />
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
							<?php echo anchor('setting/fcco/delete/' . $row->leodu_id, 'Delete');?>
						</td>
					</tr>
					<?php endforeach;?>
				<?php endif;?>
				</tfoot>

			</table>
		</div><!--col-xs-12-->
	</div><!-/row-->
</div><!--container-->