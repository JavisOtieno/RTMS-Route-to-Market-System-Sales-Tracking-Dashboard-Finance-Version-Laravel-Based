@extends('layout')

@section('content')

<div class="side-app">

    <!-- CONTAINER -->
    <div class="main-container container-fluid">

  <!-- PAGE-HEADER -->
  <div class="page-header">
    <h1 class="page-title">Clock Ins</h1>
    <div>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">RTMS</a></li>
            <li class="breadcrumb-item active" aria-current="page">Clock Ins</li>
        </ol>
    </div>
</div>
<!-- PAGE-HEADER END -->


<div class="col-xl-12">

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Clock Ins</h3>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="responsive-datatable" class="table table-bordered text-nowrap border-bottom">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Date</th>
                            <th>Time</th>
                            <th>Lat</th>
                            <th>Long</th>
                            <th>View</th>
                            <th>Map</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                            @if(count($clockins)>0)
                            @foreach($clockins as $clockin)
                            <tr>
                            <td>{{$clockin['id']}}</td>
                            <td>{{$clockin['user']['name']}}</td>
                            <td>{{date('Y-m-d', strtotime($clockin['created_at']))}}</td>
                            <td>{{date('H:i', strtotime($clockin['created_at']))}}</td>
                            <td>{{$clockin['lat']}}</td>
                            <td>{{$clockin['long']}}</td>
                            <td><a type="button" href="/clockin/{{$clockin['id']}}" class="btn btn-info" style="margin-left: auto;color:white;">View</a>
                            </td>
                            <td><a type="button" onclick="embedMap('{{$clockin['lat']}}','{{$clockin['long']}}')"
                                  class="btn btn-danger" style="margin-left: auto;color:white;" data-bs-toggle="modal" href="#largemodal">Map</a>
                            </td>
                            <!--<a class="modal-effect btn btn-primary-light d-grid mb-3" data-bs-effect="effect-scale" >Scale</a>-->
                            </tr>
                            
                            @endforeach
                            @else
                            <!--let datatables display no data available-->
                            @endif

                            <!--let datatables display no data available-->
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

    </div>
</div>

    <!-- MODAL EFFECTS -->
    <div class="modal fade" id="modalMap">
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
                        <iframe id="mapEmbededForNow" style="width:100%;height:400px;" src = "https://maps.google.com/maps?q=10.305385,77.923029&hl=es;z=14&amp;output=embed"></iframe>
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
    function embedMap(lat,long){
        //alert(id);
        var mapEmbedFrame = document.getElementById("mapEmbededForNow");
        mapEmbedFrame.src = "https://maps.google.com/maps?q="+lat+","+long+"&hl=es;z=14&amp&output=embed";
        //var confirmDeleteLink = document.getElementById('confirmDelete'); //or grab it by tagname etc
        //confirmDeleteLink.href = "/deletesale/"+id;
    }
  </script>



