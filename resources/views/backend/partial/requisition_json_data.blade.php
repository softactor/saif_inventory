<div class="row">
    <div class="col-xs-12 table-responsive">
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th colspan="3" style="text-align: center;">
                        <?php
                            $timestamp  =   $reqRows->requisition_date;
                            $hrdate     =   date("F jS, Y", strtotime($timestamp)); //September 30th, 2013
                        ?>
                        Requisition List for <?php echo $reqRows->requisition_id.' ( '.$hrdate.' )'; ?>
                    </th>
                </tr>
                <tr>
                    <th>SLN</th>
                    <th>Product</th>
                    <th>Qty</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    if(isset($products_data) && !empty($products_data)){
                        $count          =   1;
                        $SubTotal       =   0;
                        $grandTotal     =   0;
                        foreach($products_data as $data){
                            $requisition_id =   $data->requisition_id;
                            $row_id         =   'requisition_row_id_'.$data->id;
                ?>
                <tr id='<?php echo $row_id; ?>'>
                    <td>{{ $count++ }}</td>
                    <td>{{ get_product_name_by_product_id($data->material_id)->material_description }}</td>
                    <td>{{ $data->requisition_qty }}</td>
                </tr>
                    <?php }} ?>
            </tbody>
        </table>
    </div>
    <!-- /.col -->
</div>