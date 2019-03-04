<div class="box-body">
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
                <option value="<?php echo $data->id; ?>"><?php echo $data->project_name; ?></option>
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
                <option value="<?php echo $data->id; ?>"><?php echo $data->name; ?></option>
                <?php }} ?>
            </select>
        </div>
    </div>
    <div class="form-group">
        <label for="name" class="col-lg-2 control-label">Date</label>
        <div class="col-lg-5">
            <label for="name" class="col-lg-2 control-label required">From</label>
            <input type="text" autocomplete="off" name="from_date" id="from_date" class="datepicker">
        </div>
        <div class="col-lg-5">
            <label for="name" class="col-lg-2 control-label required">To</label>
            <input type="text" autocomplete="off" name="to_date" id="to_date" class="datepicker">
        </div>
    </div>
    <div class="form-group">
        {{ Form::label('name', trans('validation.attributes.backend.plant_equipments.name'), ['class' => 'col-lg-2 control-label required']) }}

        <div class="col-lg-10">
            {{ Form::text('name', null, ['class' => 'form-control box-size', 'placeholder' => trans('validation.attributes.backend.plant_equipments.name'), 'required' => 'required']) }}
        </div><!--col-lg-10-->
    </div><!--form control-->
    <div class="form-group">
        {{ Form::label('eel_code', trans('validation.attributes.backend.plant_equipments.eel_code'), ['class' => 'col-lg-2 control-label required']) }}

        <div class="col-lg-10">
            {{ Form::text('eel_code', null, ['class' => 'form-control box-size', 'placeholder' => trans('validation.attributes.backend.plant_equipments.eel_code'), 'required' => 'required']) }}
        </div><!--col-lg-10-->
    </div><!--form control-->
    <div class="form-group">
        {{ Form::label('country_of_origin', trans('validation.attributes.backend.plant_equipments.country_of_origin'), ['class' => 'col-lg-2 control-label required']) }}

        <div class="col-lg-10">
            {{ Form::text('country_of_origin', null, ['class' => 'form-control box-size', 'placeholder' => trans('validation.attributes.backend.plant_equipments.country_of_origin'), 'required' => 'required']) }}
        </div><!--col-lg-10-->
    </div><!--form control-->
    <div class="form-group">
        {{ Form::label('capacity', trans('validation.attributes.backend.plant_equipments.capacity'), ['class' => 'col-lg-2 control-label required']) }}

        <div class="col-lg-10">
            {{ Form::text('capacity', null, ['class' => 'form-control box-size', 'placeholder' => trans('validation.attributes.backend.plant_equipments.capacity'), 'required' => 'required']) }}
        </div><!--col-lg-10-->
    </div><!--form control-->
    <div class="form-group">
        {{ Form::label('make_by', trans('validation.attributes.backend.plant_equipments.make_by'), ['class' => 'col-lg-2 control-label required']) }}

        <div class="col-lg-10">
            {{ Form::text('make_by', null, ['class' => 'form-control box-size', 'placeholder' => trans('validation.attributes.backend.plant_equipments.make_by'), 'required' => 'required']) }}
        </div><!--col-lg-10-->
    </div><!--form control-->
    <div class="form-group">
        {{ Form::label('model', trans('validation.attributes.backend.plant_equipments.model'), ['class' => 'col-lg-2 control-label required']) }}

        <div class="col-lg-10">
            {{ Form::text('model', null, ['class' => 'form-control box-size', 'placeholder' => trans('validation.attributes.backend.plant_equipments.model'), 'required' => 'required']) }}
        </div><!--col-lg-10-->
    </div><!--form control-->
    <div class="form-group">
        {{ Form::label('year_of_manufac', trans('validation.attributes.backend.plant_equipments.year_of_manufac'), ['class' => 'col-lg-2 control-label required']) }}

        <div class="col-lg-10">
            {{ Form::text('year_of_manufac', null, ['class' => 'form-control box-size', 'placeholder' => trans('validation.attributes.backend.plant_equipments.year_of_manufac'), 'required' => 'required']) }}
        </div><!--col-lg-10-->
    </div><!--form control-->
    <div class="form-group">
        {{ Form::label('present_location', trans('validation.attributes.backend.plant_equipments.present_location'), ['class' => 'col-lg-2 control-label required']) }}

        <div class="col-lg-10">
            {{ Form::text('present_location', null, ['class' => 'form-control box-size', 'placeholder' => trans('validation.attributes.backend.plant_equipments.present_location'), 'required' => 'required']) }}
        </div><!--col-lg-10-->
    </div><!--form control-->
    <div class="form-group">
        {{ Form::label('remarks', trans('validation.attributes.backend.plant_equipments.remarks'), ['class' => 'col-lg-2 control-label required']) }}

        <div class="col-lg-10 mce-box">
            {{ Form::textarea('remarks', null, ['class' => 'form-control', 'placeholder' => trans('validation.attributes.backend.plant_equipments.remarks')]) }}
        </div><!--col-lg-10-->
    </div><!--form control-->
</div>