<?php
    if(isset($products) && !empty($products)){
        $count          =   1;
        $SubTotal       =   0;
        $grandTotal     =   0;
        foreach($products as $data){
            $SubTotal       =   0;
            $SubTotal       =   $data->quantity * $productUnitPrice;
            $grandTotal     =   $grandTotal+$SubTotal;
            $row_id         =   'product_row_id_'.$data->product_id;
?>
<tr id='<?php echo $row_id; ?>'>
    <td>{{ $count++ }}</td>
    <td>{{ get_product_name_by_product_id($data->product_id)->material_description }}</td>
    <td>{{ $data->quantity }}</td>
    <td>{{ getProductUnitWithProductId($data->product_id) }}</td>
    <td>{{ number_format((float)$productUnitPrice, 2, '.', '') }}</td>
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
        <?php $url    =  route('admin.product_challan.store');   ?>
        <button type="button" class="btn btn-success btn-sm" onclick="saveproductReceiveDetails('<?php echo $data->receive_no ?>','<?php echo $url; ?>');">Save</button>
        <button type="button" class="btn btn-primary btn-sm">Cancel</button>
    </td>
</tr>
<input type="hidden" id='product_remove_url' value="<?php echo route('admin.product_receive.process_product_receive_delete_url'); ?>">
<input type="hidden" id='product_receive_no' value="<?php echo $product_receive_no; ?>">
<?php } ?>