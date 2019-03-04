<?php
    if(isset($products) && !empty($products)){
        $count  =   1;
        foreach($products as $data){
    
?>
<tr>
    <td>{{ $count++ }}</td>
    <td>{{ $data->receive_date }}</td>
    <td>{{ $data->receive_no }}</td>
    <td>{{ $data->item_id }}</td>
    <td>{{ $data->product_id }}</td>
    <td>{{ $data->part_no }}</td>
    <td>{{ $data->supplier_id }}</td>
    <td>{{ $data->quantity }}</td>
    <td>{{ $data->project_id }}</td>
</tr>
<?php
        }
    }
?>