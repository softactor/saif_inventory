@extends ('backend.layouts.app')

@section ('title', trans('labels.backend.projects.management'))

@section('page-header')
    <h1>Product Movement</h1>
@endsection

@section('content')
    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">Product Movement</h3>
            <div class="box-tools pull-right">
                @include('backend.product_movement.partials.products-header-buttons')
            </div>
        </div><!-- /.box-header -->

        <div class="box-body">
            <div class="table-responsive data-table-wrapper">
                <table id="blogs-table" class="table table-condensed table-hover table-bordered">
                    <thead>
                        <tr>
                            <th style="text-align: center;">Requisition Code</th>
                            <th style="text-align: center;">Requisition Date</th>
                            <th style="text-align: center;">Project</th>
                            <th style="text-align: center;">Status</th>
                            <th style="text-align: center;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            if(isset($plantEquipments) && !empty($plantEquipments)){
                                foreach($plantEquipments as $equipments){
                        ?>
                        <tr>
                            <td><?php echo $equipments->code; ?></td>
                            <td><?php echo $equipments->name; ?></td>
                            <td><?php echo $equipments->name; ?></td>
                            <td><?php echo $equipments->name; ?></td>
                            <td>
                                <div class="btn-group action-btn">
                                    @permission('edit-products')
                                    <a class="btn btn-flat btn-default" href="<?php echo url('admin/products/edit/'.$equipments->id); ?>">
                                        <i data-toggle="tooltip" data-placement="top" title="" class="fa fa-pencil" data-original-title="Edit"></i>
                                    </a>
                                    @endauth
                                    @permission('delete-products')
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