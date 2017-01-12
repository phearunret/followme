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
                    <?php if (count($query)): ?>
                        <?php echo $map['js']; ?>
                        <?php echo $map['html']; ?>
                        <div style="height: 15px;"></div>

                        <?php echo form_open('gps-syn/maps/district/edit/' . $id); ?>
                        <input type="hidden" name="id" value="<?php echo $query->distr_id; ?>">
                        <input type="hidden" name="distr_nu_latitude" id="newLat"
                               value="<?php echo $query->distr_nu_latitude; ?>">
                        <input type="hidden" name="distr_nu_longitude" id="newLng"
                               value="<?php echo $query->distr_nu_longitude; ?>">
                        <button type="submit" class="btn btn-default"> Save and change</button>
                        <?php echo form_close(); ?>
                    <?php endif; ?>

                </div>
            </div>
        </div>
    </div>
</div>
<div class="footer">
    <script type="text/javascript">
        function updateDatabase(newLat, newLng) {
            $('#newLat').val(newLat);
            $('#newLng').val(newLng);
        }
    </script>
