<!-- Modal -->
{{ Form::open(['route' => 'admin.items.store', 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'post', 'id' => 'sub_material_edit_form', 'files' => true]) }}
<div id="sub_material_edit_modal" class="modal fade" role="dialog">
    <div class="modal-dialog" style="width: 70%">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Create Child Items</h4>
            </div>
            <div class="modal-body">                   

                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">Child Items</h3>
                    </div><!-- /.box-header -->

                    {{-- Including Form blade file --}}
                    <div class="box-body">
                        <div class="box-body">
                            <div class="table-responsive">          
                                <table class="table" style="width: 96%;">
                                    <tbody>
                                        <tr>
                                            <td>
                                                <div class="form-group">
                                                    <label for="name" class="col-md-4 required">Items</label>
                                                    <div class="col-md-8">
                                                        <select class="form-control" id="edit_category_id" name="category_id" required>
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
                                                                <?php
                                                                }
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </td>
                                            <td colspan="2">
                                                <div class="form-group">
                                                    <label for="name" class="col-md-4 required">Child Name</label>
                                                    <div class="col-md-8">
                                                        <input type="text" class="form-control" id="edit_material_sub_description" placeholder="Enter name" name="material_sub_description">
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div><!--box-->
                </div>

            </div>
            <div class="modal-footer">  
                <input type="hidden" name="sub_item_edit_id" id="sub_item_edit_id">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-default" onclick="storeSubMaterialEditModalData('{{ route('admin.sub_material.update') }}');">Update</button>
            </div>
        </div>
    </div>
</div>
{{ Form::close() }}