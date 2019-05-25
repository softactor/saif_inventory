@extends ('backend.layouts.app')

@section ('title', trans('labels.backend.plantequipments.management') . ' | ' . trans('labels.backend.plantequipments.create'))

@section('page-header')
<h1>
    {{ trans('labels.backend.plantequipments.management') }}
    <small>{{ trans('labels.backend.plantequipments.create') }}</small>
</h1>
@endsection

@section('content')
<div class="box box-info">
    <div class="box-header with-border">
        <h3 class="box-title">{{ trans('labels.backend.plantequipments.create') }}</h3>

        <div class="box-tools pull-right">
            @include('backend.plantequipment.partials.plantequipments-header-buttons')
        </div><!--box-tools pull-right-->
    </div><!-- /.box-header -->
    <div class="box-body">
        <div class="form-group">
            <form class="form-horizontal" action="<?php echo route('admin.plantEquipment.update'); ?>" method="post">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="name" class="col-lg-2 control-label required">Project</label>
                    <div class="col-lg-10">
                        <select class="form-control box-size" id="project_id" name="project_id" required>
                            <option value="">Select</option>
                            <?php
                                $tableName                      =   'projects';
                                $order_by['order_by']           =   'ASC';
                                $order_by['order_by_column']    =   'project_name';
                                $projectsData                   =   get_table_data_by_table($tableName, $order_by);
                                if(isset($projectsData) && !empty($projectsData)){
                                    foreach($projectsData as $data){
                            ?>
                            <option value="<?php echo $data->id; ?>" <?php if(isset($editData->project_id) && $editData->project_id == $data->id){ echo 'selected'; } ?>><?php echo $data->project_name; ?></option>
                            <?php }} ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="name" class="col-lg-2 control-label required">Equipment Type</label>
                    <div class="col-lg-10">
                        <select class="form-control box-size" id="equipment_type" name="equipment_type" required>
                            <option value="">Select</option>
                            <?php
                                $tableName                      =   'project_type';
                                $order_by['order_by']           =   'ASC';
                                $order_by['order_by_column']    =   'name';
                                $projectsData                   =   get_table_data_by_table($tableName, $order_by);
                                if(isset($projectsData) && !empty($projectsData)){
                                    foreach($projectsData as $data){
                            ?>
                            <option value="<?php echo $data->id; ?>" <?php if(isset($editData->equipment_type) && $editData->equipment_type == $data->id){ echo 'selected'; } ?>><?php echo $data->name; ?></option>
                            <?php }} ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="name" class="col-lg-2 control-label">Date</label>
                    <div class="col-lg-5">
                        <label for="name" class="col-lg-2 control-label required">From</label>
                        <input type="text" autocomplete="off" name="from_date" id="from_date" class="datepicker" value="<?php echo ((isset($editData->date_form) && !empty($editData->date_form)) ? date('Y-m-d', strtotime($editData->date_form)) : '') ?>">
                    </div>
                    <div class="col-lg-5">
                        <label for="name" class="col-lg-2 control-label required">To</label>
                        <input type="text" autocomplete="off" name="to_date" id="to_date" class="datepicker" value="<?php echo ((isset($editData->date_to) && !empty($editData->date_to)) ? date('Y-m-d', strtotime($editData->date_to)) : '') ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-2 control-label required" for="email">Name:</label>
                    <div class="col-lg-10">
                        <input type="text" class="form-control box-size" id="name" placeholder="Name" name="name" value="<?php
                        if (isset($editData->name)) {
                            echo $editData->name;
                        }
                        ?>">
                    </div>    
                </div>    
                <div class="form-group">
                    <label class="col-lg-2 control-label required" for="email">EEL Code:</label>
                    <div class="col-lg-10">
                        <input type="text" class="form-control box-size" id="eel_code" placeholder="Name" name="eel_code" value="<?php
                        if (isset($editData->eel_code)) {
                            echo $editData->eel_code;
                        }
                        ?>">
                    </div>    
                </div>    
                <div class="form-group">
                    <label class="col-lg-2 control-label required" for="email">Country Of Origin:</label>
                    <div class="col-lg-10">
                        <select class="form-control box-size" id="country_of_origin" name="country_of_origin">
                            <option value="">Select</option>
                            <?php
                                $tableName                      =   'country';
                                $order_by['order_by']           =   'ASC';
                                $order_by['order_by_column']    =   'nicename';
                                $projectsData                   =   get_table_data_by_table($tableName, $order_by);
                                if(isset($projectsData) && !empty($projectsData)){
                                    foreach($projectsData as $data){
                            ?>
                            <option value="<?php echo $data->id; ?>"<?php if (isset($editData->country_of_origin) && $editData->country_of_origin == $data->id) { echo "selected";}?>><?php echo $data->nicename; ?></option>
                            <?php }} ?>
                        </select>
                    </div>    
                </div>    
                <div class="form-group">
                    <label class="col-lg-2 control-label required" for="email">Capacity:</label>
                    <div class="col-lg-10">
                        <input type="text" class="form-control box-size" id="capacity" placeholder="Capacity" name="capacity" value="<?php
                        if (isset($editData->capacity)) {
                            echo $editData->capacity;
                        }
                        ?>">
                    </div>    
                </div>    
                <div class="form-group">
                    <label class="col-lg-2 control-label required" for="email">Make by:</label>
                    <div class="col-lg-10">
                        <input type="text" class="form-control box-size" id="make_by" placeholder="Make by" name="make_by" value="<?php
                        if (isset($editData->make_by)) {
                            echo $editData->make_by;
                        }
                        ?>">
                    </div>    
                </div>    
                <div class="form-group">
                    <label class="col-lg-2 control-label required" for="email">Model:</label>
                    <div class="col-lg-10">
                        <input type="text" class="form-control box-size" id="model" placeholder="Model" name="model" value="<?php
                        if (isset($editData->model)) {
                            echo $editData->model;
                        }
                        ?>">
                    </div>    
                </div>    
                <div class="form-group">
                    <label class="col-lg-2 control-label required" for="email">Year of Manufacture:</label>
                    <div class="col-lg-10">
                        <select class="form-control box-size" id="year_of_manufac" name="year_of_manufac">
                            <option value="">Select</option>
                            <?php
                            $start = date('Y');
                            for ($start; $start >= 1950; $start--) {
                                ?>
                                <option value="<?php echo $start; ?>" <?php if(isset($editData->year_of_manufac) && $editData->year_of_manufac == $start){ echo 'selected'; } ?>><?php echo $start; ?></option>
                            <?php } ?>
                        </select>
                    </div>    
                </div>    
                <div class="form-group">
                    <label class="col-lg-2 control-label required" for="email">Present Location:</label>
                    <div class="col-lg-10">
                        <input type="text" class="form-control box-size" id="present_location" placeholder="Present Location" name="present_location" value="<?php
                        if (isset($editData->present_location)) {
                            echo $editData->present_location;
                        }
                        ?>">
                    </div>    
                </div>
                <div class="form-group">
                    <label for="name" class="col-lg-2 control-label required">Present Condition</label>
                    <div class="col-lg-10">
                        <select class="form-control box-size" id="present_condition" name="present_condition">
                            <option value="">Select</option>
                            <?php
                                $tableName                      =   'present_condition';
                                $order_by['order_by']           =   'ASC';
                                $order_by['order_by_column']    =   'name';
                                $projectsData                   =   get_table_data_by_table($tableName, $order_by);
                                if(isset($projectsData) && !empty($projectsData)){
                                    foreach($projectsData as $data){
                            ?>
                            <option value="<?php echo $data->id; ?>" <?php if(isset($editData->present_condition) && $editData->present_condition == $data->id){ echo 'selected'; } ?>><?php echo $data->name; ?></option>
                            <?php }} ?>
                        </select>
                        <?php
                            if ($errors->has('present_condition')) {
                                echo '<span class="form-error-style">'.$errors->first('present_condition').'</span>';
                            }
                        ?>
                    </div>
                </div>
                <!--present_condition-->
                <div class="form-group">
                    <label class="col-lg-2 control-label required" for="email">Remarks:</label>
                    <div class="col-lg-10">
                        <input type="text" class="form-control box-size" id="name" placeholder="Remarks" name="remarks" value="<?php
                        if (isset($editData->remarks)) {
                            echo $editData->remarks;
                        }
                        ?>">
                    </div>    
                </div>   
                <input type="hidden" name="edit_id" value="<?php echo $editData->id; ?>">
                <input type="submit" type="submit" class="btn btn-primary btn-md text-center" value="Update">
            </form>
            <div class="clearfix"></div>
        </div>
    </div>
</div>
@endsection