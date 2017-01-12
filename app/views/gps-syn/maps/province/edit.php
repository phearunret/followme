<?php if (count($query)): ?>

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
                            <li><a href="#">Create</a>
                            </li>
                            <li><a href="<?php echo base_url('gps-syn/auth/user/logout') ?>">Logout</a>
                            </li>
                        </ul>
                        <a class="close-link">
                            <i class="fa fa-times"></i>
                        </a>
                    </div>
                </div>
                <div class="ibox-content">
                    <?php echo $this->session->flashdata('msg'); ?>
                    <?php echo form_open(); ?>
                    <?php echo form_hidden('id', $query->prvin_id); ?>

                    <div class="form-group">
                        <label>Latitude</label>
                        <input type="text" class="form-control" name="prvin_nu_latitude"
                               value="<?php echo $query->prvin_nu_latitude; ?>">
                        <span class="text-danger"><?php echo form_error('prvin_nu_latitude'); ?></span>
                    </div>
                    <div class="form-group">
                        <label>Longitude</label>
                        <input type="text" class="form-control" name="prvin_nu_longitude"
                               value="<?php echo $query->prvin_nu_longitude; ?>">
                        <span class="text-danger"><?php echo form_error('prvin_nu_longitude'); ?></span>
                    </div>

                    <button type="submit" class="btn btn-default"> Save and change </button>
                    <?php echo form_close(); ?>
                    <?php endif; ?>
                    <div style="height:30px;"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="footer">
