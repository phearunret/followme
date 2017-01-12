<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5> <?php echo $main_title; ?> </h5>

                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            <i class="fa fa-wrench"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-user">
                            <li><a href="<?php echo base_url('gps-syn/auth/user/logout') ?>">Logout</a>
                            </li>
                        </ul>
                        <a class="close-link">
                            <i class="fa fa-times"></i>
                        </a>
                    </div>
                </div>
                <div class="ibox-content">
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
                    <table class="footable table table-stripped" data-page-size="8" id="footable" data-filter=#filter>
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Latitude</th>
                            <th>Longitude</th>
                            <th>Track</th>
                            <th> <i class="fa fa-pencil-square-o" aria-hidden="true"></i> </th>
                        </tr>
                        </thead>
                        <tbody>
                        <script type="text/javascript">

                            $(document).ready(function () {
                                $(".prvin_id").change(function () {

                                    $.post('<?php echo base_url('gps-syn/maps/commune/distr');?>', {prvin_id: $('.prvin_id').val()}, function (d) {

                                        $('select.distr_id').html(d);

                                    });

                                });
                            });
                        </script>
                        <script type="text/javascript">

                            $(document).ready(function () {

                                $(".distr_id").change(function () {

                                    $.post('<?php echo base_url('gps-syn/maps/commune/distr_id');?>', {distr_id: $('.distr_id').val()}, function (d) {

                                        $('tfoot.commu_id').html(d);

                                    });

                                });
                            });
                        </script>
                        </tbody>

                        <tfoot class="commu_id">
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
