@extends ('backend.layouts.app')

@section ('title','Stock Management Reports')

@section('page-header')
@endsection

@section('content')
    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">Stock management Filters</h3>
        </div><!-- /.box-header -->
        {{-- Including Form blade file --}}
        <div class="box-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        @include("backend.reports.stock_management_filters")
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div id="stock_management_data"></div>
                </div>
            </div>
            
        </div><!--box-->
    </div>
@endsection