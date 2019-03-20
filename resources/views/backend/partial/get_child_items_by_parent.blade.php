<?php   
if(!$childData->isEmpty()){
    echo "<option value=''>Please Select</option>";
    foreach($childData as $data){ ?>
        <option value="<?php echo $data->id; ?>"><?php echo $data->material_sub_description; ?></option>
<?php 
    }
}else{ ?>
    <option value=''>Please Select</option>
<?php }
?>