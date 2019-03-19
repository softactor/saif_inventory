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
        <?php
            if(!empty($google_analytics)){
                echo $google_analytics;
            }
        ?>
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
        <script>
        $.noConflict();
        jQuery( document ).ready(function( $ ) {
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
          $( "#material_information" ).accordion();
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
        function addProductIntoProductReceiveForm(){
            $.ajax({
                url: $('#process_product_receive_url').val(),
                type: 'POST',
                dataType: 'json',
                data: $("#productReceiveForm").serialize(),
                headers: {
                    'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content'),
                },
                success: function (response) {
                    $('#receiveProductBody').html(response.data);                  
                },
                async: false // <- this turns it into synchronous
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
        </script>
    </body>
</html>