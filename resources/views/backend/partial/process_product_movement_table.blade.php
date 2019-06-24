<?php
    if(isset($products) && !empty($products)){
        $count          =   1;
        $SubTotal       =   0;
        $grandTotal     =   0;
        foreach($products as $data){
            $requisition_id =   $data->receive_no;
            $row_id         =   'requisition_row_id_'.$data->product_id;
?>
<tr id='<?php echo $row_id; ?>'>
    <td>{{ $count++ }}</td>
    <td>{{ get_product_name_by_product_id($data->product_id)->material_description }}</td>
    <td>{{ $data->quantity }}</td>
    <td>
        <span class="button btn-sm fa fa-remove" onclick="removeCurrentProduct('<?php echo $row_id; ?>', '<?php echo $data->id; ?>')"></span>
    </td>
</tr>
<?php } ?>
<tr>
    <td colspan="7" style="text-align: right;">
        <?php $url    =  route('admin.product_movement.store');   ?>
        <button type="button" class="btn btn-success btn-sm" onclick="saveproductMovementDetails('<?php echo $data->receive_no ?>','<?php echo $url; ?>');">Save</button>
        <button type="button" class="btn btn-primary btn-sm">Cancel</button>
    </td>
</tr>
<?php } ?>
<input type="hidden" id='product_remove_url' value="<?php echo route('admin.product_requisition.process_product_requisition_delete_url'); ?>">
<input type="hidden" id='product_receive_no' value="<?php echo $requisition_id; ?>">