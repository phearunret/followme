 
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5><?php echo $main_title;?></h5>

                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            <i class="fa fa-wrench"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-user">
                            <li><a href="<?php echo base_url('gps-syn/auth/user/create')?>"> Create User</a></li>
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
                            <th>Name</th>
                            <th data-hide="phone,tablet">Role</th>
                            <th data-hide="phone,tablet">Set password</th>
                            <th data-hide="phone,tablet">Status</th>
                            <th data-hide="phone,tablet">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if(count($query)):?>
                            <?php $i= 1;?>
                            <?php foreach($query as $row):?>
                            <tr class="gradeX">
                                <td><?php echo $i++;?></td>
                                <td><?php echo $row->first_name;?></td>
                                <td>Admin</td>
                                <td class="center">
                                    <?php echo anchor('gps-syn/auth/user/change_password', '<i class="fa fa-lock" aria-hidden="true"></i>')?>
                                </td>
                                </td>
                                </td>
                                <td>
                                    <?php echo anchor('gps-syn/auth/user/status', ( $row->status == 1 ? 'Active' : 'Inactive' ))?>
                                </td>
                                <td class="center">

                                    <button type="button" class="btn btn-secondary" data-toggle="tooltip" data-placement="bottom" title="Tooltip on bottom">
                                        Tooltip on bottom
                                    </button>

                                    <?php //echo anchor('gps-syn/auth/user/status', 'Edit')?>
                                    |
                                    <?php //echo anchor('gps-syn/auth/user/status', 'x')?>
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
