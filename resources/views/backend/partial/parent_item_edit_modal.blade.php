<!-- Modal -->
{{ Form::open(['route' => 'admin.items.update', 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'post', 'id' => 'parentItemEditModalForm', 'files' => true]) }}
<div id="parentItemEditModal" class="modal fade" role="dialog">
    <div class="modal-dialog" style="width: 70%">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Create Parent Items</h4>
            </div>
            <div class="modal-body">                   

                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">Create Items</h3>
                    </div><!-- /.box-header -->

                    {{-- Including Form blade file --}}
                    <div class="box-body">
                        <div class="form-group">
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="name" class="col-lg-2 control-label required">name</label>
                                    <div class="col-lg-10">
                                        <input name="name" id="edit_item_name" class="form-control box-size" placeholder="name" required="required" type="text">
                                    </div><!--col-lg-10-->
                                </div>
                            </div>
                        </div>
                    </div><!--box-->
                </div>

            </div>
            <div class="modal-footer"> 
                <input type="hidden" name="edit_id" id="item_edit_id">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-default" onclick="updateParentItem('{{ route('admin.items.update') }}');">Update</button>
            </div>
        </div>
    </div>
</div>
{{ Form::close() }}