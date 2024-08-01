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
                <canvas id="myBarChart" width="400" height="200"></canvas>
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

});
  </script>
  
  