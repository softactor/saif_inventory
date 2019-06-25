<!doctype html>
<html class="no-js" lang="{{ config('app.locale') }}">
    <head>
        <link rel="shortcut icon" type="image/png" href="<?php echo asset('img/favicon_icon/favi.png') ?>"/>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        {{-- <link rel="icon" sizes="16x16" type="image/png" href="{{route('frontend.index')}}/img/favicon_icon/{{settings()->favicon}}"> --}}
        <title>@yield('title', app_name())</title>

        <!-- Meta -->
        <meta name="description" content="@yield('meta_description', 'Default Description')">
        <meta name="author" content="@yield('meta_author', 'Viral Solani')">
        <link href="https://fonts.googleapis.com/css?family=Fira+Sans" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />        
        <link href="{{ asset('css/backend/site_style.css') }}" rel="stylesheet" />        
        <link href="{{ asset('css/datatables.min.css') }}" rel="stylesheet" />        
        @yield('meta')

        <!-- Styles -->
        @yield('before-styles')

        <!-- Check if the language is set to RTL, so apply the RTL layouts -->
        <!-- Otherwise apply the normal LTR layouts -->
        @langRTL
            {{ Html::style(getRtlCss(mix('css/backend.css'))) }}
        @else
            {{ Html::style(mix('css/backend.css')) }}
        @endif
        {{ Html::style(mix('css/backend-custom.css')) }}
        @yield('after-styles')

        <!-- Html5 Shim and Respond.js IE8 support of Html5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        {{ Html::script('https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js') }}
        {{ Html::script('https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js') }}
        <![endif]-->

        <!-- Scripts -->
        <script>
            window.Laravel = {!! json_encode([ 'csrfToken' => csrf_token() ]) !!};
        </script>
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <style type="text/css">
            .phpdebugbar{
                display: none !important;
            }
            .messages-menu, .notifications-menu, .tasks-menu{
                display: none !important;
            }
        </style>
    </head>
    <body class="skin-{{ config('backend.theme') }} {{ config('backend.layout') }}">
        <div class="loading" style="display:none"></div>
        @include('includes.partials.logged-in-as')

        <div class="wrapper" id="app">
            @include('backend.includes.header')
            @include('backend.includes.sidebar-dynamic')

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    @yield('page-header')
                    <!-- Breadcrumbs would render from routes/breadcrumb.php -->
                    @if(Breadcrumbs::exists())
                        {!! Breadcrumbs::render() !!}
                    @endif
                </section>

                <!-- Main content -->
                <section class="content">
                    @include('includes.partials.messages')
                    @yield('content')
                </section><!-- /.content -->
            </div><!-- /.content-wrapper -->

            @include('backend.includes.footer')
        </div><!-- ./wrapper -->

        <!-- JavaScripts -->
        @yield('before-scripts')
        {{ Html::script(mix('js/backend.js')) }}
        {{ Html::script(mix('js/backend-custom.js')) }}
        @yield('after-scripts')
        <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
        <script src="{{ asset('js/datatables.min.js') }}"></script>
        <script>
        $.noConflict();
        jQuery( document ).ready(function( $ ) {
            $('#equipment-table').DataTable();
          // Code that uses jQuery's $ can follow here.
          $( "#from_date" ).datepicker({
            dateFormat: "yy-mm-dd"
          });
          $( "#to_date" ).datepicker({
            dateFormat: "yy-mm-dd"
          });
          $( "#receive_date" ).datepicker({
            dateFormat: "yy-mm-dd"
          });
          $( "#mv_from_date" ).datepicker({
            dateFormat: "yy-mm-dd"
          });
          $( "#mv_to_date" ).datepicker({
            dateFormat: "yy-mm-dd"
          });
          $( "#material_information" ).accordion();
          $('.select2').select2();
          var availableTags = [
                "ActionScript",
                "AppleScript",
                "Asp",
                "BASIC",
                "C",
                "C++",
                "Clojure",
                "COBOL",
                "ColdFusion",
                "Erlang",
                "Fortran",
                "Groovy",
                "Haskell",
                "Java",
                "JavaScript",
                "Lisp",
                "Perl",
                "PHP",
                "Python",
                "Ruby",
                "Scala",
                "Scheme"
              ];
              $("#part_no").autocomplete({
                source: availableTags
              });
        });
        function getFilterWisePlantEquipmentResult(){
            $.ajax({
                url: $('#report_url').val(),
                type: 'POST',
                dataType: 'json',
                data: $("#plantEquipmentResult").serialize(),
                headers: {
                    'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content'),
                },
                success: function (response) {
                    if(response.status == 'success'){
                        $('#plantEquipmentFilterresultModal').modal('show');
                        $('#dataArea').html(response.data);
                    }                   
                },
                async: false // <- this turns it into synchronous
            });
        }
        function getFilterWiseStockManagementResult(){
            $.ajax({
                url: $('#report_url').val(),
                type: 'POST',
                dataType: 'json',
                data: $("#stockManagementFilter").serialize(),
                headers: {
                    'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content'),
                },
                success: function (response) {
                    console.log('Bang');
                    console.log(response);
                    if(response.status == 'success'){
                        $('#stock_management_data').html(response.data);
                    }                   
                },
                async: false // <- this turns it into synchronous
            });
        }
        function get_product_by_item_id(item_id){
            $.ajax({
                url: $('#get_product_url').val(),
                type: 'Get',
                dataType: 'json',
                data: 'item_id=' + item_id,
                success: function (response) {
                    if(response.status == 'success'){
                        $('#product_id').html(response.data);
                    }                   
                },
                async: false // <- this turns it into synchronous
            });
        }
        function getchilditemsByparent(parent_id, url){
            if(parent_id){
                $.ajax({
                    url: url,
                    type: 'Get',
                    dataType: 'json',
                    data: 'parent_id=' + parent_id,
                    success: function (response) {
                        if(response.status == 'success'){
                            $('#material_sub_id').html(response.data);
                        }                   
                    },
                    async: false // <- this turns it into synchronous
                });
            }
        }
        //addProductIntoProductIssueForm
        function addProductIntoProductIssueForm(){
            $('.item_added_process_style').show();
            $.ajax({
                url: $('#process_product_issue_url').val(),
                type: 'POST',
                dataType: 'json',
                data: $("#productIssueForm").serialize(),
                headers: {
                    'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content'),
                },
                success: function (response) {
                    if(response.status == 'success'){
                        $("span.has-error").html(" ");
                        $("span").removeClass("has-error");
                        $('#receiveProductBody').html(response.data);   
                        $('.item_added_process_style').hide();
                    }else if(response.status =='validation_error'){
                        $('.item_added_process_style').hide();
                        $("span.has-error").html(" ");
                        $("span").removeClass("has-error");
                        $.each(response.data, function(index, val){
                            if(index == 'project_id'){
                                $('#project_id').after('<span class="has-error">'+val+'</span>');
                            }else if(index == 'supplier_id'){
                                $('#supplier_id').after('<span class="has-error">'+val+'</span>');
                            }else if(index == 'product_id'){
                                $('#product_id').after('<span class="has-error">'+val+'</span>');
                            }else{
                                $('input[name='+index+']').after('<span class="has-error">'+val+'</span>');
                            }
                        })
                    }else if(response.status == 'qty_error'){
                        $('.item_added_process_style').hide();
                        swal("Quantity Error!", response.data, "error");
                    }
                },
                async: false // <- this turns it into synchronous
            });
        }
        function addProductIntoProductReceiveForm(){
            $('.item_added_process_style').show();
            $.ajax({
                url: $('#process_product_receive_url').val(),
                type: 'POST',
                dataType: 'json',
                data: $("#productReceiveForm").serialize(),
                headers: {
                    'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content'),
                },
                success: function (response) {
                    if(response.status == 'success'){
                        $("span.has-error").html(" ");
                        $("span").removeClass("has-error");
                        $('#receiveProductBody').html(response.data); 
                        $('.item_added_process_style').hide();
                    }else{
                        $('.item_added_process_style').hide();
                        $("span.has-error").html(" ");
                        $("span").removeClass("has-error");
                        $.each(response.data, function(index, val){
                            if(index == 'project_id'){
                                $('#project_id').after('<span class="has-error">'+val+'</span>');
                            }else if(index == 'supplier_id'){
                                $('#supplier_id').after('<span class="has-error">'+val+'</span>');
                            }else if(index == 'product_id'){
                                $('#product_id').after('<span class="has-error">'+val+'</span>');
                            }else{
                                $('input[name='+index+']').after('<span class="has-error">'+val+'</span>');
                            }
                        })
                    }
                },
                async: false // <- this turns it into synchronous
            });
        }
        
        function addProductIntoProductRequisitionForm(){
            $('.item_added_process_style').show();
            $.ajax({
                url: $('#process_product_requisition_url').val(),
                type: 'POST',
                dataType: 'json',
                data: $("#productRequisitionForm").serialize(),
                headers: {
                    'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content'),
                },
                success: function (response) {
                    if(response.status == 'success'){
                        $("span.has-error").html(" ");
                        $("span").removeClass("has-error");
                        $('#receiveProductBody').html(response.data); 
                        $('.item_added_process_style').hide();
                    }else{
                        $("span.has-error").html(" ");
                        $("span").removeClass("has-error");
                        $.each(response.data, function(index, val){
                            if(index == 'project_id'){
                                $('#project_id').after('<span class="has-error">'+val+'</span>');
                            }else if(index == 'supplier_id'){
                                $('#supplier_id').after('<span class="has-error">'+val+'</span>');
                            }else if(index == 'product_id'){
                                $('#product_id').after('<span class="has-error">'+val+'</span>');
                            }else{
                                $('input[name='+index+']').after('<span class="has-error">'+val+'</span>');
                            }
                        })
                        $('.item_added_process_style').hide();
                    }
                },
                async: false // <- this turns it into synchronous
            });
        }
        
        function addProductIntoProductMovementForm(){
            $('.item_added_process_style').show();
            $.ajax({
                url         :  $('#process_product_movement_url').val(),
                type        :  'POST',
                dataType    :  'json',
                data        :  $("#productMovementForm").serialize(),
                headers: {
                    'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content'),
                },
                success: function (response) {
                    if(response.status == 'success'){
                        $("span.has-error").html(" ");
                        $("span").removeClass("has-error");
                        $('#receiveProductBody').html(response.data);  
                        $('.item_added_process_style').hide();
                    }else{
                        $('.item_added_process_style').hide();
                        $("span.has-error").html(" ");
                        $("span").removeClass("has-error");
                        $.each(response.data, function(index, val){
                            if(index == 'project_id'){
                                $('#project_id').after('<span class="has-error">'+val+'</span>');
                            }else if(index == 'supplier_id'){
                                $('#supplier_id').after('<span class="has-error">'+val+'</span>');
                            }else if(index == 'product_id'){
                                $('#product_id').after('<span class="has-error">'+val+'</span>');
                            }else{
                                $('input[name='+index+']').after('<span class="has-error">'+val+'</span>');
                            }
                        })
                    }
                },
                async: false // <- this turns it into synchronous
            });
        }
        
        function removeCurrentProduct(rowid, product_id){
            swal({
                title: "Are you sure?",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: '#DD6B55',
                confirmButtonText: 'Confirm!',
                cancelButtonText: "Cancel",
                closeOnConfirm: false,
                closeOnCancel: false
             },
            function(isConfirm){
              if (isConfirm){
                $.ajax({
                    url: $('#product_remove_url').val(),
                    type: 'POST',
                    dataType: 'json',
                    data: 'product_receive_no='+ $('#product_receive_no').val() +'&delete_id='+product_id,
                    headers: {
                        'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content'),
                    },
                    success: function (response) {
                        if(response.status == 'success'){
                            $('#receiveProductBody').html(response.data);
                            swal.close();
                        }else{
                            $('#receiveProductBody').html('');;
                            swal.close();
                        }                                      
                    },
                    async: false // <- this turns it into synchronous
                });
               }else{
                   swal.close();
               }
            });
        }
        
        function addParentItemCategory(){
            $('#parentItemModal').modal('show');
            $('#item_name').val('');
        }
        function addChildItemCategory(){
            $('#childItemModal').modal('show');
            $('#item_name').val('');
        }
        function addSubChildItemCategory(){
            $('#subChildItemModal').modal('show');
            $('#item_name').val('');
        }
        function storeParentItem(url){
            $.ajax({
                url         : url,
                type        : 'POST',
                dataType    : 'json',
                data        : $("#parentItemModalForm").serialize(),
                headers: {
                    'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content'),
                },
                success: function (response) {
                    if(response.status == 'success'){
                        $('#item_name').val('');
                        $('#parentItemModal').modal('hide');
                        swal("Success", response.message, "success");
                        window.location = response.redirect_url;
                    }else{
                        $('#item_name').val('');
                        $('#parentItemModal').modal('hide');
                        swal("Error", response.message, "error");
                    }                  
                },
                async: false // <- this turns it into synchronous
            });
        }
        // store child item
        function storeChildItem(url){
            $.ajax({
                url         : url,
                type        : 'POST',
                dataType    : 'json',
                data        : $("#childItemModalForm").serialize(),
                headers: {
                    'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content'),
                },
                success: function (response) {
                    if(response.status == 'success'){
                        $('#material_sub_id').val('');
                        $('#material_sub_description').val('');
                        $('#childItemModal').modal('hide');
                        swal("Success", response.message, "success");
                        window.location = response.redirect_url;
                    }else{
                        $('#item_name').val('');
                        $('#childItemModal').modal('hide');
                        swal("Error", response.message, "error");
                    }                  
                },
                async: false // <- this turns it into synchronous
            });
        }
        function updateParentItem(url){
            $.ajax({
                url         : url,
                type        : 'POST',
                dataType    : 'json',
                data        : $("#parentItemEditModalForm").serialize(),
                headers: {
                    'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content'),
                },
                success: function (response) {
                    if(response.status == 'success'){
                        $('#item_name').val('');
                        $('#parentItemEditModal').modal('hide');
                        swal("Success", response.message, "success");
                        window.location = response.redirect_url;
                    }else{
                        $('#item_name').val('');
                        $('#parentItemModal').modal('hide');
                        swal("Error", response.message, "error");
                    }                  
                },
                async: false // <- this turns it into synchronous
            });
        }
        // Code that uses other library's $ can follow here.
        
        function openItemeditForm(item_id, url){
            $.ajax({
                url: url,
                type: 'Get',
                dataType: 'json',
                data: 'item_id=' + item_id,
                success: function (response) {
                    if(response.status == 'success'){   
                        $('#parentItemEditModal').modal();
                        $('#edit_item_name').val(response.data.name);
                        $('#item_edit_id').val(response.data.id);
                    }                   
                },
                async: false // <- this turns it into synchronous
            });
        }
        
        // store child item
        function storeInvMaterial(url){
            $.ajax({
                url         : url,
                type        : 'POST',
                dataType    : 'json',
                data        : $("#invMaterialForm").serialize(),
                headers: {
                    'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content'),
                },
                success: function (response) {
                    if(response.status == 'success'){
                        $('#category_id').val('');
                        $('#material_sub_id').val('');
                        $('#material_description').val('');
                        $('#subChildItemModal').modal('hide');
                        swal("Success", response.message, "success");
                        window.location = response.redirect_url;
                    }else{
                        $('#category_id').val('');
                        $('#material_sub_id').val('');
                        $('#material_description').val('');
                        $('#subChildItemModal').modal('hide');
                        swal("Error", response.message, "error");
                    }                  
                },
                async: false // <- this turns it into synchronous
            });
        }
        
        // Code that uses openSubmaterialEditForm modal can follow here.        
        function openSubmaterialEditForm(subMaterial_id, url){
            $.ajax({
                url: url,
                type: 'Get',
                dataType: 'json',
                data: 'sub_material_id=' + subMaterial_id,
                success: function (response) {
                    if(response.status == 'success'){   
                        console.log(response.data);
                        $('#sub_material_edit_modal').modal();
                        $('#edit_category_id').val(response.data.category_id);
                        $('#edit_material_sub_description').val(response.data.material_sub_description);
                        $('#sub_item_edit_id').val(response.data.id);
                    }                   
                },
                async: false // <- this turns it into synchronous
            });
        }
        
        // Sub material Update code goes here:
        function storeSubMaterialEditModalData(url){
            $.ajax({
                url         : url,
                type        : 'POST',
                dataType    : 'json',
                data        : $("#sub_material_edit_form").serialize(),
                headers: {
                    'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content'),
                },
                success: function (response) {
                    if(response.status == 'success'){
                        $('#edit_category_id').val('');
                        $('#edit_material_sub_description').val('');
                        $('#sub_item_edit_id').val('');
                        $('#sub_material_edit_modal').modal('hide');
                        swal("Success", response.message, "success");
                        window.location = response.redirect_url;
                    }else{
                        $('#edit_category_id').val('');
                        $('#edit_material_sub_description').val('');
                        $('#sub_item_edit_id').val('');
                        $('#parentItemModal').modal('hide');
                        swal("Error", response.message, "error");
                    }                  
                },
                async: false // <- this turns it into synchronous
            });
        }
        
        // open material edit modal
        function openMaterialeditForm(id, url){
            $.ajax({
                url: url,
                type: 'Get',
                dataType: 'json',
                data: 'id=' + id,
                success: function (response) {
                    if(response.status == 'success'){   
                        $('#materialEditModal').modal();
                        $('#edit_material_id').val(response.data.material_id);
                        $('#edit_material_sub_id').html(response.sub_material_data);
                        $('#edit_material_sub_id').val(response.data.material_sub_id);
                        $('#edit_qty_unit').val(response.data.qty_unit);
                        $('#edit_material_min_stock').val(response.data.material_min_stock);
                        $('#edit_material_description').val(response.data.material_description);
                        $('#material_edit_id').val(response.data.id);
                    }                   
                },
                async: false // <- this turns it into synchronous
            });
        }
        
        //updateInvMaterial
        function updateInvMaterialModalData(url){
            $.ajax({
                url         : url,
                type        : 'POST',
                dataType    : 'json',
                data        : $("#materialEditForm").serialize(),
                headers: {
                    'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content'),
                },
                success: function (response) {
                    if(response.status == 'success'){
                        $('#edit_material_id').val('');
                        $('#edit_material_sub_id').html('');
                        $('#edit_material_sub_id').val('');
                        $('#edit_qty_unit').val('');
                        $('#edit_material_min_stock').val('');
                        $('#edit_material_description').val('');
                        $('#material_edit_id').val('');
                        $('#materialEditModal').modal('hide');
                        swal("Success", response.message, "success");
                        window.location = response.redirect_url;
                    }else{
                        $('#edit_material_id').val('');
                        $('#edit_material_sub_id').html('');
                        $('#edit_material_sub_id').val('');
                        $('#edit_qty_unit').val('');
                        $('#edit_material_min_stock').val('');
                        $('#edit_material_description').val('');
                        $('#material_edit_id').val('');
                        $('#materialEditModal').modal('hide');
                        swal("Error", response.message, "error");
                    }                  
                },
                async: false // <- this turns it into synchronous
            });
        }
        
        function saveproductReceiveDetails(receive_no, url){            
            swal({
                title: "Receive Confirm?",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: '#DD6B55',
                confirmButtonText: 'Yes',
                cancelButtonText: "Cancel",
                closeOnConfirm: false,
                closeOnCancel: false
             },
            function(isConfirm){
              if (isConfirm){ 
                $.ajax({
                    url         :  url,
                    type        : 'POST',
                    dataType    : 'json',
                    data        : 'receive_no='+receive_no,
                    headers: {
                        'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content'),
                    },
                    success: function (response) {
                    //$('#productReceiveConfirmModal').modal();                    
                    if (response.status == 'success') {
                        swal("Success", response.message, "success");
                        setTimeout(function () {
                            window.location = response.redirect_route;
                        }, 2000);
                    }else{
                       swal("Failed!", response.message, "error"); 
                    }
                    },
                    async: false // <- this turns it into synchronous
                });
               }else{
                   swal.close();
               }
            });
        }
        function saveproductRequisitionDetails(receive_no, url){            
            swal({
                title: "Requisition Confirm?",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: '#DD6B55',
                confirmButtonText: 'Yes',
                cancelButtonText: "Cancel",
                closeOnConfirm: false,
                closeOnCancel: false
             },
            function(isConfirm){
              if (isConfirm){ 
                $.ajax({
                    url         :  url,
                    type        : 'POST',
                    dataType    : 'json',
                    data        : 'receive_no='+receive_no,
                    headers: {
                        'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content'),
                    },
                    success: function (response) {
                    //$('#productReceiveConfirmModal').modal();                    
                    if (response.status == 'success') {
                        swal("Success", response.message, "success");
                        setTimeout(function () {
                            window.location = response.redirect_route;
                        }, 2000);
                    }else{
                       swal("Failed!", response.message, "error"); 
                    }
                    },
                    async: false // <- this turns it into synchronous
                });
               }else{
                   swal.close();
               }
            });
        }
        function saveproductMovementDetails(receive_no, url){            
            swal({
                title               : "Movement Confirm?",
                type                : "warning",
                showCancelButton    : true,
                confirmButtonColor  : '#DD6B55',
                confirmButtonText   : 'Yes',
                cancelButtonText    : "Cancel",
                closeOnConfirm      : false,
                closeOnCancel       : false
             },
            function(isConfirm){
              if (isConfirm){ 
                $.ajax({
                    url         :  url,
                    type        : 'POST',
                    dataType    : 'json',
                    data        : $("#productMovementForm").serialize(),
                    headers: {
                        'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content'),
                    },
                    success: function (response) {
                    //$('#productReceiveConfirmModal').modal();                    
                    if (response.status == 'success') {
                        swal("Success", response.message, "success");
                        setTimeout(function () {
                            window.location = response.redirect_route;
                        }, 2000);
                    }else{
                       swal("Failed!", response.message, "error"); 
                    }
                    },
                    async: false // <- this turns it into synchronous
                });
               }else{
                   swal.close();
               }
            });
        }
        function viewroductReceiveDetails(mrr_no, url){            
            $.ajax({
                url         :  url,
                type        : 'GET',
                dataType    : 'json',
                data        : 'mrr_no='+mrr_no,
                success: function (response) {
                    //$('#productReceiveConfirmModal').modal();                    
                    if (response.status == 'success') {
                        $('#productReceiveViewModal').modal('show');
                        $('#modal_body_content').html(response.data);
                    }else{
                       swal("Failed!", response.message, "error"); 
                    }
                },
                async: false // <- this turns it into synchronous
            });
        }
        function viewroductIssueDetails(issue_id, url){            
            $.ajax({
                url         :  url,
                type        : 'GET',
                dataType    : 'json',
                data        : 'issue_id='+issue_id,
                success: function (response) {
                    //$('#productReceiveConfirmModal').modal();                    
                    if (response.status == 'success') {
                        $('#productIssueViewModal').modal('show');
                        $('#modal_body_content').html(response.data);
                    }else{
                       swal("Failed!", response.message, "error"); 
                    }
                },
                async: false // <- this turns it into synchronous
            });
        }
        // Code that uses other library's $ can follow here.
        
        function calcelProductIssueDetails(receive_no, url){
            $.ajax({
                url: url,
                type: 'Get',
                dataType: 'json',
                data: 'receive_no=' + receive_no,
                success: function (response) {
                    if (response.status == 'success') {
                        swal("Success", response.message, "success");
                        setTimeout(function () {
                            window.location = response.redirect_route;
                        }, 2000);
                    }else{
                       swal("Failed!", response.message, "error"); 
                    }                   
                },
                async: false // <- this turns it into synchronous
            });
        }
        function productPartNoSuggession(typePartNo){
            console.log(typePartNo);
            
        }
        function getRequisitionDetailsByRequisitionId(id, url){
            if(id){
                $.ajax({
                    url: url,
                    type: 'Get',
                    dataType: 'json',
                    data: 'requisition_id=' + id,
                    success: function (response) {
                        if (response.status == 'success') {
                           $('#rjdata').html(response.data);
                        }else{
                           swal("Failed!", response.message, "error"); 
                        }                   
                    },
                    async: false // <- this turns it into synchronous
                });
            }else{
                $('#rjdata').html('');
            }
        }
        </script>
    </body>
</html>