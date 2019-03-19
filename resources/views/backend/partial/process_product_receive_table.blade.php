<?php
    if(isset($products) && !empty($products)){
        $count          =   1;
        $SubTotal       =   0;
        $grandTotal     =   0;
        foreach($products as $data){
            $SubTotal       =   0;
            $SubTotal       =   $data->quantity * $data->unit_price;
            $grandTotal     =   $grandTotal+$SubTotal;
?>
<tr>
    <td>{{ $count++ }}</td>
    <td>{{ get_product_name_by_product_id($data->product_id)->name }}</td>
    <td>{{ $data->quantity }}</td>
    <td>{{ number_format((float)$data->unit_price, 2, '.', '') }}</td>
    <td style="text-align: right;">{{ number_format((float)$SubTotal, 2, '.', '') }}</td>
    <td><span class="button btn-sm fa fa-pencil-square-o"></span><span class="button btn-sm fa fa-remove"></span></td>
</tr>
<?php } ?>
<tr style="background-color: greenyellow;">
    <td colspan="4" style="text-align: right;">Grand Total</td>
    <td style="text-align: right;">{{ number_format((float)$grandTotal, 2, '.', '') }}</td>
</tr>
<?php } ?>