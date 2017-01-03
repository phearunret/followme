<div class="container">
	<div class="row">
		<div class="col-xs-12">
			<h2><?php echo $main_title;?></h2>
			<hr />
			<table class="table table-bordered">
				<thead>
					<tr>
						<th>ID</th>
						<th>Title</th>
						<th>Latitude</th>
						<th>Longitude</th>
						<th>Edit</th>
					</tr>
				</thead>

				<tfoot>
				<?php if(count($query)):?>
					<?php foreach( $query as $row ):?>
					<tr>
						<td><?php echo $row->prvin_id;?></td>
						<td><?php echo $row->prvin_desc_en;?></td>
						<td><?php echo $row->prvin_nu_latitude;?></td>
						<td><?php echo $row->prvin_nu_longitude;?></td>
						<td>
							<?php echo anchor('setting/province/edit/' . $row->prvin_id, 'Edit');?>
						</td>
					</tr>
					<?php endforeach;?>
				<?php endif;?>
				</tfoot>

			</table>
		</div><!--col-xs-12-->
	</div><!-/row-->
</div><!--container-->