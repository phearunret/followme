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
                    <input type="text" class="form-control input-sm m-b-xs" id="filter"
                           placeholder="Search in table">

                    <table class="footable table table-stripped" data-page-size="8" data-filter=#filter>
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Latitude</th>
                            <th>Longitude</th>
                            <th> <i class="fa fa-pencil-square-o" aria-hidden="true"></i> </th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if (count($query)): ?>
                            <?php foreach ($query as $row): ?>
                                <tr>
                                    <td><?php echo $row->prvin_id; ?></td>
                                    <td><?php echo $row->prvin_desc_en; ?></td>
                                    <td><?php echo $row->prvin_nu_latitude; ?></td>
                                    <td><?php echo $row->prvin_nu_longitude; ?></td>
                                    <td>
                                        <?php echo anchor('gps-syn/maps/province/edit/' . $row->prvin_id, '<i class="fa fa-pencil-square-o" aria-hidden="true"></i>'); ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                        </tbody>
                        <tfoot>
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
