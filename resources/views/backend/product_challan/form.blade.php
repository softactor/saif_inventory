<div class="box-body">
    <div class="table-responsive">          
        <table class="table" style="width: 96%;">
            <tbody>
                <tr>
                    <td>
                        <div class="form-group">
                            <label for="name" class="col-lg-4 control-label">Date</label>
                            <div class="col-lg-6">
                                <input type="text" autocomplete="off" name="receive_date" id="receive_date" class="datepicker" value="<?php echo date('Y-m-d'); ?>">
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="form-group">
                            <label for="name" class="col-lg-4 control-label">Challan No</label>
                            <div class="col-lg-6">
                                <input type="text" name="receive_no" id="receive_no" class="col-lg-6 control-label">
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="form-group">
                            <label for="name" class="col-lg-4 control-label required">Party Name</label>
                            <div class="col-lg-6">
                                <select class="form-control box-size" id="project_id" name="project_id" required>
                                    <option value="">Select</option>
                                </select>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="form-group">
                            <label for="name" class="col-lg-4 control-label required">Items</label>
                            <div class="col-lg-6">
                                <select class="form-control box-size" id="project_id" name="project_id" required>
                                    <option value="">Select</option>
                                    <?php
                                    $tableName = 'items';
                                    $order_by['order_by'] = 'ASC';
                                    $order_by['order_by_column'] = 'name';
                                    $projectsData = get_table_data_by_table($tableName, $order_by);
                                    if (isset($projectsData) && !empty($projectsData)) {
                                        foreach ($projectsData as $data) {
                                            ?>
                                            <option value="<?php echo $data->id; ?>"><?php echo $data->name; ?></option>
                                        <?php }
                                    } ?>
                                </select>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="form-group">
                            <label for="name" class="col-lg-4 control-label required">Products</label>
                            <div class="col-lg-6">
                                <select class="form-control box-size" id="item_id" name="item_id" required>
                                    <option value="">Select</option>
                                </select>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="form-group">
                            <label for="name" class="col-lg-4 control-label">Part No</label>
                            <div class="col-lg-6">
                                <input type="text" name="receive_no" id="receive_no" class="col-lg-6 control-label">
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>                    
                    <td>
                        <div class="form-group">
                            <label for="name" class="col-lg-4 control-label required">Quantity</label>
                            <div class="col-lg-6">
                                <input type="text" name="quantity" id="quantity" class="col-lg-6 control-label">
                            </div>
                        </div>
                    </td>
                    <td colspan="2">
                        <div class="form-group">
                            <label for="name" class="col-lg-4 control-label required">Project</label>
                            <div class="col-lg-6">
                                <select class="form-control box-size" id="equipment_type" name="equipment_type" required>
                                    <option value="">Select</option>
                                    <?php
                                    $tableName = 'projects';
                                    $order_by['order_by'] = 'ASC';
                                    $order_by['order_by_column'] = 'project_name';
                                    $projectsData = get_table_data_by_table($tableName, $order_by);
                                    if (isset($projectsData) && !empty($projectsData)) {
                                        foreach ($projectsData as $data) {
                                            ?>
                                            <option value="<?php echo $data->id; ?>"><?php echo $data->project_name; ?></option>
                                        <?php }
                                    } ?>
                                </select>
                            </div>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>