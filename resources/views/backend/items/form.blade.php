<div class="box-body">
    <div class="form-group">
        {{ Form::label('name', 'name', ['class' => 'col-lg-2 control-label required']) }}

        <div class="col-lg-10">
            {{ Form::text('name', null, ['class' => 'form-control box-size', 'placeholder' => 'name', 'required' => 'required']) }}
        </div><!--col-lg-10-->
    </div><!--form control-->
</div>