@extends ('backend.layouts.app')

@section ('title', trans('labels.backend.projects.management'))

@section('page-header')
    <h1>{{ trans('labels.backend.projects.management') }}</h1>
@endsection

@section('content')
    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">Items</h3>

            <div class="box-tools pull-right">
                @include('backend.items.partials.items-header-buttons')
            </div>
        </div><!-- /.box-header -->

        <div class="box-body">
            <div class="table-responsive data-table-wrapper">
                <table id="blogs-table" class="table table-condensed table-hover table-bordered">
                    <thead>
                        <tr>
                            <th>{{ trans('labels.backend.projects.table.title') }}</th>
                            <th>{{ trans('labels.general.actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            if(isset($plantEquipments) && !empty($plantEquipments)){
                                foreach($plantEquipments as $equipments){
                        ?>
                        <tr>
                            <td><?php echo $equipments->name; ?></td>
                            <td>
                                <div class="btn-group action-btn">
                                    @permission('edit-items')
                                    <a class="btn btn-flat btn-default" href="<?php echo url('admin/items/edit/'.$equipments->id); ?>">
                                        <i data-toggle="tooltip" data-placement="top" title="" class="fa fa-pencil" data-original-title="Edit"></i>
                                    </a>
                                    @endauth
                                    @permission('delete-items')
                                    <a class="btn btn-flat btn-default" data-method="delete" data-trans-button-cancel="Cancel" data-trans-button-confirm="Delete" data-trans-title="Are you sure you want to do this?" style="cursor:pointer;" onclick="$(this).find(&quot;form&quot;).submit();">
                                        <i data-toggle="tooltip" data-placement="top" title="" class="fa fa-trash" data-original-title="Delete"></i>

                                        <form action="<?php echo url('admin/items/delete/'.$equipments->id); ?>" method="get" name="delete_item" style="display:none">
                                        </form>
                                    </a>
                                    @endauth
                                </div>
                            </td>
                        </tr>
                            <?php }} ?>
                    </tbody>
                </table>
            </div><!--table-responsive-->
        </div><!-- /.box-body -->
    </div><!--box-->

    <!--<div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">{{ trans('history.backend.recent_history') }}</h3>
            <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div><!-- /.box tools -->
        </div><!-- /.box-header -->
        <div class="box-body">
            {{-- {!! history()->renderType('BlogCategory') !!} --}}
        </div><!-- /.box-body -->
    </div><!--box box-info-->
@endsection