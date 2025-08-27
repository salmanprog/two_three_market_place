@extends('backEnd.master')
@section('styles')
<link rel="stylesheet" href="{{asset(asset_path('backend/css/backend_page_css/dashboard.css'))}}" />
<link rel="stylesheet" href="{{asset(asset_path('backend/css/backend_global.css'))}}" />
@endsection
@section('mainContent')
<section class="mb-40">
    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-12 mb_10">
                <div class="main-title d-flex">
                    <h3 class="mb-0 mr-3 text-nowrap">{{ __('common.summary') }} </h3>
                    @if(isModuleActive('MultiVendor'))
                    @if(auth()->user()->role->type == 'superadmin' || auth()->user()->role->type == 'seller' || auth()->user()->role->type == 'admin')
                    <!-- <ul class="d-flex">
                        <li><a href="{{route('seller.dashboard')}}" target="_blank"
                                class="primary-btn radius_30px mr-10 fix-gr-bg">{{ __('dashboard.seller_dashboard')
                                }}</a>
                        </li>
                    </ul> -->
                    @endif
                    @endif
                </div>
            </div>
            @if (permissionCheck('widget_card'))
            <!-- <div class="col-lg-8 col-md-8 col-sm-12">
                <div class="float-md-right float-none pos_tab_btn justify-content-end">
                    <ul class="nav">
                        <li class="nav-item mb_5">
                            <a class="nav-link filtering active" data-type="today" href="javascript:void(0)">{{
                                __('dashboard.today') }}</a>
                        </li>
                        <li class="nav-item mb_5">
                            <a class="nav-link filtering" data-type="week" href="javascript:void(0)">{{
                                __('dashboard.this_week') }}</a>
                        </li>
                        <li class="nav-item mb_5">
                            <a class="nav-link filtering" data-type="month" href="javascript:void(0)">{{
                                __('dashboard.this_month') }}</a>
                        </li>
                        <li class="nav-item mb_5">
                            <a class="nav-link filtering" data-type="year" href="javascript:void(0)">{{
                                __('dashboard.this_year') }}</a>
                        </li>
                    </ul>
                </div>
            </div> -->
            @endif
        </div>
        @if (permissionCheck('widget_card'))
        <div class="row mb_30">
            @if (app('dashboard_setup')->where('type', 'total_product_card')->first()->is_active &&
            permissionCheck('widget_total_product'))
            <div class="col-xl-3 col-lg-4 col-md-4 col-sm-6">
                <div class="white-box single-summery @if (app('dashboard_setup')->where('type', 'total_products')->first()->is_active == 1) active @elseif (app('dashboard_setup')->where('type', 'total_products')->first()->is_active == 2) bg_active @endif">
                    <a href="javascript:void(0);">
                        <div class="d-block mt-10">
                            <h3>{{ __('Total Inventory') }}</h3>
                            <img class="demo_wait d-none" height="60px"
                                src="{{showImage('backend/img/loader.gif')}}" alt="">
                            <h1 class="gradient-color2 total_products">{{ getNumberTranslate($totalProducts) }}</h1>
                        </div>
                    </a>
                </div>
            </div>
            @endif
            @if (app('dashboard_setup')->where('type', 'total_seller_card')->first()->is_active &&
            permissionCheck('widget_total_seller') && isModuleActive('MultiVendor'))
            <div class="col-xl-3 col-lg-4 col-md-4 col-sm-6">
                <div
                    class="white-box single-summery @if (app('dashboard_setup')->where('type', 'total_sellers')->first()->is_active == 1) active @elseif (app('dashboard_setup')->where('type', 'total_sellers')->first()->is_active == 2) bg_active @endif">
                    <a href="javascript:void(0);">
                        <div class="d-block mt-10">
                            <h3>{{ __('Total Artist') }}</h3>
                            <img class="demo_wait d-none" height="60px"
                                src="{{showImage('backend/img/loader.gif')}}" alt="">
                            <h1 class="gradient-color2">{{ getNumberTranslate($totalSellers) }}</h1>
                        </div>
                    </a>
                </div>
            </div>
            @endif
            @if (app('dashboard_setup')->where('type', 'total_customer_card')->first()->is_active &&
            permissionCheck('widget_total_customer'))
            <div class="col-xl-3 col-lg-4 col-md-4 col-sm-6">
                <div
                    class="white-box single-summery @if (app('dashboard_setup')->where('type', 'total_customer')->first()->is_active == 1) active @elseif (app('dashboard_setup')->where('type', 'total_customer')->first()->is_active == 2) bg_active  @endif">
                    <a href="javascript:void(0);">
                        <div class="d-block mt-10">
                            <h3>{{ __('Total Buyer') }}</h3>
                            <img class="demo_wait d-none" height="60px"
                                src="{{showImage('backend/img/loader.gif')}}" alt="">
                            <h1 class="gradient-color2">{{ getNumberTranslate($totalCustomers) }}</h1>
                        </div>
                    </a>
                </div>
            </div>
            @endif
            @if (app('dashboard_setup')->where('type', 'visitor_card')->first()->is_active &&
            permissionCheck('widget_visitor'))
            <div class="col-xl-3 col-lg-4 col-md-4 col-sm-6">
                <div
                    class="white-box single-summery @if (app('dashboard_setup')->where('type', 'todays_visitor')->first()->is_active == 1) active @elseif (app('dashboard_setup')->where('type', 'todays_visitor')->first()->is_active == 2) bg_active  @endif">
                    <a href="javascript:void(0);">
                        <div class="d-block mt-10">
                            <h3>{{ __('Total Organiser') }}</h3>
                            <img class="demo_wait d-none" height="60px"
                                src="{{showImage('backend/img/loader.gif')}}" alt="">
                            <h1 class="gradient-color2 total_visitors">{{ getNumberTranslate($totalOrganiser) }}</h1>
                        </div>
                    </a>
                </div>
            </div>
            @endif
            @if (app('dashboard_setup')->where('type', 'total_order_card')->first()->is_active &&
            permissionCheck('widget_total_order'))
            <div class="col-xl-3 col-lg-4 col-md-4 col-sm-6">
                <div
                    class="white-box single-summery @if (app('dashboard_setup')->where('type', 'total_order')->first()->is_active == 1) active @elseif (app('dashboard_setup')->where('type', 'total_order')->first()->is_active == 2) bg_active  @endif">
                    <a href="javascript:void(0);"">
                        <div class="d-block mt-10">
                            <h3>{{ __('dashboard.total_order') }}</h3>
                            <img class="demo_wait d-none" height="60px"
                                src="{{showImage('backend/img/loader.gif')}}" alt="">
                            <h1 class="gradient-color2 total_order">{{ getNumberTranslate($total_order) }}</h1>
                        </div>
                    </a>
                </div>
            </div>
            @endif
            @if (app('dashboard_setup')->where('type', 'total_pending_order_card')->first()->is_active &&
            permissionCheck('widget_total_pending_order'))
            <div class="col-xl-3 col-lg-4 col-md-4 col-sm-6">
                <div
                    class="white-box single-summery @if (app('dashboard_setup')->where('type', 'pending_order')->first()->is_active == 1) active @elseif (app('dashboard_setup')->where('type', 'pending_order')->first()->is_active == 2) bg_active  @endif">
                    <a href="javascript:void(0);">
                        <div class="d-block mt-10">
                            <h3>{{ __('dashboard.total_pending_order') }}</h3>
                            <img class="demo_wait d-none" height="60px"
                                src="{{showImage('backend/img/loader.gif')}}" alt="">
                            <h1 class="gradient-color2 total_pending_order">{{ getNumberTranslate($total_pending_order) }}</h1>
                        </div>
                    </a>
                </div>
            </div>
            @endif
            @if (app('dashboard_setup')->where('type', 'total_completed_order_card')->first()->is_active &&
            permissionCheck('widget_total_completed_order'))
            <div class="col-xl-3 col-lg-4 col-md-4 col-sm-6">
                <div
                    class="white-box single-summery @if (app('dashboard_setup')->where('type', 'completed_order')->first()->is_active == 1) active @elseif (app('dashboard_setup')->where('type', 'completed_order')->first()->is_active == 2) bg_active  @endif">
                    <a href="javascript:void(0);">
                        <div class="d-block mt-10">
                            <h3>{{ __('dashboard.total_completed_order') }}</h3>
                            <img class="demo_wait d-none" height="60px"
                                src="{{showImage('backend/img/loader.gif')}}" alt="">
                            <h1 class="gradient-color2 total_completed_order">{{ getNumberTranslate($total_completed_order) }}</h1>
                        </div>
                    </a>
                </div>
            </div>
            @endif
            @if (app('dashboard_setup')->where('type', 'total_sale_amount_card')->first()->is_active &&
            permissionCheck('widget_total_sale'))
            <div class="col-xl-3 col-lg-4 col-md-4 col-sm-6">
                <div
                    class="white-box single-summery @if (app('dashboard_setup')->where('type', 'total_sale')->first()->is_active == 1) active @elseif (app('dashboard_setup')->where('type', 'total_sale')->first()->is_active == 2) bg_active  @endif">
                    <div class="d-block mt-10">
                        <h3>{{ __('dashboard.total_sale') }}</h3>
                        <img class="demo_wait d-none" height="60px"
                            src="{{showImage('backend/img/loader.gif')}}" alt="">
                        <h1 class="gradient-color2 total_sale">{{ single_price($total_sale) }}</h1>
                    </div>
                </div>
            </div>
            @endif
            @if (app('dashboard_setup')->where('type', 'total_review_card')->first()->is_active &&
            permissionCheck('widget_total_review'))
            <div class="col-xl-3 col-lg-4 col-md-4 col-sm-6">
                <div
                    class="white-box single-summery @if (app('dashboard_setup')->where('type', 'total_review')->first()->is_active == 1) active @elseif (app('dashboard_setup')->where('type', 'total_sale')->first()->is_active == 2) bg_active  @endif">
                    <div class="d-block mt-10">
                        <h3>{{ __('Total Events') }}</h3>
                        <img class="demo_wait d-none" height="60px"
                            src="{{showImage('backend/img/loader.gif')}}" alt="">
                        <h1 class="gradient-color2 total_review">{{ getNumberTranslate($total_event) }}</h1>
                    </div>
                </div>
            </div>
            @endif
            @if (app('dashboard_setup')->where('type', 'total_revenue_card')->first()->is_active &&
            permissionCheck('widget_total_revenue'))
            <div class="col-xl-3 col-lg-4 col-md-4 col-sm-6">
                <div
                    class="white-box single-summery @if (app('dashboard_setup')->where('type', 'total_revenue')->first()->is_active == 1) active @elseif (app('dashboard_setup')->where('type', 'total_sale')->first()->is_active == 2) bg_active  @endif">
                    <div class="d-block mt-10">
                        <h3>{{ __('Total Active Events') }}</h3>
                        <img class="demo_wait d-none" height="60px"
                            src="{{showImage('backend/img/loader.gif')}}" alt="">
                        <h1 class="gradient-color2 total_revenue">{{ getNumberTranslate($total_active_event) }}</h1>
                    </div>
                </div>
            </div>
            @endif
            @if (app('dashboard_setup')->where('type', 'total_active_customer_card')->first()->is_active &&
            permissionCheck('widget_active_customer'))
            <div class="col-xl-3 col-lg-4 col-md-4 col-sm-6">
                <div
                    class="white-box single-summery @if (app('dashboard_setup')->where('type', 'active_customer')->first()->is_active == 1) active @elseif (app('dashboard_setup')->where('type', 'total_sale')->first()->is_active == 2) bg_active  @endif">
                    <a href="javascript:void(0);">
                        <div class="d-block mt-10">
                            <h3>{{ __('Total Expire Events') }}</h3>
                            <img class="demo_wait d-none" height="60px"
                                src="{{showImage('backend/img/loader.gif')}}" alt="">
                            <h1 class="gradient-color2">{{ getNumberTranslate($total_expire_event) }}</h1>
                        </div>
                    </a>
                </div>
            </div>
            @endif
            @if (app('dashboard_setup')->where('type', 'total_subscriber_card')->first()->is_active &&
            permissionCheck('widget_total_subcriber'))
            <div class="col-xl-3 col-lg-4 col-md-4 col-sm-6">
                <div
                    class="white-box single-summery @if (app('dashboard_setup')->where('type', 'total_subcriber')->first()->is_active == 1) active @elseif (app('dashboard_setup')->where('type', 'total_sale')->first()->is_active == 2) bg_active  @endif">
                    <div class="d-block mt-10">
                        <h3>{{ __('Total Event Bookings') }}</h3>
                        <img class="demo_wait d-none" height="60px"
                            src="{{showImage('backend/img/loader.gif')}}" alt="">
                        <h1 class="gradient-color2">{{ getNumberTranslate($total_event_bookings) }}</h1>
                    </div>
                </div>
            </div>
            @endif
        </div>
        @endif
        @if(permissionCheck('dashboard_graph'))
        <!-- <div class="row mb_30 @if (permissionCheck('widget_card')) @else mt-30 @endif">
            @if (app('dashboard_setup')->where('type', 'product_graph')->first()->is_active &&
            permissionCheck('dashboard_graph_products'))
            <div class="col-xl-4 col-md-6 col-sm-6 d-flex">
                <div class="white_box_30px mb_30 graph_dashboard w-100">
                    <div class="box_header common_table_header ">
                        <div class="main-title d-md-flex">
                            <h3 class="mb-0 mr-30 mb_xs_15px mb_sm_20px">{{ __('dashboard.products') }}</h3>
                        </div>
                    </div>
                    <div class="chart_pie_box">
                        <canvas height="150" id="traffic-chartt"></canvas>
                    </div>
                    <div class="sales_value_legend" id="traffic-chart-legendd"></div>
                </div>
            </div>
            @endif
            @if (app('dashboard_setup')->where('type', 'order_summary_graph')->first()->is_active &&
            permissionCheck('dashboard_graph_orders_summary'))
            <div class="col-xl-4 col-md-6 col-sm-6 d-flex">
                <div class="white_box_30px mb_30 graph_dashboard w-100">
                    <div class="box_header common_table_header ">
                        <div class="main-title d-md-flex">
                            <h3 class="mb-0 mr-30 mb_xs_15px mb_sm_20px">{{ __('dashboard.orders_summary') }}</h3>
                        </div>
                    </div>
                    <div class="chart_pie_box">
                        <canvas height="150" id="traffic-chart2"></canvas>
                    </div>
                    <div class="sales_value_legend" id="traffic-chart-legend2"></div>
                </div>
            </div>
            @endif
            @if (app('dashboard_setup')->where('type', 'seller_graph')->first()->is_active &&
            permissionCheck('dashboard_graph_sellers') && isModuleActive('MultiVendor'))
            <div class="col-xl-4 col-md-6 col-sm-6 d-flex">
                <div class="white_box_30px mb_30 graph_dashboard w-100">
                    <div class="box_header common_table_header ">
                        <div class="main-title d-md-flex">
                            <h3 class="mb-0 mr-30 mb_xs_15px mb_sm_20px">{{ __('dashboard.sellers') }}</h3>
                        </div>
                    </div>
                    <div class="chart_pie_box">
                        <canvas height="150" id="traffic-chart3"></canvas>
                    </div>
                    <div class="sales_value_legend" id="traffic-chart-legend3"></div>
                </div>
            </div>
            @endif
            @if (app('dashboard_setup')->where('type', 'guest_vs_registered_order_graph')->first()->is_active &&
            permissionCheck('dashboard_graph_gueast_authorize_order_today'))
            <div class="col-xl-4 col-md-6 col-sm-6 d-flex">
                <div class="white_box_30px mb_30 graph_dashboard w-100">
                    <div class="box_header common_table_header ">
                        <div class="main-title d-md-flex">
                            <h3 class="mb-0 mr-30 mb_xs_15px mb_sm_20px">
                                {{ __('dashboard.guest_authorized_order_today') }}</h3>
                        </div>
                    </div>
                    <div class="chart_pie_box">
                        <canvas height="150" id="traffic-chart4"></canvas>
                    </div>
                    <div class="sales_value_legend" id="traffic-chart-legend4"></div>
                </div>
            </div>
            @endif
            @if (app('dashboard_setup')->where('type', 'today_order_summary_graph')->first()->is_active &&
            permissionCheck('dashboard_graph_today_order_summary'))
            <div class="col-xl-4 col-md-6 col-sm-6 d-flex">
                <div class="white_box_30px mb_30 graph_dashboard w-100">
                    <div class="box_header common_table_header ">
                        <div class="main-title d-md-flex">
                            <h3 class="mb-0 mr-30 mb_xs_15px mb_sm_20px">{{ __('dashboard.today_order_summary') }}</h3>
                        </div>
                    </div>
                    <div class="chart_pie_box">
                        <canvas height="150" id="traffic-chart5"></canvas>
                    </div>
                    <div class="sales_value_legend" id="traffic-chart-legend5"></div>
                </div>
            </div>
            @endif
        </div> -->

        @if (app('business_settings')->where('type', 'google_analytics')->first()->status == 1 &&
        permissionCheck('dashboard_graph_site_analytics'))
        <!-- <div class="row mb_30">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="main-title">
                    <h3 class="mb-0">{{ __('dashboard.site_analytics') }}</h3>
                </div>
            </div>
            @if (isset($total_page_visitor))
            <div class="col-md-3 col-lg-3 col-sm-3">
                <div class="white-box single-summery active">
                    <div class="d-block mt-10">
                        <h3>{{ __('dashboard.total_visitor') }}</h3>
                        <h1 class="gradient-color2">{{ getNumberTranslate($total_page_visitor) }}</h1>
                    </div>
                </div>
            </div>
            @endif
            @if (isset($total_page_views))
            <div class="col-md-3 col-lg-3 col-sm-3">
                <div class="white-box single-summery active">
                    <div class="d-block mt-10">
                        <h3>{{ __('dashboard.total_page_views') }}</h3>
                        <h1 class="gradient-color2">{{ getNumberTranslate($total_page_views) }}</h1>
                    </div>
                </div>
            </div>
            @endif
            @if (isset($total_new_visitor))
            <div class="col-md-3 col-lg-3 col-sm-3">
                <div class="white-box single-summery active">
                    <div class="d-block mt-10">
                        <h3>{{ __('dashboard.new_visitors') }}</h3>
                        <h1 class="gradient-color2">{{ getNumberTranslate($total_new_visitor) }}</h1>
                    </div>
                </div>
            </div>
            @endif
            @if (isset($total_old_views))
            <div class="col-md-3 col-lg-3 col-sm-3">
                <div class="white-box single-summery active">
                    <div class="d-block mt-10">
                        <h3>{{ __('dashboard.old_visitors') }}</h3>
                        <h1 class="gradient-color2">{{ getNumberTranslate($total_old_views) }}</h1>
                    </div>
                </div>
            </div>
            @endif
            @if (isset($total_in_session))
            <div class="col-md-3 col-lg-3 col-sm-3">
                <div class="white-box single-summery active">
                    <div class="d-block mt-10">
                        <h3>{{ __('dashboard.total_in_sessions') }}</h3>
                        <h1 class="gradient-color2">{{getNumberTranslate( $total_in_session) }}</h1>
                    </div>
                </div>
            </div>
            @endif
        </div> -->
        @endif

        @endif

        
    </div>
    <input type="hidden" id="vendorCheck" value="{{isModuleActive('MultiVendor')?'true':'false'}}">
</section>
<input type="hidden" id="graph_total_product" value="{{ $graph_total_product }}">
<input type="hidden" id="graph_admin_product" value="{{ $graph_admin_product }}">
<input type="hidden" id="graph_seller_product" value="{{ $graph_seller_product }}">
<input type="hidden" id="graph_total_sales" value="{{ $graph_total_sales }}">
<input type="hidden" id="graph_completed_sales" value="{{ $graph_completed_sales }}">
<input type="hidden" id="graph_cancelled_sales" value="{{ $graph_cancelled_sales }}">
<input type="hidden" id="graph_total_sellers" value="{{ $graph_total_sellers }}">
<input type="hidden" id="graph_normal_sellers" value="{{ $graph_normal_sellers }}">
<input type="hidden" id="graph_trusted_sellers" value="{{ $graph_trusted_sellers }}">
<input type="hidden" id="graph_total_carts" value="{{ $total_product_in_cart }}">
<input type="hidden" id="graph_total_authorized_order" value="{{ $graph_total_authorized_order }}">
<input type="hidden" id="graph_total_guest_order" value="{{ $graph_total_guest_order }}">
<input type="hidden" id="graph_pending_sales_today" value="{{ $graph_pending_sales_today }}">
<input type="hidden" id="graph_sales_today" value="{{ $graph_sales_today }}">
<input type="hidden" id="graph_processing_sales_today" value="{{ $graph_processing_sales_today }}">
<input type="hidden" id="graph_completed_sales_today" value="{{ $graph_completed_sales_today }}">
@endsection
@push('scripts')
<script>
    (function($) {
          "use strict";
          $(document).on('click', '.filtering', function () {
              $('.filtering').removeClass('active');
              $(this).addClass('active');
              let type = $(this).data('type');
              $('.gradient-color2').hide();
              $('.demo_wait').removeClass('d-none');
              $.ajax({
                  method: "get",
                  url: "{{url('dashboard-cards-info')}}" + "/" + type,
                  success: function (data) {

                      $('.total_visitors').text(numbertrans(data.total_visitors));
                      $('.total_sale').text(numbertrans(data.total_sale));
                      $('.total_order').text(numbertrans(data.total_order));
                      $('.total_pending_order').text(numbertrans(data.total_pending_order));
                      $('.total_completed_order').text(numbertrans(data.total_completed_order));
                      $('.total_review').text(numbertrans(data.total_review));
                      $('.total_revenue').text(numbertrans(data.total_revenue));
                      $('.gradient-color2').show();
                      $('.demo_wait').addClass('d-none');
                  }
              })
          });
          $(function() {

            Chart.defaults.global.legend.labels.usePointStyle = true;
            if (document.getElementById('traffic-chartt') != null) {
                if($('#vendorCheck').val() == 'true'){
                    var dataType = [$('#graph_total_product').val(), $('#graph_admin_product').val(), $('#graph_seller_product').val()];
                }else{
                    var dataType = [$('#graph_total_product').val(), $('#graph_admin_product').val()];
                }
                var ctx = document.getElementById('traffic-chartt').getContext("2d");
                if ($("#traffic-chartt").length) {

                  var trafficChartData = {
                    datasets: [{
                      data: dataType,
                      backgroundColor: [
                        "#d5d1fc",
                        "#b044cf",
                        "#c7eaee"
                      ],
                      hoverBackgroundColor: [
                          "#d5d1fc",
                          "#b044cf",
                          "#c7eaee"
                      ],
                      borderColor: [
                        "transparent",
                        "transparent",
                        "transparent"
                      ],
                      legendColor: [
                        "#d5d1fc",
                        "#b044cf",
                        "#c7eaee"
                      ]
                    }],

                    // These labels appear in the legend and in the tooltips when hovering different arcs
                    labels: [
                      '{{__("common.published")}}',
                      '{{__("common.total")}}',
                      '{{__("common.seller")}}',
                    ]
                  };

                  var trafficChartOptions = {
                    responsive: true,
                    cutoutPercentage: 65,
                    animation: {
                      animateScale: true,
                      animateRotate: true
                    },
                    legend: false,
                    legendCallback: function(chart) {
                      var text = [];
                      text.push('<ul>');
                      for (var i = 0; i < trafficChartData.datasets[0].data.length; i++) {
                          text.push('<li><span class="legend-dots" style="background:' +
                          trafficChartData.datasets[0].legendColor[i] +
                                      '"></span><div class="legend_name"><span>');
                          if (trafficChartData.labels[i]) {
                              text.push(trafficChartData.labels[i]);
                          }
                          text.push('</span><span class="value_legend">'+numbertrans(trafficChartData.datasets[0].data[i])+'</span>')
                          text.push('</div></li>');
                      }
                      text.push('</ul>');
                      return text.join('');
                    }
                  };
                  var trafficChartCanvas = $("#traffic-chartt").get(0).getContext("2d");
                  var trafficChart = new Chart(trafficChartCanvas, {
                    type: 'doughnut',
                    data: trafficChartData,
                    options: trafficChartOptions
                  });
                  $("#traffic-chart-legendd").html(trafficChart.generateLegend());
                }
            }
            if (document.getElementById('traffic-chart2') != null) {
                Chart.defaults.global.legend.labels.usePointStyle = true;
                var ctx = document.getElementById('traffic-chart2').getContext("2d");
                if ($("#traffic-chart2").length) {

                  var trafficChartData = {
                    datasets: [{
                      data: [$('#graph_total_sales').val(), $('#graph_cancelled_sales').val(), $('#graph_completed_sales').val(), $('#graph_pending_sales_today').val()],
                      backgroundColor: [
                        "#d5d1fc",
                        "#000080",
                        "#c7eaee",
                        "#b044cf",
                      ],
                      hoverBackgroundColor: [
                        "#d5d1fc",
                        "#000080",
                        "#c7eaee",
                        "#b044cf",
                      ],
                      borderColor: [
                        "transparent",
                        "transparent",
                        "transparent",
                        "transparent",
                      ],
                      legendColor: [
                        "#d5d1fc",
                        "#000080",
                        "#c7eaee",
                        "#b044cf",
                      ]
                    }],

                    // These labels appear in the legend and in the tooltips when hovering different arcs
                    labels: [
                      '{{__("common.total")}}',
                      '{{__("common.completed")}}',
                      '{{__("defaultTheme.processing")}}',
                      '{{__("common.pending")}}',
                    ]
                  };

                  var trafficChartOptions = {
                    responsive: true,
                    cutoutPercentage: 65,
                    animation: {
                      animateScale: true,
                      animateRotate: true
                    },
                    legend: false,
                    legendCallback: function(chart) {
                      var text = [];
                      text.push('<ul>');
                      for (var i = 0; i < trafficChartData.datasets[0].data.length; i++) {
                          text.push('<li><span class="legend-dots" style="background:' +
                          trafficChartData.datasets[0].legendColor[i] +
                                      '"></span><div class="legend_name"><span>');
                          if (trafficChartData.labels[i]) {
                              text.push(trafficChartData.labels[i]);
                          }
                          text.push('</span><span class="value_legend">'+numbertrans(trafficChartData.datasets[0].data[i])+'</span>')
                          text.push('</div></li>');
                      }
                      text.push('</ul>');
                      return text.join('');
                    }
                  };
                  var trafficChartCanvas = $("#traffic-chart2").get(0).getContext("2d");
                  var trafficChart = new Chart(trafficChartCanvas, {
                    type: 'doughnut',
                    data: trafficChartData,
                    options: trafficChartOptions
                  });
                  $("#traffic-chart-legend2").html(trafficChart.generateLegend());
                }
            }
            if (document.getElementById('traffic-chart3') != null) {
                Chart.defaults.global.legend.labels.usePointStyle = true;
                var ctx = document.getElementById('traffic-chart3').getContext("2d");
                if ($("#traffic-chart3").length) {

                  var trafficChartData = {
                    datasets: [{
                      data: [$('#graph_total_sellers').val(), $('#graph_trusted_sellers').val(), $('#graph_normal_sellers').val()],
                      backgroundColor: [
                        "#d5d1fc",
                        "#b742d3",
                        "#c7eaee",
                      ],
                      hoverBackgroundColor: [
                        "#d5d1fc",
                        "#b742d3",
                        "#c7eaee",
                      ],
                      borderColor: [
                        "transparent",
                        "transparent",
                        "transparent",
                      ],
                      legendColor: [
                        "#d5d1fc",
                        "#b742d3",
                        "#c7eaee",
                      ]
                    }],

                    // These labels appear in the legend and in the tooltips when hovering different arcs
                    labels: [
                      '{{__("dashboard.total_seller")}}',
                      '{{__("common.trusted_seller")}}',
                      '{{__("seller.regular_seller")}}',
                    ]
                  };

                  var trafficChartOptions = {
                    responsive: true,
                    cutoutPercentage: 65,
                    animation: {
                      animateScale: true,
                      animateRotate: true
                    },
                    legend: false,
                    legendCallback: function(chart) {
                      var text = [];
                      text.push('<ul>');
                      for (var i = 0; i < trafficChartData.datasets[0].data.length; i++) {
                          text.push('<li><span class="legend-dots" style="background:' +
                          trafficChartData.datasets[0].legendColor[i] +
                                      '"></span><div class="legend_name"><span>');
                          if (trafficChartData.labels[i]) {
                              text.push(trafficChartData.labels[i]);
                          }
                          text.push('</span><span class="value_legend">'+numbertrans(trafficChartData.datasets[0].data[i])+'</span>')
                          text.push('</div></li>');
                      }
                      text.push('</ul>');
                      return text.join('');
                    }
                  };
                  var trafficChartCanvas = $("#traffic-chart3").get(0).getContext("2d");
                  var trafficChart = new Chart(trafficChartCanvas, {
                    type: 'doughnut',
                    data: trafficChartData,
                    options: trafficChartOptions
                  });
                  $("#traffic-chart-legend3").html(trafficChart.generateLegend());
                }
            }
            if (document.getElementById('traffic-chart4') != null) {
                Chart.defaults.global.legend.labels.usePointStyle = true;
                var ctx = document.getElementById('traffic-chart4').getContext("2d");
                if ($("#traffic-chart4").length) {

                  var trafficChartData = {
                    datasets: [{
                      data: [$('#graph_total_carts').val(), $('#graph_total_authorized_order').val(), $('#graph_total_guest_order').val()],
                      backgroundColor: [
                        "#d5d1fc",
                        "#b742d3",
                        "#c7eaee",
                      ],
                      hoverBackgroundColor: [
                        "#d5d1fc",
                        "#b742d3",
                        "#c7eaee",
                      ],
                      borderColor: [
                        "transparent",
                        "transparent",
                        "transparent",
                      ],
                      legendColor: [
                        "#d5d1fc",
                        "#b742d3",
                        "#c7eaee",
                      ]
                    }],

                    // These labels appear in the legend and in the tooltips when hovering different arcs
                    labels: [
                      '{{__("dashboard.in_carts")}}',
                      '{{__("common.registered")}}',
                      '{{__("common.guest")}}',
                    ]
                  };

                  var trafficChartOptions = {
                    responsive: true,
                    cutoutPercentage: 65,
                    animation: {
                      animateScale: true,
                      animateRotate: true
                    },
                    legend: false,
                    legendCallback: function(chart) {
                      var text = [];
                      text.push('<ul>');
                      for (var i = 0; i < trafficChartData.datasets[0].data.length; i++) {
                          text.push('<li><span class="legend-dots" style="background:' +
                          trafficChartData.datasets[0].legendColor[i] +
                                      '"></span><div class="legend_name"><span>');
                          if (trafficChartData.labels[i]) {
                              text.push(trafficChartData.labels[i]);
                          }
                          text.push('</span><span class="value_legend">'+numbertrans(trafficChartData.datasets[0].data[i])+'</span>')
                          text.push('</div></li>');
                      }
                      text.push('</ul>');
                      return text.join('');
                    }
                  };
                  var trafficChartCanvas = $("#traffic-chart4").get(0).getContext("2d");
                  var trafficChart = new Chart(trafficChartCanvas, {
                    type: 'doughnut',
                    data: trafficChartData,
                    options: trafficChartOptions
                  });
                  $("#traffic-chart-legend4").html(trafficChart.generateLegend());
                }
            }
            if (document.getElementById('traffic-chart5') != null) {
                Chart.defaults.global.legend.labels.usePointStyle = true;
                var ctx = document.getElementById('traffic-chart5').getContext("2d");
                if ($("#traffic-chart5").length) {

                  var trafficChartData = {
                    datasets: [{
                      data: [$('#graph_sales_today').val(), $('#graph_pending_sales_today').val(), $('#graph_processing_sales_today').val(), $('#graph_completed_sales_today').val()],
                      backgroundColor: [
                        "#d5d1fc",
                        "#000080",
                        "#c7eaee",
                        "#b044cf",
                      ],
                      hoverBackgroundColor: [
                        "#d5d1fc",
                        "#000080",
                        "#c7eaee",
                        "#b044cf",
                      ],
                      borderColor: [
                        "transparent",
                        "transparent",
                        "transparent",
                        "transparent",
                      ],
                      legendColor: [
                        "#d5d1fc",
                        "#000080",
                        "#c7eaee",
                        "#b044cf",
                      ]
                    }],

                    // These labels appear in the legend and in the tooltips when hovering different arcs
                    labels: [
                      '{{__("common.total")}}',
                      '{{__("common.pending")}}',
                      '{{__("defaultTheme.processing")}}',
                      '{{__("common.completed")}}',
                    ]
                  };

                  var trafficChartOptions = {
                    responsive: true,
                    cutoutPercentage: 65,
                    animation: {
                      animateScale: true,
                      animateRotate: true
                    },
                    legend: false,
                    legendCallback: function(chart) {
                      var text = [];
                      text.push('<ul>');
                      for (var i = 0; i < trafficChartData.datasets[0].data.length; i++) {
                          text.push('<li><span class="legend-dots" style="background:' +
                          trafficChartData.datasets[0].legendColor[i] +
                                      '"></span><div class="legend_name"><span>');
                          if (trafficChartData.labels[i]) {
                              text.push(trafficChartData.labels[i]);
                          }
                          text.push('</span><span class="value_legend">'+numbertrans(trafficChartData.datasets[0].data[i])+'</span>')
                          text.push('</div></li>');
                      }
                      text.push('</ul>');
                      return text.join('');
                    }
                  };
                  var trafficChartCanvas = $("#traffic-chart5").get(0).getContext("2d");
                  var trafficChart = new Chart(trafficChartCanvas, {
                    type: 'doughnut',
                    data: trafficChartData,
                    options: trafficChartOptions
                  });
                  $("#traffic-chart-legend5").html(trafficChart.generateLegend());
                }
            }
          });
        })(jQuery);

</script>
@endpush
