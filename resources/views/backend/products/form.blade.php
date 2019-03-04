<div class="box-body">
    <div class="form-group">
        <label for="name" class="col-lg-2 control-label required">Items</label>
        <div class="col-lg-10">
            <select class="form-control box-size" id="item_id" name="item_id" required>
                <option value="">Select</option>
                <?php
                    $tableName                      =   'items';
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
        {{ Form::label('code', 'Code', ['class' => 'col-lg-2 control-label required']) }}

        <div class="col-lg-10">
            {{ Form::text('code', null, ['class' => 'form-control box-size', 'placeholder' => 'Code', 'required' => 'required']) }}
        </div><!--col-lg-10-->
    </div><!--form control-->
    <div class="form-group">
        {{ Form::label('name', 'Name', ['class' => 'col-lg-2 control-label required']) }}

        <div class="col-lg-10">
            {{ Form::text('name', null, ['class' => 'form-control box-size', 'placeholder' => 'name', 'required' => 'required']) }}
        </div><!--col-lg-10-->
    </div><!--form control-->
    <div class="form-group">
        {{ Form::label('unit name', 'Unit name', ['class' => 'col-lg-2 control-label required']) }}

        <div class="col-lg-10">
            {{ Form::text('unit_name', null, ['class' => 'form-control box-size', 'placeholder' => 'Unit Name', 'required' => 'required']) }}
        </div><!--col-lg-10-->
    </div><!--form control-->
</div>