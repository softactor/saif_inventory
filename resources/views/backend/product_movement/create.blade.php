@extends ('backend.layouts.app')

@section ('title', 'Purchase Requisition')

@section('page-header')
    <h1>
        <small>Movement Entry</small>
    </h1>
@endsection

@section('content')
    {{ Form::open(['route' => 'admin.products.store', 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'post', 'id' => 'productMovementForm', 'files' => true]) }}

    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">Movement Entry</h3>

            <div class="box-tools pull-right">
                @include('backend.product_movement.partials.products-header-buttons')
            </div><!--box-tools pull-right-->
        </div><!-- /.box-header -->

        {{-- Including Form blade file --}}
        <div class="box-body">
            <div class='row'>
                <div class='col-md-5'>
                    <div class="form-group">
                        @include("backend.product_movement.form")
                        <div class="edit-form-btn">
                            <button type="button" class="btn btn-primary btn-md" onclick="addProductIntoProductMovementForm();">Add</button>
                            {{ link_to_route('admin.products.index', 'Remove', [], ['class' => 'btn btn-danger btn-md']) }}
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
                <div class='col-md-7'>
                    <div class="row">
                        <div class="col-md-12">
                            @include("backend.partial.item_added_process_style")
                            <div class="table-responsive table-bordered">          
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Product Name</th>
                                            <th>Quantity</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="receiveProductBody">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!--box-->
    </div>
    {{ Form::close() }}
@endsection
