@extends ('backend.layouts.app')

@section ('title', trans('labels.backend.projects.management') . ' | ' . trans('labels.backend.projects.create'))

@section('page-header')
<h1>
    <small>Supplier Update</small>
</h1>
@endsection

@section('content')
<div class="box box-info">
    <div class="box-header with-border">
        <h3 class="box-title">Suppliers Edit</h3>

        <div class="box-tools pull-right">
            @include('backend.suppliers.partials.suppliers-header-buttons')
        </div><!--box-tools pull-right-->
    </div><!-- /.box-header -->
    <div class="box-body">
        <div class="form-group">
            <form class="form-horizontal" action="<?php echo route('admin.suppliers.update'); ?>" method="post">
                {{ csrf_field() }}
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
                    <label class="col-lg-2 control-label required" for="name">Address:</label>
                    <div class="col-lg-10">
                        <textarea class="form-control" rows="5" id="address" name="address"><?php if (isset($editData->address)) { echo $editData->address; } ?></textarea>
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