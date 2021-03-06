<!-- Main content -->
<section class="invoice">
    <!-- title row -->
    <div class="row">
        <div class="col-xs-12">
            <h2 class="page-header">
                <i class="fa fa-globe"></i> E-Engineering.
                <small class="pull-right">Date: <?php echo $inv_receive->mrr_no; ?></small>
                 &nbsp;<small class="pull-right">MrrNo: <?php echo date("F jS, Y", strtotime($inv_receive->mrr_date)); ?></small> &nbsp;
            </h2>
        </div>
        <!-- /.col -->
    </div>
    <!-- info row -->
    <div class="row invoice-info">
        <div class="col-sm-6 invoice-col">
            From
            <address>
                <strong>{{ getTableRawDetails('suppliers', $inv_receive->supplier_id)->name }}</strong><br>
                {{ getTableRawDetails('suppliers', $inv_receive->supplier_id)->address }}
            </address>
        </div>
        <!-- /.col -->
        <div class="col-sm-6 invoice-col">
            To
            <address>
                <strong>{{ getTableRawDetails('projects', $inv_receive->receive_ware_hosue_id)->project_name }}</strong><br>
                {{ getTableRawDetails('projects', $inv_receive->receive_ware_hosue_id)->address }}
            </address>
        </div>
    </div>
    <!-- /.row -->

    <!-- Table row -->
    <div class="row">
        <div class="col-xs-12 table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>SLN</th>
                        <th>Product</th>
                        <th>Qty</th>
                        <th>Unit Price</th>
                        <th><span class='pull-right'>Subtotal</span></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (isset($products) && !empty($products)) {
                        $count = 1;
                        $SubTotal = 0;
                        $grandTotal = 0;
                        foreach ($products as $data) {
                            $SubTotal = 0;
                            $SubTotal = $data->receive_qty * $data->unit_price;
                            $grandTotal = $grandTotal + $SubTotal;
                            $row_id = 'product_row_id_' . $data->material_id;
                            ?>
                            <tr id='<?php echo $row_id; ?>'>
                                <td>{{ $count++ }}</td>
                                <td>{{ get_product_name_by_product_id($data->material_id)->material_description }}</td>
                                <td>{{ $data->receive_qty }}</td>
                                <td>{{ number_format((float)$data->unit_price, 2, '.', '') }}</td>
                                <td style="text-align: right; font-weight: bold;">{{ number_format((float)$SubTotal, 2, '.', '') }}</td>
                            </tr>
                        <?php }
                    } ?>
                </tbody>
            </table>
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->

    <div class="row">
        <!-- /.col -->
        <div class="col-xs-6 pull-right">
            <div class="table-responsive">
                <table class="table">
                    <tr>
                        <th>Total:</th>
                        <td><span class="pull-right">{{ number_format((float)$grandTotal, 2, '.', '') }}</span></td>
                    </tr>
                </table>
            </div>
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->

    <!-- this row will not appear when printing -->
    <div class="row no-print">
        <div class="col-xs-12">
            <a href="invoice-print.html" target="_blank" class="btn btn-default"><i class="fa fa-print"></i> Print</a>
            <button type="button" class="btn btn-primary pull-right" style="margin-right: 5px;">
                <i class="fa fa-download"></i> Generate PDF
            </button>
        </div>
    </div>
</section>
<!-- /.content -->