<div class="box-body">
    <div class="table-responsive">          
        <table class="table" style="width: 96%;">
            <tbody>
                <tr>
                    <td>
                        <div class="form-group">
                            <label for="name" class="col-md-4">Date</label>
                            <div class="col-md-8">
                                <input type="text" autocomplete="off" name="requisition_date" id="requisition_date" class="form-control datepicker" value="<?php echo date('Y-m-d'); ?>">
                            </div>
                        </div>
                    </td>
                    <td colspan="2">
                        <div class="form-group">
                            <label for="name" class="col-md-4">Req No</label>
                            <div class="col-md-8">
                                <input type="text" name="requisition_id" id="requisition_id" class="form-control" value="<?php echo $receiveCode; ?>">
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="3">
                        <div class="form-group">
                            <label for="name" class="col-md-2 required">Project</label>
                            <div class="col-md-10">
                                <select class="form-control" id="project_id" name="project_id" required>
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
                <tr>
                    <td colspan="3">
                        <div class="form-group">
                            <label for="name" class="col-md-2">Product</label>
                            <div class="col-md-10">
                                <select class="form-control select2" id="product_id" name="product_id" required>
                                    <option value="">Select</option>
                                    <?php
                                    $projectsData   = get_product_with_category();
                                    if (isset($projectsData) && !empty($projectsData)) {
                                        foreach ($projectsData as $data) {
                                            ?>
                                            <option value="<?php echo $data['id']; ?>"><?php echo $data['material_name']; ?></option>
                                        <?php }
                                    } ?>
                                </select>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>                    
                    <td>
                        <div class="form-group">
                            <label for="name" class="col-md-4 required">Quantity</label>
                            <div class="col-md-8">
                                <input type="text" name="quantity" id="quantity" class="form-control">
                            </div>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
        <input type="hidden" id='get_product_url' value="<?php echo route('admin.products.get_product_by_item_id'); ?>" />
        <input type="hidden" id='process_product_requisition_url' value="<?php echo route('admin.product_requisition.process_product_requisition_url'); ?>" />
    </div>
</div>