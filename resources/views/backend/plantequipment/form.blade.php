<div class="box-body">
    <div class="form-group">
        <label for="name" class="col-lg-2 control-label required">Project</label>
        <div class="col-lg-10">
            <select class="form-control box-size" id="project_id" name="project_id">
                <option value="">Select</option>
                <?php
                    $tableName                      =   'projects';
                    $order_by['order_by']           =   'ASC';
                    $order_by['order_by_column']    =   'project_name';
                    $projectsData                   =   get_table_data_by_table($tableName, $order_by);
                    if(isset($projectsData) && !empty($projectsData)){
                        foreach($projectsData as $data){
                ?>
                <option value="<?php echo $data->id; ?>"><?php echo $data->project_name; ?></option>
                <?php }} ?>
            </select>
            
                
            </span>
            <?php
                if ($errors->has('project_id')) {
                    echo '<span class="form-error-style">'.$errors->first('project_id').'</span>';
                }
            ?>
        </div>
    </div>
    <div class="form-group">
        <label for="name" class="col-lg-2 control-label required">Equipment Type</label>
        <div class="col-lg-10">
            <select class="form-control box-size" id="equipment_type" name="equipment_type">
                <option value="">Select</option>
                <?php
                    $tableName                      =   'project_type';
                    $order_by['order_by']           =   'ASC';
                    $order_by['order_by_column']    =   'name';
                    $projectsData                   =   get_table_data_by_table($tableName, $order_by);
                    if(isset($projectsData) && !empty($projectsData)){
                        foreach($projectsData as $data){
                ?>
                <option value="<?php echo $data->id; ?>"><?php echo $data->name; ?></option>
                <?php }} ?>
            </select>
            <?php
                if ($errors->has('equipment_type')) {
                    echo '<span class="form-error-style">'.$errors->first('equipment_type').'</span>';
                }
            ?>
        </div>
    </div>
    <div class="form-group">
        <label for="name" class="col-lg-2 control-label">Date</label>
        <div class="col-lg-5">
            <label for="name" class="col-lg-2 control-label">From</label>
            <input type="text" autocomplete="off" name="from_date" id="from_date" class="datepicker">
            <?php
                if ($errors->has('from_date')) {
                    echo '<span class="form-error-style">'.$errors->first('from_date').'</span>';
                }
            ?>
        </div>
        <div class="col-lg-5">
            <label for="name" class="col-lg-2 control-label">To</label>
            <input type="text" autocomplete="off" name="to_date" id="to_date" class="datepicker">
            <?php
                if ($errors->has('to_date')) {
                    echo '<span class="form-error-style">'.$errors->first('to_date').'</span>';
                }
            ?>
        </div>
    </div>
    <div class="form-group">
        <label for="name" class="col-lg-2 control-label">Name</label>
        <div class="col-lg-10">
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">
            <?php
                if ($errors->has('name')) {
                    echo '<span class="form-error-style">'.$errors->first('name').'</span>';
                }
            ?>
        </div>
    </div>
    <div class="form-group">
        <label for="eel_code" class="col-lg-2 control-label">EEL code</label>
        <div class="col-lg-10">
            <input type="text" class="form-control" id="eel_code" name="eel_code" value="{{ old('eel_code') }}">
            <?php
                if ($errors->has('eel_code')) {
                    echo '<span class="form-error-style">'.$errors->first('eel_code').'</span>';
                }
            ?>
        </div>
    </div>
    <div class="form-group">
        <label for="country_of_origin" class="col-lg-2 control-label">Country Of Origin</label>
        <div class="col-lg-10">
            <input type="text" class="form-control" id="country_of_origin" name="country_of_origin" value="{{ old('country_of_origin') }}">
            <?php
                if ($errors->has('country_of_origin')) {
                    echo '<span class="form-error-style">'.$errors->first('country_of_origin').'</span>';
                }
            ?>
        </div>
    </div>
    <div class="form-group">
        <label for="capacity" class="col-lg-2 control-label">Capacity</label>
        <div class="col-lg-10">
            <input type="text" class="form-control" id="capacity" name="capacity" value="{{ old('capacity') }}">
            <?php
                if ($errors->has('capacity')) {
                    echo '<span class="form-error-style">'.$errors->first('capacity').'</span>';
                }
            ?>
        </div>
    </div>
    <div class="form-group">
        <label for="make_by" class="col-lg-2 control-label">Make By</label>
        <div class="col-lg-10">
            <input type="text" class="form-control" id="model" name="make_by" value="{{ old('make_by') }}">
            <?php
                if ($errors->has('make_by')) {
                    echo '<span class="form-error-style">'.$errors->first('make_by').'</span>';
                }
            ?>
        </div>
    </div>
    <div class="form-group">
        <label for="model" class="col-lg-2 control-label">Model</label>
        <div class="col-lg-10">
            <input type="text" class="form-control" id="model" name="model" value="{{ old('model') }}">
            <?php
                if ($errors->has('model')) {
                    echo '<span class="form-error-style">'.$errors->first('model').'</span>';
                }
            ?>
        </div>
    </div>
    <div class="form-group">
        <label for="year_of_manufac" class="col-lg-2 control-label">Year of Manufacture</label>
        <div class="col-lg-10">
            <input type="text" class="form-control" id="year_of_manufac" name="year_of_manufac" value="{{ old('year_of_manufac') }}">
            <?php
                if ($errors->has('year_of_manufac')) {
                    echo '<span class="form-error-style">'.$errors->first('year_of_manufac').'</span>';
                }
            ?>
        </div>
    </div>
    <div class="form-group">
        <label for="present_location" class="col-lg-2 control-label">Present Location</label>
        <div class="col-lg-10">
            <input type="text" class="form-control" id="present_location" name="present_location" value="{{ old('present_location') }}">
            <?php
                if ($errors->has('present_location')) {
                    echo '<span class="form-error-style">'.$errors->first('present_location').'</span>';
                }
            ?>
        </div>
    </div>
    <div class="form-group">
        <label for="remarks" class="col-lg-2 control-label">Remarks</label>
        <div class="col-lg-10">
            <textarea class="form-control" id="remarks" name="remarks">{{ old('remarks') }}</textarea>
            <?php
                if ($errors->has('remarks')) {
                    echo '<span class="form-error-style">'.$errors->first('remarks').'</span>';
                }
            ?>
        </div>
    </div>
</div>