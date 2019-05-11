@extends ('backend.layouts.app')

@section ('title', trans('labels.backend.projects.management'))

@section('page-header')
<h1>{{ trans('labels.backend.projects.management') }}</h1>
@endsection

@section('content')
<div class="box box-info">
    <div class="box-header with-border">
        <h3 class="box-title">Product Receive List</h3>
    </div><!-- /.box-header -->

    <div class="box-body">
        <div class="table-responsive data-table-wrapper">
            <table id="blogs-table" class="table table-condensed table-hover table-bordered">
                <thead>
                    <tr>
                        <th>Part No</th>
                        <th>Receive No</th>
                        <th>Date</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th>{{ trans('labels.general.actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (isset($product_receive_list) && !empty($product_receive_list)) {
                        foreach ($product_receive_list as $list) {
                            ?>
                            <tr>
                                <td><?php echo $list->part_no; ?></td>
                                <td><?php echo $list->mrr_no; ?></td>
                                <td><?php echo date("F jS, Y", strtotime($list->mrr_date)); ?></td>
                                <td><?php echo $list->no_of_material; ?></td>
                                <td><?php echo $list->receive_total; ?></td>
                                <td>
                                    <div class="btn-group action-btn">
                                        @permission('edit-products')
                                        <?php $url    =  route('admin.product_receive.view');   ?>
                                        <button type="button" class="btn btn-success btn-sm" onclick="viewroductReceiveDetails('<?php echo $list->mrr_no ?>','<?php echo $url; ?>');">View</button>
                                        @endauth
                                        @permission('delete-products')
                                        <a class="btn btn-flat btn-default" data-method="delete" data-trans-button-cancel="Cancel" data-trans-button-confirm="Delete" data-trans-title="Are you sure you want to do this?" style="cursor:pointer;" onclick="$(this).find( & quot; form & quot; ).submit();">
                                            <i data-toggle="tooltip" data-placement="top" title="" class="fa fa-trash" data-original-title="Delete"></i>

                                            <form action="<?php echo url('admin/items/delete/' . $list->id); ?>" method="get" name="delete_item" style="display:none">
                                            </form>
                                        </a>
                                        @endauth
                                    </div>
                                </td>
                            </tr>
                        <?php }
                    } ?>
                </tbody>
            </table>
        </div><!--table-responsive-->
    </div><!-- /.box-body -->
</div><!--box-->
@endsection
@include('backend/partial/product_receive_view_modal')