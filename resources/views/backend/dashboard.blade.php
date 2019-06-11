@extends('backend.layouts.app')

@section('page-header')
    <h1>
        {{ app_name() }}
    </h1>
@endsection

@section('content')
<div class="box box-info">
    <div class="box-header with-border">
        <h3 class="box-title">Dashboard</h3>
        <div class="box-tools pull-right">
            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
        </div><!-- /.box tools -->
    </div><!-- /.box-header -->
    <div class="box-body">
        <div class="row">
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-aqua">
                    <div class="inner">
                        <h3>
                            <?php
                                $params['table']    =   'plant_and_equipment';
                                $params['where']    =   [
                                    'equipment_type'    => 1
                                ];
                                $responseData   =   get_data_name_by_where($params['table'], $params['where']);   
                                echo count($responseData);
                            ?>
                        </h3>

                        <p>Owned Equipment</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-cogs"></i>
                    </div>
                    <a href="{{ route('admin.plantEquipment.index') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-green">
                    <div class="inner">
                        <h3>
                            <?php
                                $params['table']    =   'plant_and_equipment';
                                $params['where']    =   [
                                    'equipment_type'    => 2
                                ];
                                $responseData   =   get_data_name_by_where($params['table'], $params['where']);   
                                echo count($responseData);
                            ?>
                        </h3>

                        <p>Rented Equipments</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-yellow">
                    <div class="inner">
                        <h3>44</h3>

                        <p>Users</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-user"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-aqua">
                    <div class="inner">
                        <h3>
                            <?php
                                $params['table']    =   'plant_and_equipment';
                                $params['where']    =   [
                                    'equipment_type'    => 1
                                ];
                                $responseData   =   get_data_name_by_where($params['table'], $params['where']);   
                                echo count($responseData);
                            ?>
                        </h3>

                        <p>Total Product</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-cogs"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-green">
                    <div class="inner">
                        <h3>
                            <?php
                                $params['table']    =   'plant_and_equipment';
                                $params['where']    =   [
                                    'equipment_type'    => 2
                                ];
                                $responseData   =   get_data_name_by_where($params['table'], $params['where']);   
                                echo count($responseData);
                            ?>
                        </h3>

                        <p>Product Received</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-product-hunt"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-yellow">
                    <div class="inner">
                        <h3>44</h3>

                        <p>Product Issued</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-truck"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
        </div>
    </div><!-- /.box-body -->
</div><!--box box-info-->
@endsection