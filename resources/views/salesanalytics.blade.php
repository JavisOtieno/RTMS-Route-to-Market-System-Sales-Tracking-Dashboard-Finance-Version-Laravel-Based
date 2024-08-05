@extends('layout-form')

@section('content')

<div class="side-app">

    <!-- CONTAINER -->
    <div class="main-container container-fluid">

  <!-- PAGE-HEADER -->
  <div class="page-header">
    <h1 class="page-title">Sales Analytics</h1>
    <div>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">RTMS</a></li>
            <li class="breadcrumb-item active" aria-current="page">Sales Analytics</li>
        </ol>
    </div>
</div>
<!-- PAGE-HEADER END -->


<div class="col-xl-12">

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Sales Analytics</h3>
            {{-- <a type="button" href="/add-visit" class="btn btn-danger col-md-3" style="margin-left: auto;margin-right:20px;margin-top:10px;margin-bottom:10px;color:white;">Add Outlet</a> --}}
        </div>
        <div class="row" style="margin: 20px;">
            <div class="col-lg-6 col-md-6 col-sm-12 col-xl-3">
                <div class="card overflow-hidden" style="background-color: #fce9ec">
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="mt-2">
                                <h6 class="">Total Sales</h6>
                                <h2 class="mb-0 number-font">
                                    {{$salesCount}}
                                </h2>
                            </div>
                            <div class="ms-auto">
                                <div class="chart-wrapper mt-1">
                                    <canvas id="saleschart"
                                        class="h-8 w-9 chart-dropshadow"></canvas>
                                </div>
                            </div>
                        </div>
                        {{-- <span class="text-muted fs-12"><span class="text-secondary"><i
                                    class="fe fe-arrow-up-circle  text-secondary"></i> 
                                //  {{$salesWeekCount}}
                                    10
                                </span>
                            This week</span> --}}
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 col-xl-3" >
                <div class="card overflow-hidden" style="background-color: #fce9ec">
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="mt-2">
                                <h6 class="">Sales This Month</h6>
                                <h2 class="mb-0 number-font">
                                    {{$salesThisMonth}}
                                </h2>
                            </div>
                            <div class="ms-auto">
                                <div class="chart-wrapper mt-1">
                                    <canvas id="leadschart"
                                        class="h-8 w-9 chart-dropshadow"></canvas>
                                </div>
                            </div>
                        </div>
                        {{-- <span class="text-muted fs-12"><span class="text-blue"><i
                                    class="fe fe-arrow-up-circle text-blue"></i>
                                    // {{$visitsWeekCount}} 
                                    10
                                </span>
                            This Week</span> --}}
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 col-xl-3">
                <div class="card overflow-hidden" style="background-color: #fce9ec">
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="mt-2">
                                <h6 class="">Sales This Week</h6>
                                <h2 class="mb-0 number-font">
                                    {{$salesThisWeek}}
                                </h2>
                            </div>
                            <div class="ms-auto">
                                <div class="chart-wrapper mt-1">
                                    <canvas id="profitchart"
                                        class="h-8 w-9 chart-dropshadow"></canvas>
                                </div>
                            </div>
                        </div>
                        {{-- <span class="text-muted fs-12"><span class="text-green"><i
                                    class="fe fe-arrow-up-circle text-green"></i> 
                                    // {{$outletsWeekCount}} 
                                    10
                                </span>
                            This week</span> --}}
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 col-xl-3">
                <div class="card overflow-hidden" style="background-color: #fce9ec">
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="mt-2">
                                <h6 class="">Sales Today</h6>
                                <h2 class="mb-0 number-font">
                                    {{$salesToday}}
                                
                                </h2>
                            </div>
                            <div class="ms-auto">
                                <div class="chart-wrapper mt-1">
                                    <canvas id="costchart"
                                        class="h-8 w-9 chart-dropshadow"></canvas>
                                </div>
                            </div>
                        </div>
                        {{-- <span class="text-muted fs-12"><span class="text-blue"><i
                                    class="fe fe-arrow-up-circle text-blue"></i>
                                     // {{$productsWeekCount}} 
                                    10
                                </span>
                            This Week</span> --}}
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <h3>Sales Over The Last 12 Months </h3>
                <canvas id="myBarChart" width="400" height="200"></canvas>
            </div>
            <div class="table-responsive mt-4">
                <h3>Sales Over The Last 7 Days</h3>
                <canvas id="myLineChart" width="400" height="200"></canvas>
            </div>
            <div class="row">
            <div class="table-responsive col-md-4 mt-6">
                <h3>Sellers By Region</h3>
            <canvas id="salesPieChart" width="180" height="180"></canvas>
            </div>
            <div class="table-responsive col-md-8 mt-6">
            <div class="card">
                {{-- <div class="card-header">
                    <h3 class="card-title">Top Sellers</h3>
                </div> --}}
                <h3>Top Sellers</h3>
                <div class="card-body">
                    <div class="chart-container">
                        <canvas id="chartBar1" class="h-275"></canvas>
                    </div>
                </div>
            </div>
            </div>
            
            

            </div>
            
        </div>
    </div>
</div>

    </div>
</div>

    <!-- MODAL EFFECTS -->
    <div class="modal fade" id="modalDelete">
        <div class="modal-dialog modal-dialog-centered text-center" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title">Delete</h6><button aria-label="Close" class="btn-close" data-bs-dismiss="modal"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <h6>Are you sure you want to delete?</h6>
                    <strong id="itemDetails">Details</strong>
                </div>
                <div class="modal-footer">
                    <a id="confirmDelete" class="btn btn-danger" style="color: white">Delete</a> <button class="btn btn-light" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

            <!-- Modal -->
            <div class="modal fade" id="largemodal">
                <div class="modal-dialog modal-lg " role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Map</h5>
                            <button class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                        </div>
                        <div class="modal-body">
                            <iframe id="mapEmbededForNow" style="width:100%;height:400px;" src = "https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d4084493.7307095355!2d36.50569875426991!3d-1.3175850003645804!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2ske!4v1715327211380!5m2!1sen!2ske"></iframe>
                            <!--<div id="googleMap" style="width:100%;height:400px;"></div>-->
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button class="btn btn-primary">Save changes</button>
                        </div>
                    </div>
                    
                </div>
            </div>
    

@endsection

<script>
    function deleteItem(id,name,sku,pieces){
        //alert(id);
        var itemDetails = document.getElementById("itemDetails");
        itemDetails.innerHTML = "Outlet Id: "+id+"<br/> Outlet Name: "+name;
        var confirmDeleteLink = document.getElementById('confirmDelete'); //or grab it by tagname etc
        confirmDeleteLink.href = "/deleteoutlet/"+id;
    }
    function embedMap(lat,long){
        //alert(id);
        var mapEmbedFrame = document.getElementById("mapEmbededForNow");
        mapEmbedFrame.src = "https://maps.google.com/maps?q="+lat+","+long+"&hl=es;z=14&amp&output=embed";
        //var confirmDeleteLink = document.getElementById('confirmDelete'); //or grab it by tagname etc
        //confirmDeleteLink.href = "/deletesale/"+id;
    }
  </script>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


{{-- <script>
    document.addEventListener("DOMContentLoaded", function() {
    // Get the canvas element
    var ctx = document.getElementById('myBarChart').getContext('2d');
  
    // Create the bar chart
    var myBarChart = new Chart(ctx, {
      type: 'bar',
      data: {
        labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'], // X-axis labels
        datasets: [{
          label: 'My First Dataset',
          data: [12, 19, 3, 5, 2, 3, 7], // Y-axis data
          backgroundColor: 'rgba(75, 192, 192, 0.2)', // Bar color
          borderColor: 'rgba(75, 192, 192, 1)', // Border color
          borderWidth: 1
        }]
      },
      options: {
        scales: {
          y: {
            beginAtZero: true
          }
        }
      }
    });

});
  </script> --}}

<script>
        document.addEventListener("DOMContentLoaded", function() {
    // Get the canvas element
    var ctx = document.getElementById('myBarChart').getContext('2d');

    var dataSalesMonthGraph= @json($salesPerMonth);
    var dataMonthLabels= @json($months);
  
    // Create the bar chart
    var myBarChart = new Chart(ctx, {
      type: 'bar',
      data: {
        labels: dataMonthLabels, // X-axis labels
        datasets: [{
          label: 'Sales Last 12 Months',
          data: dataSalesMonthGraph, // Y-axis data
          backgroundColor: 'rgba(255, 99, 132, 0.2)', // Bar color (light red)
          borderColor: 'rgba(255, 99, 132, 1)', // Border color (red)
          borderWidth: 1
        }]
      },
      options: {
        scales: {
          y: {
            beginAtZero: true
          }
        }
      }
    });

    
        // Line Chart
        var ctxLine = document.getElementById('myLineChart').getContext('2d');
        var dataSalesDayGraph = @json($salesPerDay);
        var dataDayLabels = @json($dates);
        // var dataVisitsDayGraph = [5, 10, 15, 20, 25, 30, 35, 40, 45, 50, 55, 60, 65, 70, 75, 
        // 80, 85, 90, 95, 100, 105, 110, 115, 120, 125, 130, 135, 140, 145, 150]; // Placeholder data
        // var dataDayLabels = ['Day 1', 'Day 2', 'Day 3', 'Day 4', 'Day 5', 'Day 6', 'Day 7', 'Day 8', 'Day 9', 
        // 'Day 10', 'Day 11', 'Day 12', 'Day 13', 'Day 14', 'Day 15', 'Day 16', 'Day 17', 'Day 18', 'Day 19', 'Day 20', 
        // 'Day 21', 'Day 22', 'Day 23', 'Day 24', 'Day 25', 'Day 26', 'Day 27', 'Day 28', 'Day 29', 'Day 30']; // Placeholder labels


        var myLineChart = new Chart(ctxLine, {
            type: 'line',
            data: {
                labels: dataDayLabels, // X-axis labels
                datasets: [{
                    label: 'Sales Last 7 Days',
                    data: dataSalesDayGraph, // Y-axis data
                    backgroundColor: 'rgba(54, 162, 235, 0.2)', // Line color (light blue)
                    borderColor: 'rgba(54, 162, 235, 1)', // Border color (blue)
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });


        var regionCountGraph = @json($sellersByRegionCount);
        var regionNamesLabels = @json($sellersByRegionNames);

        function generateColors(numColors) {
            const colors = [];
            const step = 360 / numColors;
            for (let i = 0; i < numColors; i++) {
                const hue = step * i;
                const color = `hsl(${hue}, 70%, 70%)`;
                colors.push(color);
            }
            return colors;
        }
        
        // Data for the pie chart
        const data = {
            labels: regionNamesLabels,
            datasets: [{
                data: regionCountGraph, // Example data
                backgroundColor: generateColors(regionCountGraph.length),
                hoverOffset: 4
            }]
        };

        // Config for the pie chart
        const config = {
            type: 'pie',
            data: data,
            options: {
                responsive: true,
                pluginss: {
                    legend: {
                        display: true, // Shows the legend
                        position: 'top', // Position of the legend
                        labels: {
                            color: 'rgb(255, 99, 132)', // Text color
                            font: {
                                size: 14 // Font size
                            }
                        }
                    },
                    
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                let label = context.label || '';

                                if (context.parsed !== null) {
                                    label += ': ' + context.parsed + ' sellers'; // Customize the label
                                }

                                return label;
                            }
                        }
                    }
                }
            }
        };

        // Create the pie chart
        const ctxPie = document.getElementById('salesPieChart').getContext('2d');
        new Chart(ctxPie, config);


        
        var ctxTopSellers = document.getElementById("chartBar1").getContext('2d');
        var topSellerUserNames= @json($topSellerUserNames);
        var topSellerSalesCount= @json($topSellerSalesCount);

       // alert($topSellerUserNames);
        
    var myChart = new Chart(ctxTopSellers, {
        type: 'bar',
        data: {
            labels: topSellerUserNames,
            datasets: [{
                label: 'Sales',
                data: topSellerSalesCount,
                borderWidth: 2,
                backgroundColor: '#E04D53',
                borderColor: '#E04D53',
                borderWidth: 2.0,
                pointBackgroundColor: '#ffffff',

            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            legend: {
                display: true
            },
            scales: {
                y: {
                    ticks: {
                        beginAtZero: true,
                        stepSize: 150,
                        color: "#9ba6b5",
                    },
                    grid: {
                        color: 'rgba(119, 119, 142, 0.2)'
                    }
                },
                x: {
                    barPercentage: 0.4,
                    barValueSpacing: 0,
                    barDatasetSpacing: 0,
                    barRadius: 0,
                    ticks: {
                        display: true,
                        color: "#9ba6b5",
                    },
                    grid: {
                        display: false,
                        color: 'rgba(119, 119, 142, 0.2)'
                    }
                }
            },
            legend: {
                labels: {
                    fontColor: "#9ba6b5"
                },
            },
        }
    });

});




  </script>
  
  