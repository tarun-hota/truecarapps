

    <!-- BEGIN Content -->
    <div id="main-content">
    <!-- BEGIN Page Title -->
        <div class="page-title">
            <div>
                <h1><i class="fa fa-file-o"></i> Add Route</h1>
            </div>
        </div>
        <!-- END Page Title -->

        <!-- BEGIN Breadcrumb -->
        <div id="breadcrumbs">
            <ul class="breadcrumb">
                <li>
                    <i class="fa fa-road"></i>
                    <a href="<?= URL. DRIVER_ROOT. 'route' ?>">Routes</a>
                    <span class="divider"><i class="fa fa-angle-right"></i></span>
                </li>
                <li class="active">Add Route</li>
            </ul>
        </div>
        <!-- END Breadcrumb -->

        <!-- BEGIN Main Content -->
        <div class="row">
        <div class="col-md-12">
            <div class="box box-black">
                <div class="box-title">
                    <h3>Information</h3>
                    <div class="box-tool">
                        <a data-action="collapse" href="#"><i class="fa fa-chevron-up"></i></a>
                    </div>
                </div>
                <div class="box-content">
                    <form class="form-horizontal" id="add_route_form" method="post">
                        <!-- hidden field data to get in login.js page -->
                        <input type="hidden" id="base_url" name="base_url" value="<?= base_url() ?>"/>
                        <input type="hidden" id="csrf" name="<?php echo $this->security->get_csrf_token_name()?>" value="<?php echo $this->security->get_csrf_hash() ?>" data-csrftokenname="<?php echo $this->security->get_csrf_token_name()?>" data-csrftokenhash="<?php echo $this->security->get_csrf_hash() ?>"/>
                        <input type="hidden" id="driver_dir" value="<?= DRIVER_ROOT ?>">

                        <div class="form-group">
                            <label class="col-sm-3 col-lg-2 control-label" for="username">* Date of journey:</label>
                            <div class="col-sm-6 col-lg-5 controls">
                                <input type="text" name="date_of_journey" id="date_of_journey" class="form-control datepicker" />
                            </div>
                        </div>

                        <div class="form-group address_div">
                            <label class="col-sm-3 col-lg-2 control-label" for="username">* Source Point:</label>
                            <div class="col-sm-6 col-lg-5 controls">
                                <input type="text" name="source_point" id="source_point" class="form-control map_field" placeholder="Enter source address"
                                       onFocus="geolocate()" type="text" />
                                <input type="hidden" class="field street_number">
                                <input type="hidden" class="field route">
                                <input type="hidden" class="field locality">
                                <input type="hidden" class="field administrative_area_level_1">
                                <input type="hidden" class="field postal_code">
                                <input type="hidden" class="field country">
                                <input type="hidden" class="field latitude">
                                <input type="hidden" class="field longitude">

                                <input type="hidden" class="mapselected" value="0">
                            </div>
                        </div>

                        <div id="routes_div_parent">
                            <div class="form-group address_div route_single">
                                <label class="col-sm-3 col-lg-2 control-label" for="username">* Next Drop Point:</label>
                                <div class="col-sm-6 col-lg-5 controls">
                                    <input type="text" class="form-control drop_point map_field" id="drop_point_1" />
                                    <input type="hidden" class="field street_number">
                                    <input type="hidden" class="field route">
                                    <input type="hidden" class="field locality">
                                    <input type="hidden" class="field administrative_area_level_1">
                                    <input type="hidden" class="field postal_code">
                                    <input type="hidden" class="field country">
                                    <input type="hidden" class="field latitude">
                                    <input type="hidden" class="field longitude">
<!--                                    <input class="field" id="street_number"disabled="true">-->

                                    <input type="hidden" class="mapselected" value="0">
                                </div>
                                <div class="remove_div" style="display: none;">
                                    <button type="button" class="btn btn-sm btn-danger remove_btn"><i class="fa fa-times"></i> Remove</button>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 col-lg-2 control-label" for="username" style="visibility: hidden"></label>
                            <div class="col-sm-6 col-lg-5 controls">
                                <button type="button" id="add_btn" class="btn btn-sm btn-success"><i class="fa fa-plus fa-1" aria-hidden="true"></i> Add </button>
                            </div>
                        </div>
                        <br>


                        <div class="form-group">
                            <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2">
                                <input type="submit" class="btn btn-primary" value="Submit">
                                <a href="<?= URL . '' . DRIVER_ROOT . 'route' ?>" class="btn">Cancel</a>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>