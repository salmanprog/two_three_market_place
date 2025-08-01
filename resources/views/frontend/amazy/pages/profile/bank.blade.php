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
                    
                    <div class="dashboard_white_box bg-white mb_25 pt-0 ">
                        <div class="dashboard_white_box_body">
                        <form enctype="multipart/form-data">
                            @csrf
                <div class="white-box">
                <div class="add-visitor">
                    <div class="row">
                        <div class="col-xl-6">
                            <div class="primary_input mb-25">
                                <label class="primary_input_label" for="bank_title">Account Title<span class="text-danger">*</span></label>
                                <input name="bank_title" class="primary_input_field" placeholder="-" type="text" value="Jonnie">
                                                                   </div>

                        </div>
                        <div class="col-xl-6">
                            <div class="primary_input mb-25">
                                <label class="primary_input_label" for="bank_account_number">Account Number <span class="text-danger">*</span></label>
                                <input name="bank_account_number" class="primary_input_field" placeholder="-" type="text" value="ABFRS1235844GG415">
                                                                   </div>

                        </div>
                        <div class="col-xl-6">
                            <div class="primary_input mb-25">
                                <label class="primary_input_label" for="bank_name">Bank Name <span class="text-danger">*</span></label>
                                <input name="bank_name" class="primary_input_field" placeholder="-" type="text" value="Stripe Bank">
                                                                   </div>

                        </div>

                        <div class="col-xl-6">
                            <div class="primary_input mb-25">
                                <label class="primary_input_label" for="branch_name">Branch Name <span class="text-danger">*</span></label>
                                <input name="branch_name" class="primary_input_field" placeholder="-" type="text" value="US">
                                                                   </div>

                        </div>

                        <div class="col-xl-6">
                            <div class="primary_input mb-25">
                                <label class="primary_input_label" for="routing_number">Routing Number <span class="text-danger">*</span></label>
                                <input name="routing_number" class="primary_input_field" placeholder="-" type="text" value="110000000">
                                                                   </div>

                        </div>
                        <div class="col-xl-6">
                            <div class="primary_input mb-25">
                                <label class="primary_input_label" for="ibn">IBN <span class="text-danger">*</span></label>
                                <input name="ibn" class="primary_input_field" placeholder="-" type="text" value="MBJ00000122145GD00123884643">
                                                                   </div>

                        </div>

                        
                    </div>

                    <div class="row mt-40">
                        <div class="col-lg-12 text-center tooltip-wrapper" data-title="" data-original-title="" title="">
                            <button class="primary-btn fix-gr-bg tooltip-wrapper " id="copyrightBtn">
                                <span class="ti-check"></span>
                                Update </button>
                        </div>


                    </div>

                </div>
            </div>
        </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="modal_div"></div>
@endsection

@push('scripts')

@endpush
