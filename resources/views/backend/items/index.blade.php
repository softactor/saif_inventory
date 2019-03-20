@extends ('backend.layouts.app')

@section ('title', 'Item Management')

@section('page-header')
<h1>Item Management</h1>
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
        <div id="material_information">
            <h3>Category</h3>
            <div class='row'>
                <div class='col-md-10'>
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
                                if (isset($plantEquipments) && !empty($plantEquipments)) {
                                    foreach ($plantEquipments as $equipments) {
                                        ?>
                                        <tr>
                                            <td><?php echo $equipments->name; ?></td>
                                            <td>
                                                <div class="btn-group action-btn">
                                                    @permission('edit-items')
                                                    <?php $editUrl  =    url("admin/items/edit"); ?>
                                                    <a class="btn btn-flat btn-default" href="#" onclick="openItemeditForm('<?php echo $equipments->id; ?>','<?php echo $editUrl; ?>');">
                                                        <i data-toggle="tooltip" data-placement="top" title="" class="fa fa-pencil" data-original-title="Edit"></i>
                                                    </a>
                                                    @endauth
                                                    @permission('delete-items')
                                                    <a class="btn btn-flat btn-default" data-method="delete" data-trans-button-cancel="Cancel" data-trans-button-confirm="Delete" data-trans-title="Are you sure you want to do this?" style="cursor:pointer;" onclick="$(this).find(&quot;form&quot;).submit();">
                                                        <i data-toggle="tooltip" data-placement="top" title="" class="fa fa-trash" data-original-title="Delete"></i>

                                                        <form action="<?php echo url('admin/items/delete/' . $equipments->id); ?>" method="get" name="delete_item" style="display:none">
                                                        </form>
                                                    </a>
                                                    @endauth
                                                </div>
                                            </td>
                                        </tr>
                                    <?php }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div><!--table-responsive-->
                </div>
                <div class='col-md-2'>
                    <button class="btn btn-flat btn-default pull-left" onclick="addParentItemCategory();"><i class="fa fa-plus"></i> Category</button>
                </div>
            </div>
            <h3>Sub Material</h3>
            <div class='row'>
                <div class='col-md-10'>
                    <div class="table-responsive data-table-wrapper">
                        <table id="blogs-table" class="table table-condensed table-hover table-bordered">
                            <thead>
                                <tr>
                                    <th>Parent</th>
                                    <th>Child</th>
                                    <th>{{ trans('labels.general.actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (isset($childInfo) && !empty($childInfo)) {
                                    foreach ($childInfo as $equipments) {
                                        ?>
                                        <tr>
                                            <td><?php echo $equipments->name; ?></td>
                                            <td><?php echo $equipments->material_sub_description; ?></td>
                                            <td>
                                                <div class="btn-group action-btn">
                                                    @permission('edit-items')
                                                    <?php $editUrl  =    url("admin/sub_material/edit"); ?>
                                                    <a class="btn btn-flat btn-default" href="#" onclick="openSubmaterialEditForm('<?php echo $equipments->id; ?>','<?php echo $editUrl; ?>');">
                                                        <i data-toggle="tooltip" data-placement="top" title="" class="fa fa-pencil" data-original-title="Edit"></i>
                                                    </a>
                                                    @endauth
                                                    @permission('delete-items')
                                                    <a class="btn btn-flat btn-default" data-method="delete" data-trans-button-cancel="Cancel" data-trans-button-confirm="Delete" data-trans-title="Are you sure you want to do this?" style="cursor:pointer;" onclick="$(this).find(&quot;form&quot;).submit();">
                                                        <i data-toggle="tooltip" data-placement="top" title="" class="fa fa-trash" data-original-title="Delete"></i>

                                                        <form action="<?php echo url('admin/sub_material/delete/' . $equipments->id); ?>" method="get" name="delete_item" style="display:none">
                                                        </form>
                                                    </a>
                                                    @endauth
                                                </div>
                                            </td>
                                        </tr>
                                    <?php }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div><!--table-responsive-->
                </div>
                <div class='col-md-2'>
                    <button class="btn btn-flat btn-default pull-left" onclick="addChildItemCategory();"><i class="fa fa-plus"></i> Sub Material</button>
                </div>
            </div>
            <h3>Material</h3>
            <div class="row">
                <div class='col-md-10'>
                    <div class="table-responsive data-table-wrapper">
                        <table id="blogs-table" class="table table-condensed table-hover table-bordered">
                            <thead>
                                <tr>
                                    <th>Material</th>
                                    <th>Sub Material</th>
                                    <th>Description</th>
                                    <th>Unit</th>
                                    <th>Minimum Stock</th>
                                    <th>{{ trans('labels.general.actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (isset($subChildInfo) && !empty($subChildInfo)) {
                                    foreach ($subChildInfo as $equipments) {
                                        ?>
                                        <tr>
                                            <td><?php echo $equipments->name; ?></td>
                                            <td><?php echo $equipments->material_sub_description; ?></td>
                                            <td><?php echo $equipments->material_description; ?></td>
                                            <td><?php echo $equipments->unit_name; ?></td>
                                            <td><?php echo $equipments->material_min_stock; ?></td>
                                            <td>
                                                <div class="btn-group action-btn">
                                                    @permission('edit-items')
                                                    <?php $editUrl  =    url("admin/material/edit"); ?>
                                                    <a class="btn btn-flat btn-default" href="#" onclick="openMaterialeditForm('<?php echo $equipments->id; ?>','<?php echo $editUrl; ?>');">
                                                        <i data-toggle="tooltip" data-placement="top" title="" class="fa fa-pencil" data-original-title="Edit"></i>
                                                    </a>
                                                    @endauth
                                                    @permission('delete-items')
                                                    <a class="btn btn-flat btn-default" data-method="delete" data-trans-button-cancel="Cancel" data-trans-button-confirm="Delete" data-trans-title="Are you sure you want to do this?" style="cursor:pointer;" onclick="$(this).find(&quot;form&quot;).submit();">
                                                        <i data-toggle="tooltip" data-placement="top" title="" class="fa fa-trash" data-original-title="Delete"></i>

                                                        <form action="<?php echo url('admin/material/delete/' . $equipments->id); ?>" method="get" name="delete_item" style="display:none">
                                                        </form>
                                                    </a>
                                                    @endauth
                                                </div>
                                            </td>
                                        </tr>
                                    <?php }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div><!--table-responsive-->
                </div>
                <div class='col-md-2'>
                    <button class="btn btn-flat btn-default pull-left" onclick="addSubChildItemCategory();"><i class="fa fa-plus"></i> Material</button>
                </div>
            </div>
        </div>
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
@include('backend/partial/parent_item_modal')
@include('backend/partial/parent_item_edit_modal')
@include('backend/partial/child_item_modal')
@include('backend/partial/sub_material_edit_modal')
@include('backend/partial/material_create_modal')
@include('backend/partial/material_edit_modal')