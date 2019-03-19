<!-- Modal -->
{{ Form::open(['route' => 'admin.items.store', 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'post', 'id' => 'parentItemModalForm', 'files' => true]) }}
<div id="parentItemModal" class="modal fade" role="dialog">
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
                                    {{ Form::label('name', 'name', ['class' => 'col-lg-2 control-label required']) }}

                                    <div class="col-lg-10">
                                        {{ Form::text('name', null, ['id'=> 'item_name','class' => 'form-control box-size', 'placeholder' => 'name', 'required' => 'required']) }}
                                    </div><!--col-lg-10-->
                                </div><!--form control-->
                            </div>
                        </div>
                    </div><!--box-->
                </div>

            </div>
            <div class="modal-footer">  
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-default" onclick="storeParentItem('{{ route('admin.items.store') }}');">Save</button>
            </div>
        </div>
    </div>
</div>
{{ Form::close() }}