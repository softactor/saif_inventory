<!-- Modal -->
{{ Form::open(['route' => 'admin.items.store', 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'post', 'id' => 'invMaterialForm', 'files' => true]) }}
<div id="subChildItemModal" class="modal fade" role="dialog">
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
                                                    <label for="name" class="control-label col-sm-2">Parent</label>
                                                    <div class="col-sm-10">
                                                        <?php
                                                            $get_child_items_by_parent  =   url('admin/get_child_items_by_parent');
                                                        ?>
                                                        <select class="form-control" id="category_id" name="category_id" onchange="getchilditemsByparent(this.value, '{{ $get_child_items_by_parent }}')">
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
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>                                                
                                            </td>
                                            <td>
                                                <div class="form-group">
                                                    <label for="name" class="control-label col-sm-2">Child</label>
                                                    <div class="col-sm-10">
                                                        <select class="form-control" id="material_sub_id" name="material_sub_id" required>
                                                            <option value="">Select</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">
                                                <div class="form-group">
                                                    <label for="name" class="control-label col-sm-2">Sub Child Name</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" class="form-control" id="material_description" placeholder="Enter name" name="material_description">
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
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-default" onclick="storeInvMaterial('{{ route('admin.inv_material.store') }}');">Save</button>
            </div>
        </div>
    </div>
</div>
{{ Form::close() }}