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
        <div class="row" style="margin: 0 10px;">
            <input type="hidden" id="tableLoaded" value="clockins"/>
            <h3 class="card-title" style="margin-top:20px;margin-block-end: 0rem;">Search by :</h3>
            <div class="col-md-3 mb-3">
                <label for="name" class="form-label">Seller Name</label>
                <input type="text" class="form-control" id="nameInput" placeholder="Name">
            </div>
            <div class="col-md-3 mb-3">
                <label for="dateFromInput" class="form-label">Date From</label>
                <input type="date" class="form-control" id="dateFromInput" placeholder="Min Date">
            </div>
            <div class="col-md-3 mb-3">
                <label for="dateToInput" class="form-label">Date To</label>
                <input type="date" class="form-control" id="dateToInput" placeholder="Max Date">
            </div>
            <div class="col-md-3 mb-3">
            <div class="row">
            <div class="col-md-6 ">
                <label for="timeFromInput" class="form-label">Time From</label>
                <input type="time" class="form-control" id="timeFromInput" placeholder="Min Date">
            </div>
            <div class="col-md-6 ">
                <label for="timeToInput" class="form-label">Time To</label>
                <input type="time" class="form-control" id="timeToInput" placeholder="Max Date">
            </div>
            </div>
            </div>
            {{-- <div class="col-md-3 mb-3">
                <label for="date" class="form-label">Date</label>
                <input type="date" class="form-control" id="dateInput" placeholder="Date">
            </div>
            <div class="col-md-3 mb-3">
                <label for="time" class="form-label">Clockin After</label>
                <input type="time" class="form-control" id="timeInput" placeholder="Time">
            </div> --}}
            {{-- <div class="col-md-3 mb-3">
                <label for="targets" class="form-label">Targets</label>
                <select class="form-select form-select select2" id="targetsInput">
                    <option value="None">None</option>
                    @foreach($targetgroups as $targetgroup)
                    <option value="{{number_format($targetgroup['amount'])}}">{{$targetgroup['name']." - KSh ".number_format($targetgroup['amount'])}}</option>
                    @endforeach
                </select>

            </div> --}}
            
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="responsive-datatable" class="table table-bordered text-nowrap border-bottom">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th id="view-column">View</th>
                            <th>Name</th>
                            <th>Team</th>
                            <th>Date</th>
                            <th>Time</th>
                            <th>Latitude</th>
                            <th>Longitude</th>
                            <th id="map-column">Map</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                            @if(count($clockins)>0)
                            @foreach($clockins as $clockin)
                            <tr>
                            <td>{{$clockin['id']}}</td>
                            <td><a type="button" href="/clockin/{{$clockin['id']}}" class="btn btn-info" style="margin-left: auto;color:white;">View</a>
                            </td>
                            <td>{{ $clockin['user'] ? $clockin['user']['name']  . ($clockin['user']->trashed() ? ' (Deleted User)' : '') : 'Deleted User'}}</td>
                            <td>{{$clockin['team']==null?"None":$clockin['team']['name']}}</td>
                            <td>{{date('d-M-Y', strtotime($clockin['created_at']))}}</td>
                            <td>{{date('H:i', strtotime($clockin['created_at']))}}</td>
                            <td>{{$clockin['lat']}}</td>
                            <td>{{$clockin['long']}}</td>
                            
                            {{-- <td>
                                <form method="POST" action="{{ route('editclockin') }}">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $clockin->id }}">
                                    <!-- Other form fields -->
                                    <button type="submit" class="btn btn-info">View</button>
                                </form>
                            </td> --}}
                            <td><a type="button"
                                onclick="loadPointOnMap({{ $clockin }})"
                                class="btn btn-success" style="margin-left: auto;color:white;" 
                                data-bs-toggle="modal" href="#largemodal">Map</a>
                          </td>
                            {{-- <td><a type="button" onclick="embedMap('{{$clockin['lat']}}','{{$clockin['long']}}')"
                                  class="btn btn-success" style="margin-left: auto;color:white;" data-bs-toggle="modal" href="#largemodal">Map</a>
                            </td> --}}
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
                        <div id="googleMapClockin" class="worldh world-map h-500" ></div>
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
    var map;
    var marker;
    
    function myMap2() {


        var mapProp= {
      center:new google.maps.LatLng(-1.3,
      36.8),
      zoom:10,
    };

    document.addEventListener("DOMContentLoaded", function() {
    
   var googleMapsDiv= document.getElementById("googleMapClockin");
    
    map = new google.maps.Map(googleMapsDiv,mapProp);

            
});


    }


    function loadPointOnMap(clockin){
        

        if(marker==undefined){
            // console.log(markers);
            // alert("undefined");
        }else{
                marker.setMap(null);

        }
        

        //waypoints.push({ location: { lat: -1.244, lng: 36.8 }, stopover: true });
        console.log('Map instance:', map);


        //should be google.maps.Marker.MAX_ZINDEX + 1 but we're using 
        //google.maps.Marker.MAX_ZINDEX + itemNumber to overlay multiple on the same for now

        var clockinPosition = { lat: parseFloat(clockin.lat), lng: parseFloat(clockin.long) };

            //alert('adding marker');
            marker = new google.maps.Marker({
                position: clockinPosition,
                map: map,
                title: clockin.user.name
            });

            map.setCenter(clockinPosition);
            map.setZoom(12);

            var date = new Date(clockin.created_at);
            var hours = date.getHours();
            var minutes = date.getMinutes();

            // Pad single digit minutes with a leading zero
            minutes = minutes < 10 ? '0' + minutes : minutes;

            var clockinTime = hours + ':' + minutes;

            //alert(clockinTime);

            var infoWindow = new google.maps.InfoWindow({
                content: `
                    <div>
                        <h3>${clockin.user.name}</h3>
                        <p><strong>Time:</strong> ${clockinTime}</p>
                        <p><strong>Latitude:</strong> ${clockin.lat}</p>
                        <p><strong>Longitude:</strong> ${clockin.long}</p>
                        View: <a target='_blank' href='/editclockin/${clockin.id}' >View Clockin Details</a>
                            
                        
                    </div>
                `
            });

            // Open the info window
            let isInfoWindowOpen = true;
            infoWindow.open(map,marker);

            //added the toggle functionality here because for this case the map opens up the infoview on load
            
            marker.addListener('click', function () {
                if (isInfoWindowOpen) {
                    infoWindow.close(); // Close the InfoWindow if it's open
                    isInfoWindowOpen = false; // Update the state
                } else {
                    infoWindow.open(map, marker); // Open the InfoWindow if it's closed
                    isInfoWindowOpen = true; // Update the state
                }
            });

            

    }
    

    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=
    AIzaSyALLsNWwOC09xsRAqrK0S7dINi6BpNc7iw&callback=myMap2"></script>



