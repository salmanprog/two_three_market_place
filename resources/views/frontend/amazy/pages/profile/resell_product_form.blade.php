@extends('frontend.amazy.layouts.app')
<style>
    @media (max-width:767px){
        .sumery_product_details .table-responsive table{
            width: 700px
        }
        .summery_pro_content{
            padding-left: 40px;
        }
        .sumery_product_details .amazy_table3 tbody tr td{
            padding: 10px
        }
    }
</style>

@section('content')
    <div class="amazy_dashboard_area dashboard_bg section_spacing6">
        <div class="container">
            <div class="row">
                <div class="col-xl-3 col-lg-4">
                    @include('frontend.amazy.pages.profile.partials._menu')
                </div>
                <div class="col-xl-9 col-lg-8">
                    <div class="dashboard_white_box_header d-flex align-items-center gap_20  mb_20">

                    </div>
                    <div class="dashboard_white_box bg-white mb_25 pt-0 ">
                        <div class="dashboard_white_box_body">
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="modal_div"></div>
@endsection

@push('scripts')
    <script>
        (function($){
            "use strict";
            $(document).ready(function(){
                $(document).on('change', '#filter_order', function(){
                    let fil_value = $(this).val();
                    let url = "{{url()->current()}}" + '?filter='+fil_value;
                    $('#pre-loader').show();
                    location.replace(url)
                });
                $(document).on('click', '.page_link', function(event){
                    event.preventDefault();
                    let current_page = $(this).attr('href');
                    let fil_value = $('#filter_order').val();
                    let url = current_page + '&filter='+fil_value;
                    $('#pre-loader').show();
                    location.replace(url)
                });

                $(document).on('click', '.purchase_show', function(event){
                    let id = $(this).data('id');
                    let data = {
                        _token: "{{csrf_token()}}",
                        order_id: id
                    }
                    $('#pre-loader').show();
                    $.post("{{route('frontend.my_purchase_history_modal')}}",data, function(response){
                        $('#modal_div').html(response);
                        $('#purchase_history_modal').modal('show');
                        $('#pre-loader').hide();
                    });
                });
            });
        })(jQuery);
    </script>
@endpush
