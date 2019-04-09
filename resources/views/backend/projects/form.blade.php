<div class="box-body">
    <div class="form-group">
        {{ Form::label('name', trans('validation.attributes.backend.projects.name'), ['class' => 'col-lg-2 control-label required']) }}

        <div class="col-lg-10">
            {{ Form::text('project_name', null, ['class' => 'form-control box-size', 'placeholder' => trans('validation.attributes.backend.projects.name'), 'required' => 'required']) }}
        </div><!--col-lg-10-->
    </div><!--form control-->
    <div class="form-group">
        {{ Form::label('code', 'code', ['class' => 'col-lg-2 control-label required']) }}

        <div class="col-lg-10">
            {{ Form::text('code', null, ['class' => 'form-control box-size', 'placeholder' => 'Code', 'required' => 'required']) }}
        </div><!--col-lg-10-->
    </div><!--form control-->
    <div class="form-group">
        {{ Form::label('address', trans('validation.attributes.backend.plant_equipments.remarks'), ['class' => 'col-lg-2 control-label required']) }}

        <div class="col-lg-10 mce-box">
            {{ Form::textarea('address', null, ['class' => 'form-control', 'placeholder' => 'address']) }}
        </div><!--col-lg-10-->
    </div><!--form control-->
</div>