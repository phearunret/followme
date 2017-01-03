<div class="container">
	<div class="row">
		<div class="col-xs-12">
			<h2><?php echo $main_title;?></h2>
		</div>
	</div><!--/row-->
	<div class="row">
		<div class="col-xs-8">
		<?php
		    echo $this->gcharts->GeoChart('Debt')->outputInto('debt_div');
		    echo $this->gcharts->div(800, 600);

		    if($this->gcharts->hasErrors())
		    {
		        echo $this->gcharts->getErrors();
		    }
		?>
		</div><!--col-xs-8-->
		<div class="col-xs-4">
		<?php $this->load->view('includes/sidebar');?>
		</div><!--col-xs-4-->
	</div><!--/row-->
</div><!--contaainer-->

 


 