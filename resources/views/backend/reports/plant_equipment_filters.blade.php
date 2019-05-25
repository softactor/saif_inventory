<form class="form-inline" action="" id='plantEquipmentResult'>
    <div class="form-group">
        <label class="sr-only" for="email">Project</label>
        <select class="form-control" id="project_id" name="project_id">
                <option value="">Project</option>
                <?php
                    $tableName                      =   'projects';
                    $order_by['order_by']           =   'ASC';
                    $order_by['order_by_column']    =   'project_name';
                    $projectsData                   =   get_table_data_by_table($tableName, $order_by);
                    if(isset($projectsData) && !empty($projectsData)){
                        foreach($projectsData as $data){
                ?>
                <option value="<?php echo $data->id; ?>"><?php echo $data->project_name; ?></option>
                <?php }} ?>
        </select>
    </div>
    <div class="form-group">
        <label class="sr-only" for="email">Equipment Type</label>
        <select class="form-control" id="equipment_type" name="equipment_type">
            <option value="">Equipment Type</option>
            <?php
                $tableName                      =   'project_type';
                $order_by['order_by']           =   'ASC';
                $order_by['order_by_column']    =   'name';
                $projectsData                   =   get_table_data_by_table($tableName, $order_by);
                if(isset($projectsData) && !empty($projectsData)){
                    foreach($projectsData as $data){
            ?>
            <option value="<?php echo $data->id; ?>"><?php echo $data->name; ?></option>
            <?php }} ?>
        </select>
    </div>
    <div class="form-group">
        <label class="sr-only" for="email">Equipment Type</label>
        <select class="form-control box-size" id="country_of_origin" name="country_of_origin">
            <option value="">Select</option>
            <?php
                $tableName                      =   'country';
                $order_by['order_by']           =   'ASC';
                $order_by['order_by_column']    =   'nicename';
                $projectsData                   =   get_table_data_by_table($tableName, $order_by);
                if(isset($projectsData) && !empty($projectsData)){
                    foreach($projectsData as $data){
            ?>
            <option value="<?php echo $data->id; ?>"><?php echo $data->nicename; ?></option>
            <?php }} ?>
        </select>
    </div>
    <div class="form-group">
        <label class="sr-only" for="name">Name</label>
        <input type="text" class="form-control" id="name" name="name" placeholder="Equipment Name">
    </div>
    <div class="form-group">
        <label class="sr-only" for="name">Date form</label>
        <input type="text" class="form-control" id="from_date" name="date_form" placeholder="From Date">
    </div>
    <div class="form-group">
        <label class="sr-only" for="name">Date to</label>
        <input type="text" class="form-control" id="to_date" name="date_to" placeholder="To Date">
    </div>
    <input type="hidden" name="report_url" id='report_url' value="<?php echo route('admin.plantEquipment.get_plant_equipment_reports') ?>">
    <button type="button" class="btn btn-default" onclick="getFilterWisePlantEquipmentResult();">Reports</button>
</form>