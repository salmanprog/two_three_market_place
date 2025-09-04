@extends('backEnd.master')
@section('styles')
<link rel="stylesheet" href="{{asset(asset_path('modules/customer/css/show_details.css'))}}" />
<style>
.white-color{
   color: #FFF !important;
}
</style>
@endsection
@section('mainContent')
<section class="admin-visitor-area up_st_admin_visitor">
   <div class="container-fluid p-0">
      <div class="row justify-content-center">
            <div class="col-12">
               <div class="white_box_50px box_shadow_white">
                  <div class="box_header">
                        <div class="main-title d-flex">
                           <h3 class="mb-0 mr-30">{{ __('Organiser Profile')}}</h3>
                        </div>
                  </div>
                  <div class="row">
                        <div class="col-md-4 col-sm-12">
                           <div class="img_div">
                              <img class="student-meta-img mb-3" src="{{ (@$staffDetails->avatar != null) ? showImage($staffDetails->avatar) : showImage('frontend/default/img/avatar.jpg') }}"  alt="">
                           </div>
                           <h3>{{$staffDetails->first_name}} {{$staffDetails->last_name}}</h3>
                           <table class="table table-borderless staffDetails_view">
                              <tr>
                                    <td>{{ __('common.name') }}</td>
                                    <td>: <span class="ml-1"></span>{{$staffDetails->first_name}} {{$staffDetails->last_name}}</td>
                              </tr>
                              <tr>
                                    <td>{{ __('common.email') }}</td>
                                    <td>: <span class="ml-1"></span>{{ $staffDetails->email }}</td>
                              </tr>
                              <tr>
                                    <td>{{ __('common.phone') }}</td>
                                    <td>: <span class="ml-1"></span>{{ (getNumberTranslate($staffDetails->phone)) ?? $staffDetails->username }}</td>
                              </tr>
                              <tr>
                                    <td>{{ __('common.registered_date') }}</td>
                                    <td>: <span class="ml-1"></span>{{ dateConvert($staffDetails->created_at) }}</td>
                              </tr>
                              <tr>
                                    <td>{{ __('common.active_status') }}</td>
                                    <td>: <span class="ml-1"></span>
                                       @if ($staffDetails->is_active == 1)
                                          <span class="badge_1">{{__('common.active')}}</span>
                                       @elseif($staffDetails->is_active == 0)
                                          <span class="badge_4">{{__('common.disabled')}}</span>
                                       @else
                                          <span class="badge_4">{{__('common.in-active')}}</span>
                                       @endif
                                    </td>
                              </tr>
                           </table>
                        </div>
                       <div class="col-md-4 col-sm-12">
                           <div class="mb-3 mb-md-0 customer_profile">
                              <h3>{{__('Event Summary')}}</h3>
                              <table class="table table-borderless customer_view">
                              <tr><td>{{__('Total Events')}}</td>
                              <td>: <span class="ml-1"></span>{{getNumberTranslate(count($staffDetails->event))}}</td></tr>
                               <tr><td>{{__('Total Sold Tickets')}}</td>
                              <td>: <span class="ml-1"></span>{{getNumberTranslate($staffDetails->event->sum('sold_ticket'))}}</td></tr>
                              <tr><td>{{__('Total Active Event')}}</td>
                              <td>: <span class="ml-1"></span>{{getNumberTranslate(count($staffDetails->event->where('to_date','>', date('Y-m-d'))))}}</td></tr>
                              <tr><td>{{__('Total Expire Event')}}</td>
                              <td>: <span class="ml-1"></span>{{getNumberTranslate(count($staffDetails->event->where('to_date','<', date('Y-m-d'))))}}</td></tr>
                              </table>
                           </div>
                        </div>
                        <div class="col-md-4 col-sm-12">
                           <div class="customer_profile">
                              <h3>{{__('common.wallet_summary')}}</h3>
                              <table class="table table-borderless customer_view">
                                    <tr><td>{{__('Total Earn')}}</td>
                                    <td>: <span class="ml-1"></span>{{single_price($staffDetails->wallet_balances->where('type', 'Deposite')->sum('amount'))}}</td></tr>
                                    <tr><td>{{__('common.pending_balance_approval')}}</td>
                                    <td>: <span class="ml-1"></span>{{single_price($staffDetails->wallet_balances->where('type', 'Withdraw')->where('status', '0')->sum('amount'))}}</td></tr>
                                    <tr><td>{{__('WithDraw Balance Approval')}}</td>
                                    <td>: <span class="ml-1"></span>{{single_price($staffDetails->wallet_balances->where('type', 'Withdraw')->where('status', '1')->sum('amount'))}}</td></tr>
                              </table>
                           </div>
                        </div>

                  </div>
                  @if ($staffDetails->description)
                        <hr>
                           <div class="row">
                              <div class="col">
                                    <label class="primary_input_label" for="">
                                       @php
                                          echo $staffDetails->description;
                                       @endphp
                                    </label>
                              </div>
                           </div>
                        <hr>
                  @endif
               </div>
            </div>
      </div>
     <div class="row mt-2">
            <div class="col-12">
               <div class="white_box_50px box_shadow_white">
                  <div class="col-lg-12 student-details">
                        <ul class="nav nav-tabs tab_column mb-50" role="tablist">
                           <li class="nav-item">
                              <a class="nav-link active" href="#Order" role="tab" data-toggle="tab">{{ __('common.orders') }}</a>
                           </li>
                           <li class="nav-item">
                              <a class="nav-link" href="#Wallet" role="tab" data-toggle="tab">{{ __('common.wallet_histories') }}</a>
                           </li>
                           <li class="nav-item">
                              <a class="nav-link" href="#Product" role="tab" data-toggle="tab">{{ __('Resell Products') }}</a>
                           </li>

                           <!-- <li class="nav-item">
                              <a class="nav-link" href="#login_ip" role="tab" data-toggle="tab">{{ __('common.login_ip') }}</a>
                           </li> -->
                        </ul>



                        </div>
               </div>
            </div>
      </div>
   </div>
</section>
<div id="product_detail_view_div"></div>
@endsection
@push("scripts")

@endpush
