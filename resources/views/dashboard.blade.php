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
                                <!--<canvas id="saleschart"
                                    class="h-8 w-9 chart-dropshadow"></canvas>-->
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
                            <h6 class="">Total Outlets</h6>
                            <h2 class="mb-0 number-font">{{$outletsCount}}</h2>
                        </div>
                        <div class="ms-auto">
                            <div class="chart-wrapper mt-1">
                                <!--<canvas id="leadschart"
                                    class="h-8 w-9 chart-dropshadow"></canvas>-->
                            </div>
                        </div>
                    </div>
                    <span class="text-muted fs-12"><span class="text-pink"><i
                                class="fe fe-arrow-up-circle text-pink"></i>{{$outletsCount}}</span>
                        This Week</span>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12 col-xl-3">
            <div class="card overflow-hidden">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="mt-2">
                            <h6 class="">POS Audits</h6>
                            <h2 class="mb-0 number-font">{{$posauditsCount}}</h2>
                        </div>
                        <div class="ms-auto">
                            <div class="chart-wrapper mt-1">
                                <!--<canvas id="profitchart"
                                    class="h-8 w-9 chart-dropshadow"></canvas>-->
                            </div>
                        </div>
                    </div>
                    <span class="text-muted fs-12"><span class="text-green"><i
                                class="fe fe-arrow-up-circle text-green"></i> {{$posauditsCount}}</span>
                        Today</span>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12 col-xl-3">
            <div class="card overflow-hidden">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="mt-2">
                            <h6 class="">Feedback</h6>
                            <h2 class="mb-0 number-font">{{$competitorsCount}}</h2>
                        </div>
                        <div class="ms-auto">
                            <div class="chart-wrapper mt-1">
                                <!--<canvas id="costchart"
                                    class="h-8 w-9 chart-dropshadow"></canvas>-->
                            </div>
                        </div>
                    </div>
                    <span class="text-muted fs-12"><span class="text-warning"><i
                                class="fe fe-arrow-up-circle text-warning"></i>{{$competitorsCount}}</span>
                        This Week</span>
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
                            @foreach($sales as $sale)
                            <tr>
                            <td>{{$sale['id']}}</td>
                            <td>{{$sale['product']['name']}}</td>
                            <td>{{$sale['product']['sku']}}</td>
                            <td>{{$sale['pieces']}}</td>
                            </tr>
                            @endforeach
                            
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
                            @foreach($outlets as $outlet)
                            <tr>
                            <td>{{$outlet['id']}}</td>
                            <td>{{$outlet['name']}}</td>
                            <td>{{$outlet['contact_person_name']}}</td>
                            
                            </tr>
                            @endforeach
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    </div>


    @endsection