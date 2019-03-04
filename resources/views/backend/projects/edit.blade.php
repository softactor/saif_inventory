@extends ('backend.layouts.app')

@section ('title', trans('labels.backend.projects.management') . ' | ' . trans('labels.backend.projects.create'))

@section('page-header')
<h1>
    {{ trans('labels.backend.projects.management') }}
    <small>{{ trans('labels.backend.projects.create') }}</small>
</h1>
@endsection

@section('content')
<div class="box box-info">
    <div class="box-header with-border">
        <h3 class="box-title">{{ trans('labels.backend.projects.create') }}</h3>

        <div class="box-tools pull-right">
            @include('backend.projects.partials.projects-header-buttons')
        </div><!--box-tools pull-right-->
    </div><!-- /.box-header -->
    <div class="box-body">
        <div class="form-group">
            <form class="form-horizontal" action="<?php echo route('admin.projects.update'); ?>" method="post">
                {{ csrf_field() }}
                <div class="form-group">
                    <label class="col-lg-2 control-label required" for="project_name">Name:</label>
                    <div class="col-lg-10">
                        <input type="text" class="form-control box-size" id="project_name" placeholder="Name" name="project_name" value="<?php
                        if (isset($editData->project_name)) {
                            echo $editData->project_name;
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