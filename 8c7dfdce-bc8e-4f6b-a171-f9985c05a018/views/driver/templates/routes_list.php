<!-- BEGIN Content -->
<div id="main-content">

    <div class="alert alert-success alert-dismissable success_msg" style="display: none;">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
        <strong>Success!</strong> Route data is saved.
    </div>

    <!-- hidden data -->
    <input type="hidden" id="addroutesuccess" value="<?= $addroutesuccess; ?>">

    <!-- BEGIN Page Title -->
<!--    <div class="page-title">-->
<!--        <div>-->
<!--            <h1><i class="fa fa-home"></i> Routes</h1>-->
<!--        </div>-->
<!--    </div>-->
<!---->
<!--    <div class="pull-right">-->
<!--        <a href="" class="btn btn-success">Add Route</a>-->
<!--    </div>-->
    <div class="row">
        <div class="col-md-6">
            <h1><i class="fa fa-road""></i> Routes</h1>
        </div>
        <div class="col-md-6">
            <div class="pull-right">
                <a href="<?= URL . '' . DRIVER_ROOT . 'route/add' ?>" class="btn btn-sm btn-success"><i class="fa fa-plus"></i> &nbsp;Add Route</a>
            </div>
        </div>
    </div>
                    <!-- END Page Title -->

    <!-- BEGIN Main Content -->
    <div class="row">
        <div class="col-md-12">
            <div class="box box-black">
            <div class="box-title">
                <h3>Routes List</h3>
                <div class="box-tool">
                    <a data-action="collapse" href="#"><i class="fa fa-chevron-up"></i></a>
                </div>
            </div>
            <div class="box-content">
<!--                <div class="document-upsection">-->
<!--                    <div class="row">-->
<!--                        <div class="col-sm-6 col-lg-5 controls">-->
<!--                            <input type="text" data-rule-minlength="3" data-rule-required="true" class="form-control" id="username" name="username" placeholder="By Name/Email/Contact no">-->
<!--                        </div>-->
<!--                        <div class="col-sm-6 col-lg-5 controls">-->
<!--                            <select data-rule-required="true" id="select" name="select" class="form-control">-->
<!--                                <option value="">-- Please select --</option>-->
<!--                                <option value="1">User Type</option>-->
<!--                            </select>-->
<!--                        </div>-->
<!--                        <input type="submit" value="Search" class="btn btn-primary">-->
<!--                    </div>-->
<!--                </div>
                <br/>--><br/>
                <div class="clearfix"></div>
                <div class="table-responsive" style="border:0">
                    <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th class="text-center">Date Of Journey</th>
                                <th class="text-center">Source Point</th>
                                <th class="text-center">Drop Points</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                if (!empty($data)) {
                                    foreach ($data as $row) {
                                        ?>
                                        <tr>
                                            <td class="text-center"><?= $row['date_of_journey'] ?></td>
                                            <td class="text-center"><?= $row['source_point'] ?></td>
                                            <td class="text-center"><?= $row['drop_points'] ?></td>
                                            <td class="text-center"><?php echo $row['drop_points'] == 1 ? '<i class="fa fa-check"></i>' : '<i class="fa fa-exclamation-triangle"></i>'; ?></td>
                                            <td class="text-center1">
                                                <i class="fa fa-pencil-square-o"></i>
                                                <i class="fa fa-trash-o"></i>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                } else {
                             ?>
                                    <tr></td><td class="text-center" colspan="5">No data found</td></tr>
                            <?php
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
            </div>
        </div>
    </div>
<!-- END Main Content -->
