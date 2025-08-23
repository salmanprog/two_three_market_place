@extends('backEnd.master')
@section('styles')

<link rel="stylesheet" href="{{asset(asset_path('modules/multivendor/css/style.css'))}}" />
@endsection
@section('mainContent')

<section class="mb-40">
    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-12 mb_10">
                <div class="main-title d-flex">
                    <h3 class="mb-0 mr-3 text-nowrap">{{ __('common.summary') }}</h3>
                    
                </div>
            </div>
            <div class="col-lg-8 col-md-8 col-sm-12">
                <div class="float-md-right float-none pos_tab_btn justify-content-end">
                    <ul class="nav">
                        <li class="nav-item mb_5">
                            <a class="nav-link filtering active" data-type="today"
                                href="javascript:void(0)">{{ __('dashboard.today') }}</a>
                        </li>
                        <li class="nav-item mb_5">
                            <a class="nav-link filtering" data-type="week"
                                href="javascript:void(0)">{{ __('dashboard.this_week') }}</a>
                        </li>
                        <li class="nav-item mb_5">
                            <a class="nav-link filtering" data-type="month"
                                href="javascript:void(0)">{{ __('dashboard.this_month') }}</a>
                        </li>
                        <li class="nav-item mb_5">
                            <a class="nav-link filtering" data-type="year"
                                href="javascript:void(0)">{{ __('dashboard.this_year') }}</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row mb_30">
             <div class="col-xl-3 col-lg-4 col-md-4 col-sm-6">
                <div
                    class="white-box single-summery active bg_active">                    
                        <div class="d-block mt-10">
                            <h3>{{ __('Total Events') }} </h3>
                            <img class="demo_wait d-none" height="60px"
                                src="{{showImage('backend/img/loader.gif')}}" alt="">
                            <h1 class="gradient-color2 total_products">{{ getNumberTranslate($total_event) }}</h1>
                        </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-4 col-md-4 col-sm-6">
                <div
                    class="white-box single-summery active bg_active">                    
                        <div class="d-block mt-10">
                            <h3>{{ __('Active Events') }} </h3>
                            <img class="demo_wait d-none" height="60px"
                                src="{{showImage('backend/img/loader.gif')}}" alt="">
                            <h1 class="gradient-color2 total_products">{{ getNumberTranslate($total_activeevent) }}</h1>
                        </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-4 col-md-4 col-sm-6">
                <div
                    class="white-box single-summery active bg_active">                   
                        <div class="d-block mt-10">
                            <h3>{{ __('Expire Events') }} </h3>
                            <img class="demo_wait d-none" height="60px"
                                src="{{showImage('backend/img/loader.gif')}}" alt="">
                            <h1 class="gradient-color2 total_products">{{ getNumberTranslate($total_expireevent) }}</h1>
                        </div>
                </div>
            </div>
        </div>
</section>
@endsection
@push('scripts')
<script type="text/javascript">
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
                  url: "{{url('seller/seller-dashboard-cards-info')}}" + "/" + type,
                  success: function (data) {
                      $('.total_sale').text(data.total_sale);
                      $('.total_orders').text(data.total_orders);
                      $('.total_delivered_order').text(data.total_delivered_orders);
                      $('.total_not_delivered_orders').text(data.total_not_delivered_orders);
                      $('.shop_review').text(data.shop_review);
                      $('.total_refund').text(data.total_refund);
                      $('.total_commision').text(data.total_commision);
                      $('.gradient-color2').show();
                      $('.demo_wait').addClass('d-none');
                  }
              })
          });
          $(function() {
            Chart.defaults.global.legend.labels.usePointStyle = true;
            if (document.getElementById('traffic-chart_a') != null) {
                var ctx = document.getElementById('traffic-chart_a').getContext("2d");
                if ($("#traffic-chart_a").length) {

                  var trafficChartData = {
                    datasets: [{
                      data: [$('#graph_total_orders').val(), $('#graph_total_delivered_orders').val(), $('#graph_total_not_delivered_orders').val()],
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
                      'Total',
                      'Delivered',
                      'Not Delivered',
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
                          text.push('</span><span class="value_legend">'+trafficChartData.datasets[0].data[i]+'</span>')
                          text.push('</div></li>');
                      }
                      text.push('</ul>');
                      return text.join('');
                    }
                  };
                  var trafficChartCanvas = $("#traffic-chart_a").get(0).getContext("2d");
                  var trafficChart = new Chart(trafficChartCanvas, {
                    type: 'doughnut',
                    data: trafficChartData,
                    options: trafficChartOptions
                  });
                  $("#traffic-chart-legend_a").html(trafficChart.generateLegend());
                }
            }
            if (document.getElementById('traffic-chart2') != null) {
                Chart.defaults.global.legend.labels.usePointStyle = true;
                var ctx = document.getElementById('traffic-chart2').getContext("2d");
                if ($("#traffic-chart2").length) {

                  var trafficChartData = {
                    datasets: [{
                      data: [$('#graph_total_net_sale').val(), $('#graph_total_tax').val(), $('#graph_total_shipping').val()],
                      backgroundColor: [
                        "#d5d1fc",
                        "#c7eaee",
                        "#b044cf",
                      ],
                      hoverBackgroundColor: [
                        "#d5d1fc",
                        "#c7eaee",
                        "#b044cf",
                      ],
                      borderColor: [
                        "transparent",
                        "transparent",
                        "transparent",
                      ],
                      legendColor: [
                        "#d5d1fc",
                        "#c7eaee",
                        "#b044cf",
                      ]
                    }],

                    // These labels appear in the legend and in the tooltips when hovering different arcs
                    labels: [
                      'Net Sale',
                      'Tax',
                      'Shipping',
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
                          text.push('</span><span class="value_legend">'+"{{getCurrency()}} "+trafficChartData.datasets[0].data[i]+'</span>')
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
                      data: [$('#graph_total_sale').val(), $('#graph_total_refund').val()],
                      backgroundColor: [
                        "#d5d1fc",
                        "#c7eaee",
                      ],
                      hoverBackgroundColor: [
                        "#d5d1fc",
                        "#c7eaee",
                      ],
                      borderColor: [
                        "transparent",
                        "transparent",
                      ],
                      legendColor: [
                        "#d5d1fc",
                        "#c7eaee",
                      ]
                    }],

                    // These labels appear in the legend and in the tooltips when hovering different arcs
                    labels: [
                      'Sale Amount',
                      'Refund Amount',
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
                          text.push('</span><span class="value_legend">'+"{{getCurrency()}} "+trafficChartData.datasets[0].data[i]+'</span>')
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
          });
        })(jQuery);

</script>
@endpush
