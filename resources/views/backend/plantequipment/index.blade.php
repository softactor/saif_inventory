@extends ('backend.layouts.app')

@section ('title', trans('labels.backend.plantequipments.management'))

@section('page-header')
    <h1>{{ trans('labels.backend.plantequipments.management') }}</h1>
@endsection

@section('content')
    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">{{ trans('labels.backend.plantequipments.management') }}</h3>

            <div class="box-tools pull-right">
                @include('backend.plantequipment.partials.plantequipments-header-buttons')
            </div>
        </div><!-- /.box-header -->

        <div class="box-body">
            <div class="table-responsive data-table-wrapper">
                <table id="equipment-table" class="table table-condensed table-hover table-bordered">
                    <thead>
                        <tr>
                            <th>{{ trans('labels.backend.plantequipments.table.title') }}</th>
                            <th>{{ trans('labels.backend.plantequipments.table.eel_code') }}</th>
                            <th>{{ trans('labels.backend.plantequipments.table.country_of_origin') }}</th>
                            <th>{{ trans('labels.backend.plantequipments.table.capacity') }}</th>
                            <th>Make By</th>
                            <th>Model</th>
                            <th>{{ trans('labels.backend.plantequipments.table.createdby') }}</th>
                            <th>{{ trans('labels.backend.plantequipments.table.createdat') }}</th>
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
                            <td><?php echo $equipments->eel_code; ?></td>
                            <td><?php echo '';//getTableRawDetails('country', $equipments->country_of_origin)->nicename; ?></td>
                            <td><?php echo $equipments->capacity; ?></td>
                            <td><?php echo $equipments->make_by; ?></td>
                            <td><?php echo $equipments->model; ?></td>
                            <td>
                                <?php
                                    $userDetails    =    get_user_details_by_user_id($equipments->created_by);
                                    echo $userDetails->first_name.' '.$userDetails->last_name;
                                ?>
                            </td>
                            <td><?php echo date("F jS, Y", strtotime($equipments->created_at)); ?></td>
                            <td>
                                <div class="btn-group action-btn">
                                    @permission('edit-plant-equipment')
                                    <a class="btn btn-flat btn-default" href="<?php echo url('admin/plant_and_equipment/edit/'.$equipments->id); ?>">
                                        <i data-toggle="tooltip" data-placement="top" title="" class="fa fa-pencil" data-original-title="Edit"></i>
                                    </a>
                                    @endauth
                                    @permission('delete-plant-equipment')
                                    <a class="btn btn-flat btn-default" data-method="delete" data-trans-button-cancel="Cancel" data-trans-button-confirm="Delete" data-trans-title="Are you sure you want to do this?" style="cursor:pointer;" onclick="$(this).find(&quot;form&quot;).submit();">
                                        <i data-toggle="tooltip" data-placement="top" title="" class="fa fa-trash" data-original-title="Delete"></i>

                                        <form action="<?php echo url('admin/plant_and_equipment/delete/'.$equipments->id); ?>" method="get" name="delete_item" style="display:none">
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