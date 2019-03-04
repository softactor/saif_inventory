<?php   
if(!$products->isEmpty()){
    echo "<option value=''>Please Select</option>";
    foreach($products as $data){ ?>
        <option value="<?php echo $data->id; ?>"><?php echo $data->name; ?></option>
<?php 
    }
}else{ ?>
    <option value=''>Please Select</option>
<?php }
?>