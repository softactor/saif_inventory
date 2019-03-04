@extends ('backend.layouts.app')

@section ('title', trans('labels.backend.projects.management') . ' | ' . trans('labels.backend.projects.create'))

@section('page-header')
<h1>
    <small>Update Product</small>
</h1>
@endsection

@section('content')
<div class="box box-info">
    <div class="box-header with-border">
        <h3 class="box-title">Products Edit</h3>

        <div class="box-tools pull-right">
            @include('backend.products.partials.products-header-buttons')
        </div><!--box-tools pull-right-->
    </div><!-- /.box-header -->
    <div class="box-body">
        <div class="form-group">
            <form class="form-horizontal" action="<?php echo route('admin.products.update'); ?>" method="post">
                {{ csrf_field() }}
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
                            <option value="<?php echo $data->id; ?>" <?php if(isset($editData->item_id) && $editData->item_id==$data->id){ echo 'selected'; } ?>><?php echo $data->name; ?></option>
                            <?php }} ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-2 control-label required" for="name">Code:</label>
                    <div class="col-lg-10">
                        <input type="text" class="form-control box-size" id="code" placeholder="Code" name="code" value="<?php
                        if (isset($editData->code)) {
                            echo $editData->code;
                        }
                        ?>">
                    </div>    
                </div>
                <div class="form-group">
                    <label class="col-lg-2 control-label required" for="name">Name:</label>
                    <div class="col-lg-10">
                        <input type="text" class="form-control box-size" id="name" placeholder="Name" name="name" value="<?php
                        if (isset($editData->name)) {
                            echo $editData->name;
                        }
                        ?>">
                    </div>    
                </div>
                <div class="form-group">
                    <label class="col-lg-2 control-label required" for="name">Unit Name:</label>
                    <div class="col-lg-10">
                        <input type="text" class="form-control box-size" id="unit_name" placeholder="Unit Name" name="unit_name" value="<?php
                        if (isset($editData->unit_name)) {
                            echo $editData->unit_name;
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