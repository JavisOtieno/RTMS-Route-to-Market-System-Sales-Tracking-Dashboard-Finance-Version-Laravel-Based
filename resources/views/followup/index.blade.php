@extends('layout')

@section('content')

<div class="side-app">

    <!-- CONTAINER -->
    <div class="main-container container-fluid">

  <!-- PAGE-HEADER -->
  <div class="page-header">
    <h1 class="page-title">Follow ups</h1>
    <div>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">RTMS</a></li>
            <li class="breadcrumb-item active" aria-current="page">Follow ups</li>
        </ol>
    </div>
</div>
<!-- PAGE-HEADER END -->


<div class="col-xl-12">

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Follow ups</h3>
            {{-- <a type="button" href="/add-followup" class="btn btn-danger col-md-3" style="margin-left: auto;margin-right:20px;margin-top:10px;margin-bottom:10px;color:white;">Add Outlet</a> --}}
        </div>
        <div class="row" style="margin: 0 10px;">
            <input type="hidden" id="tableLoaded" value="followups"/>
            <h3 class="card-title" style="margin-top:20px;margin-block-end: 0rem;">Search by :</h3>
            <div class="col-md-2 mb-3">
                <label for="nameInput" class="form-label">Follow up Name</label>
                <input type="text" class="form-control" id="nameInput" placeholder="Follow up Name">
            </div>

            <div class="col-md-2 mb-3">
                <label for="sellerNameInput" class="form-label">Seller Name</label>
                <input type="text" class="form-control" id="sellerNameInput" placeholder="Seller Name">
            </div>
            
            <div class="col-md-2 mb-3">
                <label for="contactNameInput" class="form-label">Contact Name</label>
                <input type="text" class="form-control" id="contactNameInput" placeholder="Contact Name">
            </div>

            <div class="col-md-2 mb-3">
                <label for="date" class="form-label">From</label>
                <input type="date" class="form-control" id="dateFromInput" placeholder="Min Date">
            </div>

            <div class="col-md-2 mb-3">
                <label for="date" class="form-label">To</label>
                <input type="date" class="form-control" id="dateToInput" placeholder="Max Date">
            </div>
   
           
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="responsive-datatable" class="table table-bordered text-nowrap border-bottom">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>View/Edit</th>
                            <th>Delete</th>
                            <th>Type</th>
                            <th>Description</th>
                            <th>Scheduled Date</th>
                            <th>Scheduled Time</th>
                            <th>Team</th>
                            <th>Date</th>
                        
                            
                            {{-- <th id="delete-column">Delete</th> --}}
                        </tr>
                    </thead>
                    <tbody>
                        
                            @if(count($followups)>0)
                            @foreach($followups as $followup)
                            <tr>
                            <td>{{$followup['id']}}</td>
                            <td><a type="button" href="/editfollowup/{{$followup['id']}}" class="btn btn-info" style="margin-left: auto;color:white;">View/Edit</a>
                            </td>
                            <td><a type="button" onclick="deleteItemDefault({{$feed['id']}},'{{$feed['outlet']['name']}}','{{$feed['user']['name']}}','feedback')"  class="btn btn-danger" style="margin-left: auto;color:white;" data-bs-toggle="modal" href="#modalDelete">Delete</a>
                            <td>{{ucfirst($followup['type'])}}</td>
                            <td>{{$followup['description']}}</td>
                            <td>{{$followup['date']}}</td>
                            <td>{{$followup['time']}}</td>
                            <td>{{$followup['team']==null?"None":$followup['team']['name']}}</td>
                            <td>{{date('d-M-Y', strtotime($followup['created_at']))}}</td>

                            
                            {{-- <td>
                                <form method="POST" action="{{ route('editfollowup') }}">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $followup->id }}">
                                    <!-- Other form fields -->
                                    <button type="submit" class="btn btn-info">View/Edit</button>
                                </form>
                            </td> --}}
                            {{-- <td><a type="button"
                                onclick="loadPointOnMap({{ $followup }})"
                                class="btn btn-success" style="margin-left: auto;color:white;" 
                                data-bs-toggle="modal" href="#largemodal">Map</a>
                          </td> --}}
                            {{-- <td><a type="button" onclick="deleteItem({{$followup['id']}},'{{$followup['name']}}')"  class="btn btn-danger" style="margin-left: auto;color:white;" data-bs-toggle="modal" href="#modalDelete">Delete</a>
                            </td> --}}
                            
                            <!--<a class="modal-effect btn btn-primary-light d-grid mb-3" data-bs-effect="effect-scale" >Scale</a>-->
                            </tr>
                            @endforeach
                            @else
                                <!--let datatables display no data available-->
                            @endif
                        
                    </tbody>
                </table>
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
            {{-- <div class="modal fade" id="largemodal">
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
            </div> --}}
    

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
                                        <div id="googleMapOutlet" class="worldh world-map h-500" ></div>
                                        {{-- <iframe id="mapEmbededForNow" style="width:100%;height:400px;" src = "https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d4084493.7307095355!2d36.50569875426991!3d-1.3175850003645804!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2ske!4v1715327211380!5m2!1sen!2ske"></iframe> --}}
                                        <!--<div id="googleMap" style="width:100%;height:400px;"></div>-->
                                    </div>
                                    <div class="modal-footer">
                                        <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        {{-- <button class="btn btn-primary">Save changes</button> --}}
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
        confirmDeleteLink.href = "/deletefollowup/"+id;
    }
    function embedMap(lat,long){
        //alert(id);
        var mapEmbedFrame = document.getElementById("mapEmbededForNow");
        mapEmbedFrame.src = "https://maps.google.com/maps?q="+lat+","+long+"&hl=es;z=14&amp&output=embed";
        //var confirmDeleteLink = document.getElementById('confirmDelete'); //or grab it by tagname etc
        //confirmDeleteLink.href = "/deletesale/"+id;
    }
  </script>


<script>
    var map;
    var marker;
    
    function myMap2() {

        var mapProp= {
      center:new google.maps.LatLng(-1.3,
      36.8),
      zoom:10,
    };

    document.addEventListener("DOMContentLoaded", function() {
    
   var googleMapsDiv= document.getElementById("googleMapOutlet");
    
    map = new google.maps.Map(googleMapsDiv,mapProp);

            
});


    }




    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=
    AIzaSyALLsNWwOC09xsRAqrK0S7dINi6BpNc7iw&callback=myMap2"></script>