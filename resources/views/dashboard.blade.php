@extends('layout')

@section('content')

<div class="side-app">

    <!-- CONTAINER -->
    <div class="main-container container-fluid">

  <!-- PAGE-HEADER -->
  <div class="page-header">
    <h1 class="page-title">Dashboard</h1>
    <div>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">RTMS</a></li>
            <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
        </ol>
    </div>
</div>
<!-- PAGE-HEADER END -->

    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-12 col-xl-3">
            <div class="card overflow-hidden">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="mt-2">
                            <h6 class="">Total Sales</h6>
                            <h2 class="mb-0 number-font">{{$salesCount}}</h2>
                        </div>
                        <div class="ms-auto">
                            <div class="chart-wrapper mt-1">
                                <canvas id="saleschart"
                                    class="h-8 w-9 chart-dropshadow"></canvas>
                            </div>
                        </div>
                    </div>
                    <span class="text-muted fs-12"><span class="text-secondary"><i
                                class="fe fe-arrow-up-circle  text-secondary"></i> {{$salesCount}}</span>
                        Today</span>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12 col-xl-3">
            <div class="card overflow-hidden">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="mt-2">
                            <h6 class="">Total Visits</h6>
                            <h2 class="mb-0 number-font">{{$visitsNumberCount}}</h2>
                        </div>
                        <div class="ms-auto">
                            <div class="chart-wrapper mt-1">
                                <canvas id="leadschart"
                                    class="h-8 w-9 chart-dropshadow"></canvas>
                            </div>
                        </div>
                    </div>
                    <span class="text-muted fs-12"><span class="text-pink"><i
                                class="fe fe-arrow-up-circle text-pink"></i>{{$visitsNumberCount}}</span>
                        This Week</span>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12 col-xl-3">
            <div class="card overflow-hidden">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="mt-2">
                            <h6 class="">Total Outlets</h6>
                            <h2 class="mb-0 number-font">{{$outletsCount}}</h2>
                        </div>
                        <div class="ms-auto">
                            <div class="chart-wrapper mt-1">
                                <canvas id="profitchart"
                                    class="h-8 w-9 chart-dropshadow"></canvas>
                            </div>
                        </div>
                    </div>
                    <span class="text-muted fs-12"><span class="text-green"><i
                                class="fe fe-arrow-up-circle text-green"></i> {{$outletsCount}}</span>
                        Today</span>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12 col-xl-3">
            <div class="card overflow-hidden">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="mt-2">
                            <h6 class="">Total Products</h6>
                            <h2 class="mb-0 number-font">{{$productsNumberCount}}</h2>
                        </div>
                        <div class="ms-auto">
                            <div class="chart-wrapper mt-1">
                                <canvas id="costchart"
                                    class="h-8 w-9 chart-dropshadow"></canvas>
                            </div>
                        </div>
                    </div>
                    <span class="text-muted fs-12"><span class="text-warning"><i
                                class="fe fe-arrow-up-circle text-warning"></i>{{$productsNumberCount}}</span>
                        This Week</span>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-9">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Sales Analytics</h3>
                </div>
                <div class="card-body">
                    <div class="d-flex mx-auto text-center justify-content-center mb-4">
                        <div class="d-flex text-center justify-content-center me-3"><span
                                class="dot-label bg-primary my-auto"></span>Total Sales</div>
                        <!--<div class="d-flex text-center justify-content-center"><span
                                class="dot-label bg-secondary my-auto"></span>Total Orders</div>!-->
                    </div>
                    <div class="chartjs-wrapper-demo">
                        <canvas id="transactions" class="chart-dropshadow"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-3">
            <div class="card overflow-hidden">
                <div class="card-body pb-0 bg-recentorder">
                    <h3 class="card-title text-white">Recent Visits</h3>
                    <div class="chartjs-wrapper-demo">
                        <canvas id="recentorders" class="chart-dropshadow"></canvas>
                    </div>
                </div>
                <div id="flotback-chart" class="flot-background"></div>
                <div class="card-body">
                    <div class="d-flex mb-4 mt-3">
                        <div
                            class="avatar avatar-md bg-secondary-transparent text-secondary bradius me-3">
                            <i class="fe fe-check"></i>
                        </div>
                        <div class="">
                            <h6 class="mb-1 fw-semibold">Visits</h6>
                            <p class="fw-normal fs-12"> <span class="text-success">This Week</span>
                                (Last 7 days) </p>
                        </div>
                        <div class=" ms-auto my-auto">
                            <p class="fw-bold fs-20"> {{$visitsWeekCount}} </p>
                        </div>
                    </div>
                    <div class="d-flex">
                        <div class="avatar  avatar-md bg-pink-transparent text-pink bradius me-3">
                            <i class="fe fe-check"></i>
                        </div>
                        <div class="">
                            <h6 class="mb-1 fw-semibold">Sales</h6>
                            <p class="fw-normal fs-12"> <span class="text-danger">This Week</span>
                                (Last 7 days) </p>
                        </div>
                        <div class=" ms-auto my-auto">
                            <p class="fw-bold fs-20 mb-0">{{$salesWeekCount}} </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<div class="row">
    <div class="col-xl-6">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Recent Sales</h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table border text-nowrap text-md-nowrap table-striped mb-0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Product Name</th>
                                <th>SKU </th>
                                <th>Pieces</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(count($sales)>0)
                            @foreach($sales as $sale)
                            <tr>
                            <td>{{$sale['id']}}</td>
                            <td>{{$sale['product']['name']}}</td>
                            <td>{{$sale['product']['sku']}}</td>
                            <td>{{$sale['pieces']}}</td>
                            </tr>
                            @endforeach
                            @else
                            <!--let datatables display no data available-->
                            <tr>
                                <td colspan="4" style="text-align: center">No sales so far</td>
                            </tr>
                            @endif

                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-6">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Recent Outlets</h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table border text-nowrap text-md-nowrap table-striped mb-0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Contact Name</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            @if(count($outlets)>0)
                            @foreach($outlets as $outlet)
                            <tr>
                            <td>{{$outlet['id']}}</td>
                            <td>{{$outlet['name']}}</td>
                            <td>{{$outlet['contact_person_name']}}</td>
                            </tr>
                            @endforeach
                            @else
                            <!--let datatables display no data available-->
                            <tr>
                                <td colspan="4" style="text-align: center">No outlets so far</td>
                            </tr>
                            @endif
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    </div>

   

    <!-- ROW-3 -->
    <div class="row">
 
        <div class="col-xl-12 col-lg-12 col-md-12">
            <div class="card overflow-hidden">
                <div class="card-header">
                    <div>
                        <h3 class="card-title">Sales Report by Locations with Devices</h3>
                    </div>
                </div>
                <div class="card-body p-0 mt-2">
                    <div class="">
                        <div id="world-map-markers1" class="worldh world-map h-250"></div>
                    </div>
                    <div class="table-responsive mt-2 text-center">
                        <!--<table class="table text-nowrap border-dashed mb-0">
                            <thead>
                                <tr>
                                    <th class="text-start">Device</th>
                                    <th class="">USA</th>
                                    <th class="">India</th>
                                    <th class="">Bahrain</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="text-start p-4"><span
                                            class="sales-icon text-primary mx-2 brround bg-primary-transparent p-2"><svg
                                                xmlns="http://www.w3.org/2000/svg" width="18"
                                                height="18" fill="currentColor" class="bi
                bi-phone" viewBox="0 0 16 16">
                
                                                <path
                                                    d="M11 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h6zM5 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H5z" />
                                                <path d="M8 14a1 1 0 1 0 0-2 1 1 0 0 0 0 2z" />
                                            </svg></span><span class="mobile">Mobiles</span>
                                    </td>
                                    <td class="p-4">17%</td>
                                    <td class="p-4">22%</td>
                                    <td class="p-4">11%</td>
                                </tr>
                                <tr>
                                    <td class="text-start p-4"><span
                                            class="sales-icon text-secondary mx-2 brround bg-secondary-transparent p-2"><svg
                                                xmlns="http://www.w3.org/2000/svg" width="18"
                                                height="18" fill="currentColor
            " class="bi bi-display" viewBox="0 0 16 16">
                                                <path d="M0 4s0-2 2-2h12s2 0 2 2v6s0 2-2 2h-4c0 .667.083 1.167.25 1.5H11a.5.5 0 0 1 0 1H5a.5.5 0 0 1 0-1h.75c.167-.333.25-.833.25-1.5H2s-2 0-2-2V4zm1.398-.855a.758.758 0 0 0-.254.302A1.46 1.46
                0 0 0 1 4.01V10c0 .325.078.502.145.602.07.105.17.188.302.254a1.464 1.464 0 0 0 .538.143L2.01 11H14c.325 0 .502-.078.602-.145a.758.758 0 0 0 .254-.302 1.464 1.464 0 0 0 .143-.538L15 9.99V4c0-.325-.078-.502-.145-.602a.757.757
                0 0 0-.302-.254A1.46 1.46 0 0 0 13.99 3H2c-.325 0-.502.078-.602.145z" />
                                            </svg></span>Desktops</td>
                                    <td class="p-4">34%</td>
                                    <td class="p-4">76%</td>
                                    <td class="p-4">58%</td>
                                </tr>
                                <tr>
                                    <td class="text-start p-4"><span
                                            class="sales-icon text-danger mx-2 brround bg-danger-transparent p-2"><svg
                                                xmlns="http://www.w3.org/2000/svg" width="18"
                                                height="18" fill="currentColor" class="bi bi-tablet
            " viewBox="0 0 16 16">
                                                <path
                                                    d="M12 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h8zM4 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H4z" />
                                                <path d="M8 14a1 1 0 1 0 0-2 1 1 0 0 0 0 2z" />
                                            </svg></span>Tablets</td>
                                    <td class="p-4">56%</td>
                                    <td class="p-4">83%</td>
                                    <td class="p-4">66%</td>
                                </tr>
                            </tbody>
                        </table>-->
                        <!--end /table-->
                    </div>
                </div>
            </div>
        </div>
        <!--<div class="col-xl-6 col-lg-6 col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title fw-semibold">More Analytics</h4>
                </div>
                <div class="card-body">
                    <div class="browser-stats">
                        <div class="row mb-4">
                            <div class="col-sm-2 col-lg-3 col-xl-3 col-xxl-2 mb-sm-0 mb-3">
                                <img src="../assets/images/dashboard/document-icon.svg" class="img-fluid"
                                    alt="img">
                            </div>
                            <div class="col-sm-10 col-lg-9 col-xl-9 col-xxl-10 ps-sm-0">
                                <div class="d-flex align-items-end justify-content-between mb-1">
                                    <h6 class="mb-1">POS Audits</h6>
                                    <h6 class="fw-semibold mb-1">{{$posauditsCount}} <span
                                            class="text-success fs-11">(<i
                                                class="fe fe-arrow-up"></i>12.75%)</span></h6>
                                </div>
                                <div class="progress h-2 mb-3">
                                    <div class="progress-bar bg-primary" style="width: 70%;"
                                        role="progressbar"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-sm-2 col-lg-3 col-xl-3 col-xxl-2 mb-sm-0 mb-3">
                                <img src="../assets/images/dashboard/people-icon.svg" class="img-fluid"
                                    alt="img">
                            </div>
                            <div class="col-sm-10 col-lg-9 col-xl-9 col-xxl-10 ps-sm-0">
                                <div class="d-flex align-items-end justify-content-between mb-1">
                                    <h6 class="mb-1">Competitive Analysis</h6>
                                    <h6 class="fw-semibold mb-1">{{$competitorsCount}} <span
                                            class="text-danger fs-11">(<i
                                                class="fe fe-arrow-down"></i>15.12%)</span></h6>
                                </div>
                                <div class="progress h-2 mb-3">
                                    <div class="progress-bar bg-secondary" style="width: 40%;"
                                        role="progressbar"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-sm-2 col-lg-3 col-xl-3 col-xxl-2 mb-sm-0 mb-3">
                                <img src="../assets/images/dashboard/comment-icon.svg" class="img-fluid"
                                    alt="img">
                            </div>
                            <div class="col-sm-10 col-lg-9 col-xl-9 col-xxl-10 ps-sm-0">
                                <div class="d-flex align-items-end justify-content-between mb-1">
                                    <h6 class="mb-1">Feedback</h6>
                                    <h6 class="fw-semibold mb-1">{{$feedbackCount}} <span
                                            class="text-success fs-11">(<i
                                                class="fe fe-arrow-down"></i>24.37%)</span></h6>
                                </div>
                                <div class="progress h-2 mb-3">
                                    <div class="progress-bar bg-success" style="width: 50%;"
                                        role="progressbar"></div>
                                </div>
                            </div>
                        </div>
                      
                      
                        
                     
                    </div>
                </div>
            </div>
        </div>-->
    </div>
    <!-- ROW-3 END -->

    <?php
    $string ='[';
    
                foreach ($salesPerMonth as $sale){
                    //echo $sale;
                    if($string=='['){ $string =$string.=''.$sale.''; }
                    else{
                    $string =$string.=','.$sale.'';
                    }
                }
                
                $string=$string.']';

                for ($i = 0; $i <= 11; $i++) {
                $months[] = date("M", strtotime( date( 'Y-m-01' )." -$i months"));
                }
                //echo "Before";
                //print_r($months);
                //echo "After";
                $months=array_reverse($months);
                //print_r($months);
                $stringMonths ='[';
                foreach ($months as $month){
                    //echo $sale;
                    if($stringMonths=='['){ $stringMonths =$stringMonths.='"'.$month.'"'; }
                    else{
                        $stringMonths =$stringMonths.=',"'.$month.'"';
                    }
                    
                }
                $stringMonths=$stringMonths.']';
                //echo $stringMonths;
                
                //echo $string;
                //print_r($visitsCount);
                $stringVisits ='[';
   
                foreach ($visitsCount as $visit){
                    //echo $sale;
                    if($stringVisits=='['){ $stringVisits =$stringVisits.=''.$visit.''; }
                    else{
                    $stringVisits =$stringVisits.=','.$visit.'';
                }
                }
                
                $stringVisits=$stringVisits.']';
                //echo $stringVisits;
                ?>

    
<!-- INTERNAL CHARTJS CHART JS-->
<script src="{{asset('assets/plugins/chart/Chart.bundle.js')}}"></script>
<script src="{{asset('assets/plugins/chart/utils.js')}}"></script>
    
<script>
    // TRANSACTIONS

    var myCanvas = document.getElementById("transactions");
    myCanvas.height = "330";
    
    var myCanvasContext = myCanvas.getContext("2d");
    var gradientStroke1 = myCanvasContext.createLinearGradient(0, 80, 0, 280);
    gradientStroke1.addColorStop(0, 'rgba(232, 38, 70, 0.8)');
    //gradientStroke1.addColorStop(0, 'rgba(108, 95, 252, 0.8) ');
    //gradientStroke1.addColorStop(1, 'rgba(108, 95, 252, 0.2) ');
    gradientStroke1.addColorStop(1, 'rgba(232, 38, 70, 0.2) ');
    
    var gradientStroke2 = myCanvasContext.createLinearGradient(0, 80, 0, 280);
    gradientStroke2.addColorStop(0, 'rgba(5, 195, 251, 0.8)');
    gradientStroke2.addColorStop(1, 'rgba(5, 195, 251, 0.2) ');
    
    
    document.getElementById('transactions').innerHTML = '';
    var myChart;
    var dataSalesMonthGraph= @json($salesPerMonth);
    //alert(dataSalesMonthGraph);
    myChart = new Chart(myCanvas, {
    //#E82646 switched from #05c3fb
        type: 'line',
        data: {
            labels: <?php echo $stringMonths; ?>,
            type: 'line',
            datasets: [{
                label: 'Total Sales',
                data: dataSalesMonthGraph,
                backgroundColor: gradientStroke1,
                borderColor: "#E82646",
                pointBackgroundColor: '#fff',
                pointHoverBackgroundColor: gradientStroke1,
                pointBorderColor: "#E82646",
                pointHoverBorderColor: gradientStroke1,
                pointBorderWidth: 0,
                pointRadius: 0,
                pointHoverRadius: 0,
                borderWidth: 3,
                fill: 'origin',
                lineTension: 0.3
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false,
                    labels: {
                        usePointStyle: false,
                    }
                },
                tooltip: {
                    enabled: false
                }
            },
            scales: {
                x: {
                    display: true,
                    grid: {
                        display: false,
                        drawBorder: false,
                        color: 'rgba(119, 119, 142, 0.08)'
                    },
                    ticks: {
                        autoSkip: true,
                        color: '#b0bac9'
                    },
                    scaleLabel: {
                        display: false,
                        labelString: 'Month',
                        fontColor: 'transparent'
                    }
                },
                y: {
                    ticks: {
                        min: 0,
                        max: 1050,
                        stepSize: 150,
                        color: "#b0bac9",
                    },
                    display: true,
                    grid: {
                        display: true,
                        drawBorder: false,
                        zeroLineColor: 'rgba(142, 156, 173,0.1)',
                        color: "rgba(142, 156, 173,0.1)",
                    },
                    scaleLabel: {
                        display: false,
                        labelString: 'sales',
                        fontColor: 'transparent'
                    }
                }
            },
            title: {
                display: false,
                text: 'Normal Legend'
            }
        }
    });
    function index(myVarVal, myVarVal1) {
        'use strict'
        let gradientStroke = myCanvasContext.createLinearGradient(0, 80, 0, 280);;
        gradientStroke.addColorStop(0, `rgba(${myVarVal}, 0.8)` || 'rgba(232, 95, 252, 0.8)');
        gradientStroke.addColorStop(1, `rgba(${myVarVal}, 0.2)` || 'rgba(232, 95, 252, 0.2) ');
    
        // gradientStroke.addColorStop(0, `rgba(${myVarVal}, 0.8)` || 'rgba(108, 95, 252, 0.8)');
        // gradientStroke.addColorStop(1, `rgba(${myVarVal}, 0.2)` || 'rgba(108, 95, 252, 0.2) ');
    
        myChart.data.datasets[0] = {
            label: 'Total Sales',
            data: <?php echo $string; ?>,
            backgroundColor: gradientStroke,
            borderColor: `rgb(${myVarVal})`,
            pointBackgroundColor: '#fff',
            pointHoverBackgroundColor: gradientStroke,
            pointBorderColor: `rgb(${myVarVal})`,
            pointHoverBorderColor: gradientStroke,
            pointBorderWidth: 0,
            pointRadius: 0,
            pointHoverRadius: 0,
            borderWidth: 3,
            fill: 'origin',
            lineTension: 0.3
        }
        myChart.update();
    
    }


        // RECENT ORDERS OPEN
        var myCanvas = document.getElementById("recentorders");
        var dataVisits= @json($visitsCount);
        var dataSalesGraph= @json($salesGraphCount);
    myCanvas.height = "225";
    new Chart(myCanvas, {
        type: 'bar',
        data: {
            labels: ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"],
            datasets: [{
                barThickness: 8,
                label: 'This Month',
                data: dataVisits,
                backgroundColor: '#61c9fc',
                borderWidth: 2,
                hoverBackgroundColor: '#61c9fc',
                hoverBorderWidth: 0,
                borderColor: '#61c9fc',
                hoverBorderColor: '#61c9fc',
                borderRadius: 10,
            }, {
                barThickness: 8,
                label: 'This Month',
                data: dataSalesGraph,
                backgroundColor: '#f38ff3',
                borderWidth: 2,
                hoverBackgroundColor: '#f38ff3',
                hoverBorderWidth: 0,
                borderColor: '#f38ff3',
                hoverBorderColor: '#f38ff3',
                borderRadius: 10,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            layout: {
                padding: {
                    left: 0,
                    right: 0,
                    top: 0,
                    bottom: 0
                }
            },
            plugins: {
                legend: {
                    display: false,
                    labels: {
                        display: false
                    }
                },
                tooltip: {
                    enabled: false
                }
            },
            scales: {
                y: {
                    display: false,
                    grid: {
                        display: false,
                        drawBorder: false,
                        zeroLineColor: 'rgba(142, 156, 173,0.1)',
                        color: "rgba(142, 156, 173,0.1)",
                    },
                    scaleLabel: {
                        display: false,
                    },
                    ticks: {
                        beginAtZero: true,
                        stepSize: 25,
                        suggestedMin: 0,
                        suggestedMax: 100,
                        fontColor: "#8492a6",
                        userCallback: function (tick) {
                            return tick.toString() + '%';
                        }
                    },
                },
                x: {
                    display: false,
                    stacked: false,
                    ticks: {
                        beginAtZero: true,
                        fontColor: "#8492a6",
                    },
                    grid: {
                        color: "rgba(142, 156, 173,0.1)",
                        display: false
                    },

                }
            },
            legend: {
                display: false
            },
            elements: {
                point: {
                    radius: 0
                }
            }
        }
    });
    // RECENT ORDERS CLOSED


        // CHARTJS SALES CHART OPEN
        var ctx = document.getElementById('saleschart').getContext('2d');
        var dataSalesGraph= @json($salesGraphCount);
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
            datasets: [{
                barPercentage: 0.1,
                barThickness: 6,
                barGap: 0,
                maxBarThickness: 8,
                minBarLength: 2,
                label: 'Total Sales',
                data: dataSalesGraph,
                backgroundColor: [
                    'rgba(5, 195, 251, 0.2)',
                    'rgba(5, 195, 251, 0.2)',
                    '#05c3fb',
                    'rgba(5, 195, 251, 0.2)',
                    'rgba(5, 195, 251, 0.2)',
                    '#05c3fb',
                    '#05c3fb'
                ],
                borderColor: [
                    'rgba(5, 195, 251, 0.5)',
                    'rgba(5, 195, 251, 0.5)',
                    '#05c3fb',
                    'rgba(5, 195, 251, 0.5)',
                    'rgba(5, 195, 251, 0.5)',
                    '#05c3fb',
                    '#05c3fb'
                ],
                pointBorderWidth: 2,
                pointRadius: 2,
                pointHoverRadius: 2,
                borderRadius: 10,
                borderWidth: 1
            },]
        },
        options: {
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false,
                    labels: {
                        display: false
                    }
                },
                tooltip: {
                    enabled: false
                }
            },
            responsive: true,
            scales: {
                x: {
                    categoryPercentage: 1.0,
                    barPercentage: 1.0,
                    barDatasetSpacing: 0,
                    display: false,
                    barThickness: 5,
                    barRadius: 0,
                    gridLines: {
                        color: 'transparent',
                        zeroLineColor: 'transparent'
                    },
                    ticks: {
                        fontSize: 2,
                        fontColor: 'transparent'
                    }
                },
                y: {
                    display: false,
                    ticks: {
                        display: false,
                    }
                }
            },
            title: {
                display: false,
            },
            elements: {
                point: {
                    radius: 0
                }
            }
        }
    });

    // CHARTJS SALES CHART CLOSED

     // CHARTJS LEADS CHART  OPEN
     var ctx1 = document.getElementById('leadschart').getContext('2d');
     var dataVisits= @json($visitsCount);
    new Chart(ctx1, {
        type: 'line',
        data: {
            labels: ['Date 1', 'Date 2', 'Date 3', 'Date 4', 'Date 5', 'Date 6', 'Date 7' ],
            datasets: [{
                label: 'Total Sales',
                data: dataVisits,
                backgroundColor: 'transparent',
                borderColor: '#f46ef4',
                borderWidth: '2.5',
                pointBorderColor: 'transparent',
                pointBackgroundColor: 'transparent',
                lineTension: 0.3
            },]
        },
        options: {
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false,
                    labels: {
                        display: false
                    }
                },
                tooltip: {
                    enabled: false
                }
            },
            responsive: true,
            scales: {
                x: {
                    ticks: {
                        beginAtZero: true,
                        fontSize: 10,
                        fontColor: "transparent",
                    },
                    title: {
                        display: false,
                    },
                    grid: {
                        display: true,
                        color: 'transparent																																					',
                        drawBorder: false,
                    },
                    categoryPercentage: 1.0,
                    barPercentage: 1.0,
                    barDatasetSpacing: 0,
                    display: false,
                    barThickness: 5,
                },
                y: {
                    display: false,
                    ticks: {
                        display: false,
                    }
                }
            },
            title: {
                display: false,
            },
            elements: {
                point: {
                    radius: 0
                }
            }
        }
    });
    // CHARTJS LEADS CHART CLOSED

      // PROFIT CHART OPEN
      var ctx2 = document.getElementById('profitchart').getContext('2d');
      var dataGraphOutlets= @json($outletsGraphCount);
    new Chart(ctx2, {
        type: 'bar',
        data: {
            labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
            datasets: [{
                barPercentage: 0.1,
                barThickness: 6,
                maxBarThickness: 8,
                minBarLength: 2,
                label: 'Total Sales',
                barGap: 0,
                barSizeRatio: 1,
                data: dataGraphOutlets,
                backgroundColor: '#4ecc48',
                borderColor: '#4ecc48',
                pointBackgroundColor: '#fff',
                pointHoverBackgroundColor: '#4ecc48',
                pointBorderColor: '#4ecc48',
                pointHoverBorderColor: '#4ecc48',
                pointBorderWidth: 2,
                pointRadius: 2,
                pointHoverRadius: 2,
                borderRadius: 10,
                borderWidth: 1
            },]
        },
        options: {
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false,
                    labels: {
                        display: false
                    }
                },
                tooltip: {
                    enabled: false
                }
            },
            responsive: true,
            scales: {
                x: {
                    categoryPercentage: 1.0,
                    barPercentage: 1.0,
                    barDatasetSpacing: 0,
                    display: false,
                    barThickness: 5,
                    gridLines: {
                        color: 'transparent',
                        zeroLineColor: 'transparent'
                    },
                    ticks: {
                        fontSize: 2,
                        fontColor: 'transparent'
                    }
                },
                y: {
                    display: false,
                    ticks: {
                        display: false,
                    }
                }
            },
            title: {
                display: false,
            },
            elements: {
                point: {
                    radius: 0
                }
            }
        }
    });
    // PROFIT CHART CLOSED

    // COST CHART OPEN
    var ctx3 = document.getElementById('costchart').getContext('2d');
    var dataGraphProducts= @json($productsGraphCount);
    new Chart(ctx3, {
        type: 'line',
        data: {
            labels: ['Date 1', 'Date 2', 'Date 3', 'Date 4', 'Date 5', 'Date 6', 'Date 7'],
            datasets: [{
                label: 'Total Sales',
                data: dataGraphProducts,
                backgroundColor: 'transparent',
                borderColor: '#f7ba48',
                borderWidth: '2.5',
                pointBorderColor: 'transparent',
                pointBackgroundColor: 'transparent',
                lineTension: 0.3
            },]
        },
        options: {
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false,
                    labels: {
                        display: false
                    }
                },
                tooltip: {
                    enabled: false
                }
            },
            responsive: true,
            scales: {
                x: {
                    categoryPercentage: 1.0,
                    barPercentage: 1.0,
                    barDatasetSpacing: 0,
                    display: false,
                    barThickness: 5,
                    gridLines: {
                        color: 'transparent',
                        zeroLineColor: 'transparent'
                    },
                    ticks: {
                        fontSize: 2,
                        fontColor: 'transparent'
                    }
                },
                y: {
                    display: false,
                    ticks: {
                        display: false,
                    }
                }
            },
            title: {
                display: false,
            },
            elements: {
                point: {
                    radius: 0
                }
            }
        }
    });
    // COST CHART CLOSED
</script>

    @endsection