<form class="form-inline" action="" id='stockManagementFilter'>
    <!--
    <div class="form-group">
        <label class="sr-only" for="email">Project</label>
        <select class="form-control" id="project_id" name="project_id">
                <option value="">Project</option>
                <?php
//                    $tableName                      =   'projects';
//                    $order_by['order_by']           =   'ASC';
//                    $order_by['order_by_column']    =   'project_name';
//                    $projectsData                   =   get_table_data_by_table($tableName, $order_by);
//                    if(isset($projectsData) && !empty($projectsData)){
//                        foreach($projectsData as $data){
                ?>
                <option value="<?php //echo $data->id; ?>"><?php //echo $data->project_name; ?></option>
                <?php //}} ?>
        </select>
    </div>
    -->
    <div class="form-group">
        <label class="sr-only" for="name">Date form</label>
        <input type="text" class="form-control" id="from_date" name="date_form" placeholder="From Date" value="<?php echo date('Y-m-d'); ?>">
    </div>
    <input type="hidden" name="report_url" id='report_url' value="<?php echo route('admin.reports.get-issue-report-data') ?>">
    <button type="button" class="btn btn-default" onclick="getFilterWiseStockManagementResult();">Reports</button>
</form>