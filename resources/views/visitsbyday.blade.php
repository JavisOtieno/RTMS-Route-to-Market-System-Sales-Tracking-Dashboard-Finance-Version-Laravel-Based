@extends('layout')

@section('content')

<div class="side-app">

    <!-- CONTAINER -->
    <div class="main-container container-fluid">

  <!-- PAGE-HEADER -->
  <div class="page-header">
    <h1 class="page-title">Visits by Day</h1>
    <div>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">RTMS</a></li>
            <li class="breadcrumb-item active" aria-current="page">Visits by Day</li>
        </ol>
    </div>
</div>
<!-- PAGE-HEADER END -->


<div class="col-xl-12">

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Visits by Day</h3>
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
                            <th>Name</th>
                            <th>Date</th>
                            <th>Time</th>
                            <th id="view-column">View</th>
                            <th id="map-column">Map</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                            @if(count($clockins)>0)
                            @foreach($clockins as $clockin)
                            <tr>
                            <td>{{$clockin['id']}}</td>
                            <td>{{$clockin['user'] ? $clockin['user']['name']  . ($clockin['user']->trashed() ? ' (Deleted User)' : '') : 'Deleted User'}}</td>
                            <td>{{date('d-M-Y', strtotime($clockin['created_at']))}}</td>
                            <td>{{date('H:i', strtotime($clockin['created_at']))}}</td>
                            <td><a type="button" href="visitsbyday/{{$clockin['id']}}" class="btn btn-info"
                                 style="margin-left: auto;color:white;"
                                 
                                 >View</a>
                            </td>
                            {{-- <td>
                                <form method="POST" action="{{ route('editclockin') }}">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $clockin->id }}">
                                    <!-- Other form fields -->
                                    <button type="submit" class="btn btn-info">View</button>
                                </form>
                            </td> --}}
                            <td><a type="button" 
                                {{-- onclick="embedMap('{{$clockin['lat']}}','{{$clockin['long']}}')" --}}
                                onclick="rewriteMap({{ $clockin }})"
                                  class="btn btn-success" style="margin-left: auto;color:white;" data-bs-toggle="modal"
                                   href="#largemodal">Map</a>
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



        {{-- <!-- Modal -->
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
                                    <div id="googleMapClockins" class="worldh world-map h-500" ></div>
                                    {{-- <iframe id="mapEmbededForNow" style="width:100%;height:400px;" src = "https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d4084493.7307095355!2d36.50569875426991!3d-1.3175850003645804!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2ske!4v1715327211380!5m2!1sen!2ske"></iframe> --}}
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
    var map;
    // var directionsRenderer;
    // var directionsService;
    
    function myMap2() {
        var clockins= @json($clockins);
        console.log("clockin 0");
        console.log(clockins[0]);
        console.log("clockin 0");


    if(clockins[0]['visits'][0]['outlet']){
    var mapProp= {
      center:new google.maps.LatLng(Number(clockins[0]['visits'][0]['outlet']['lat']),
      Number(clockins[0]['visits'][0]['outlet']['long'])),
      zoom:10,
    };
    // alert("working well");
    }else{
        var mapProp= {
      center:new google.maps.LatLng(-1.286389,
      36.817223),
      zoom:10,
    };
    //alert("we are here");

    }
    document.addEventListener("DOMContentLoaded", function() {
        // alert("we get here");
      
   var googleMapsDiv= document.getElementById("googleMapClockins");
    
    map = new google.maps.Map(googleMapsDiv,mapProp);
   
    directionsService = new google.maps.DirectionsService();
    directionsRenderer = new google.maps.DirectionsRenderer();
    directionsRenderer.setMap(map);
    var waypoints = [];
 

});


    }

    var markers = [];

    function rewriteMap(clockin){
        
        //alert('we get here');
        //alert (routeplan['routeplanitems'][0]['outlet']['lat']);
        
        //console.log(routeplan);
        waypoints=[];
        if(markers==undefined){
            // console.log(markers);
            // alert("undefined");
        }else{
            // alert("defined");
            // console.log(markers);
            markers.forEach(marker => {
                marker.setMap(null);
            });
            //test
            
            // if (directionsRenderer.getMap()) {
            // directionsRenderer.set('directions', null); // Clear previous route
            // }
            if (directionsRenderer && directionsRenderer.getMap()) {
                directionsRenderer.set('directions', null); // Clear previous route
            }
        }
        
 
        clockin.visits.forEach(visit => {
            console.log("visit");
            console.log(visit);
            console.log("visit");
            // Accessing outlet details
            console.log("visit outlet");
            console.log(visit.outlet);
            console.log("visit outlet");
            waypoints.push({ location: { lat: Number(visit.outlet.lat), lng: Number(visit.outlet.long) }, stopover: true });
        });
        
        //waypoints.push({ location: { lat: -1.244, lng: 36.8 }, stopover: true });
        console.log('Map instance:', map);
        // const myPosition = { lat: -25.344, lng: 131.031 };
        // var marker = new google.maps.Marker({position: myPosition});
        // marker.setMap(map);



        

        if(clockin.visits.length==1){
            const origin = waypoints.shift().location;

            console.log("origin");
            console.log(origin);
            console.log("origin");
            
            var bounds = new google.maps.LatLngBounds();
                addMarkers(map,clockin.visits,bounds);
                map.fitBounds(bounds);
                // alert('one');

        }
        else{

            const origin = waypoints.shift().location;
            const destination = waypoints.pop().location;

            const request = {
                origin: origin,
                destination: destination,
                waypoints: waypoints,
                optimizeWaypoints: true,
                travelMode: 'DRIVING'
            };

            directionsService.route(request, function(result, status) {
            if (status == 'OK') {
                directionsRenderer.setDirections(result);
                console.log('Route drawn with result:', result);
                addMarkers(map,clockin.visits);
            } else {
                console.error('Directions request failed due to ' + status);
                 var bounds = new google.maps.LatLngBounds();
                addMarkers(map,clockin.visits,bounds);
                map.fitBounds(bounds);
                // alert('many');
            }
        });

        }


        

        function addMarkers(map, visits,bounds) {
            var itemNumber = 1;
            var placedOutlets = [];
            visits.forEach(item => {
                //alert('adding marker');
                // alert("Testing this shit"+item.outlet.lat+" "+item.outlet.long);\
                                
                //should be google.maps.Marker.MAX_ZINDEX + 1 but we're using google.maps.Marker.MAX_ZINDEX + itemNumber to overlay multiple on the same for now
                placedOutlets.includes(item.outlet.id);
                var marker = new google.maps.Marker({
                    position: { lat: parseFloat(item.outlet.lat), lng: parseFloat(item.outlet.long) },
                    map: map,
                    label: String(itemNumber),
                    title: item.outlet.name,
                    zIndex: google.maps.Marker.MAX_ZINDEX + itemNumber 
                });
                itemNumber++;

                placedOutlets.push(item.outlet.id);

                if(bounds!=undefined){
                const outletPosition = { lat: parseFloat(item.outlet.lat), lng: parseFloat(item.outlet.long) };
                console.log(outletPosition);
                // Extend the bounds to include this marker's position
                bounds.extend(outletPosition);
                }

                //marker.setMap(map);

                var infoWindow = new google.maps.InfoWindow({
                    content: `
                        <div>
                            <h3>${item.outlet.name}</h3>
                            <p><strong>Contact Person:</strong> ${item.outlet.contact_person_name}</p>
                            <p><strong>Phone:</strong> ${item.outlet.phone}</p>
                            <p><strong>Latitude:</strong> ${item.outlet.lat}</p>
                            <p><strong>Longitude:</strong> ${item.outlet.long}</p>
                            <img src="${item.outlet.image}" alt="${item.outlet.name}" style="width:100px;height:auto;"/>
                        </div>
                    `
                });

                marker.addListener('click', function () {
                    infoWindow.open(map, marker);
                });

                markers.push(marker);

               
            });
            
        }


        


    // document.addEventListener("DOMContentLoaded", function() {
    //     console.log('Map instance:', map);
    //     alert('we get here too');

    // // function rewriteMap(){
        
    // // }
    
    // });
    
    }
    

    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=
    AIzaSyALLsNWwOC09xsRAqrK0S7dINi6BpNc7iw&callback=myMap2"></script>



