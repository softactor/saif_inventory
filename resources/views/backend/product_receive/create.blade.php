@extends ('backend.layouts.app')

@section ('title', trans('labels.backend.projects.management') . ' | ' . trans('labels.backend.projects.create'))

@section('page-header')
    <h1>
        <small>Products</small>
    </h1>
@endsection

@section('content')
    {{ Form::open(['route' => 'admin.products.store', 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'post', 'id' => 'productReceiveForm', 'files' => true]) }}

    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">Products received</h3>

            <div class="box-tools pull-right">
                @include('backend.products.partials.products-header-buttons')
            </div><!--box-tools pull-right-->
        </div><!-- /.box-header -->

        {{-- Including Form blade file --}}
        <div class="box-body">
            <div class='row'>
                <div class='col-md-5'>
                    <div class="form-group">
                        @include("backend.product_receive.form")
                        <div class="edit-form-btn">
                            <button type="button" class="btn btn-primary btn-md" onclick="addProductIntoProductReceiveForm();">Add</button>
                            {{ link_to_route('admin.products.index', 'Remove', [], ['class' => 'btn btn-danger btn-md']) }}
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
                <div class='col-md-7'>
                    <div class="row">
                        <div class="col-md-12">
                            <form action="">
                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="requisition_list">Requisition List:</label>
                                    <div class="col-sm-9">
                                        <?php
                                        $getRequisitionDetailsByRequisitionIdUrl    =   route('admin.product_requisition.getRequisitionDetailsByRequisitionId');
                                        ?>
                                        <select class="form-control" id="requisition_id" name="requisition_id" onchange="getRequisitionDetailsByRequisitionId(this.value, '<?php echo $getRequisitionDetailsByRequisitionIdUrl; ?>');">
                                            <option value="">Please Select</option>
                                            <?php
                                                /*
                                                 * get requisition data details by table and where condition;
                                                 * With this we will show the requsition list deatails by ajax call
                                                 */
                                                $table                  =   'inv_requisition';
                                                $orderBy                = [
                                                    'order_by_column'   => 'requisition_date',
                                                    'order_by'          => 'DSC',
                                                ];
                                                $requisitionList        =   get_table_data_by_table($table, $orderBy);
                                                if(isset($requisitionList) && !empty($requisitionList)){
                                                    foreach($requisitionList as $rdata){
                                                        $timestamp  =   $rdata->requisition_date;
                                                        $hrdate     =   date("F jS, Y", strtotime($timestamp)); //September 30th, 2013
                                                    }
                                                }
                                            ?>
                                            <option value="<?php echo $rdata->id; ?>"><?php echo $rdata->requisition_id.' ( '.$hrdate.' )'; ?></option>
                                        </select>
                                    </div>
                                    <div class="col-md-12">
                                        <div id="rjdata"></div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive table-bordered">          
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Product Name</th>
                                            <th>Quantity</th>
                                            <th>Unit</th>
                                            <th>Unit Price</th>
                                            <th style="text-align: right">Total</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="receiveProductBody">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!--box-->
    </div>
    {{ Form::close() }}
@endsection
