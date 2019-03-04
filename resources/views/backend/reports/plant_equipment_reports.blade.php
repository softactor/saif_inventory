@extends ('backend.layouts.app')

@section ('title','Plant Equipment Reports')

@section('page-header')
@endsection

@section('content')
    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">Select Filters</h3>
        </div><!-- /.box-header -->

        {{-- Including Form blade file --}}
        <div class="box-body">
            <div class="form-group">
                @include("backend.reports.plant_equipment_filters")
            </div>
        </div><!--box-->
    </div>
@endsection
@include("backend.reports.modal.plant_equipment_report_filter_result")