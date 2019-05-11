@extends ('backend.layouts.app')

@section ('title', trans('labels.backend.projects.management') . ' | ' . trans('labels.backend.projects.create'))

@section('page-header')
    <h1>
        <small>Products</small>
    </h1>
@endsection

@section('content')
    {{ Form::open(['route' => 'admin.product_challan.store', 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'post', 'id' => 'productIssueForm', 'files' => true]) }}

    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">Products Issue</h3>

            <div class="box-tools pull-right">
                @include('backend.products.partials.products-header-buttons')
            </div><!--box-tools pull-right-->
        </div><!-- /.box-header -->

        {{-- Including Form blade file --}}
        <div class="box-body">
            <div class='row'>
                <div class='col-md-5'>
                    <div class="form-group">
                        <?php if (!$products->isEmpty()){
                            $projectData    =   [
                                'part_no'       => $products[0]->part_no,
                                'project_id'    => $products[0]->project_id,
                            ];
                        ?>
                        @include("backend.product_challan.form",$projectData)
                        <?php }else{  ?>
                        @include("backend.product_challan.form")
                        <?php } ?>
                        <div class="edit-form-btn">
                            <button type="button" class="btn btn-primary btn-md" onclick="addProductIntoProductIssueForm();">Add</button>
                            {{ link_to_route('admin.products.index', 'Remove', [], ['class' => 'btn btn-danger btn-md']) }}
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
                <div class='col-md-7'>
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
                                <?php
                                if (!$products->isEmpty()){
                                    $count = 1;
                                    $SubTotal = 0;
                                    $grandTotal = 0;
                                    foreach ($products as $data) {
                                        $SubTotal = 0;
                                        $SubTotal = $data->quantity * $data->unit_price;
                                        $grandTotal = $grandTotal + $SubTotal;
                                        $row_id = 'product_row_id_' . $data->product_id;
                                        ?>
                                        <tr id='<?php echo $row_id; ?>'>
                                            <td>{{ $count++ }}</td>
                                            <td>{{ get_product_name_by_product_id($data->product_id)->material_description }}</td>
                                            <td>{{ $data->quantity }}</td>
                                            <td>{{ getProductUnitWithProductId($data->product_id) }}</td>
                                            <td>{{ number_format((float)$data->unit_price, 2, '.', '') }}</td>
                                            <td style="text-align: right;">{{ number_format((float)$SubTotal, 2, '.', '') }}</td>
                                            <td>
                                                <span class="button btn-sm fa fa-remove" onclick="removeCurrentProduct('<?php echo $row_id; ?>', '<?php echo $data->id; ?>')"></span>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                    <tr style="background-color: #F2FFF2;">
                                        <td colspan="5" style="text-align: right; font-weight: bold;">Grand Total</td>
                                        <td style="text-align: right; font-weight: bold;">{{ number_format((float)$grandTotal, 2, '.', '') }}</td>
                                        <td style="background-color: #F2FFF2;"></td>
                                    </tr>
                                    <tr>
                                        <td colspan="7" style="text-align: right;">
                                            <?php
                                                $url = route('admin.product_challan.store');
                                                $url = route('admin.product_challan.issue_cancel');
                                            ?>
                                            <button type="button" class="btn btn-success btn-sm" onclick="saveproductReceiveDetails('<?php echo $data->receive_no ?>','<?php echo $url; ?>');">Save</button>
                                            <button type="button" class="btn btn-primary btn-sm" onclick="calcelProductIssueDetails('<?php echo $data->receive_no ?>','<?php echo $url; ?>');">Cancel</button>
                                        </td>
                                    </tr>
                                <input type="hidden" id='product_remove_url' value="<?php echo route('admin.product_receive.process_product_receive_delete_url'); ?>">
                                <input type="hidden" id='product_receive_no' value="<?php echo $receiveCode; ?>">
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div><!--box-->
    </div>
    {{ Form::close() }}
@endsection
