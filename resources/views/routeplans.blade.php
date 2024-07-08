@extends('layout')

@section('content')

<div class="side-app">

    <!-- CONTAINER -->
    <div class="main-container container-fluid">

  <!-- PAGE-HEADER -->
  <div class="page-header">
    <h1 class="page-title">Route Plans</h1>
    <div>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">RTMS</a></li>
            <li class="breadcrumb-item active" aria-current="page">Route Plans</li>
        </ol>
    </div>
</div>
<!-- PAGE-HEADER END -->


<div class="col-xl-12">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Create Route Plan</h3>
            <a type="button" href="/createrouteplan" class="btn btn-danger col-md-3" 
            style="margin-left: auto;margin-right:20px;margin-top:10px;margin-bottom:10px;color:white;"
            >Create Route Plan</a>
        </div>
        <div class="row" style="margin: 0 10px;">
            <input type="hidden" id="tableLoaded" value="posaudits"/>
            <h3 class="card-title" style="margin-top:20px;margin-block-end: 0rem;">Search by :</h3>
            <div class="col-md-3 mb-3">
                <label for="name" class="form-label">Seller Name</label>
                <input type="text" class="form-control" id="nameInput" placeholder="Name">
            </div>
            <div class="col-md-3 mb-3">
                <label for="outletName" class="form-label">Outlet Name</label>
                <input type="text" class="form-control" id="outletNameInput" placeholder="Outlet Name">
            </div>
            
            
        </div>
        <div class="card-body">
            <!--<p>Use <code class="highlighter-rouge">.table-striped</code>to add zebra-striping to any table row within the <code class="highlighter-rouge">.tbody</code>.</p>-->
            <div class="table-responsive">
                <table id="responsive-datatable" class="table table-bordered text-nowrap border-bottom">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Seller Name</th>
                            <th>Route Plan Name</th>
                            <th>Added</th>
                            <th>Scheduled</th>
                            <th id="view-column">View</th>
                            <th id="map-column">Map</th>
                            <th id="delete-column">Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(count($routeplans)>0)
                        
                        @foreach($routeplans as $routeplan)
<tr>
<td>{{$routeplan['id']}}</td>
{{-- <td>{{$posaudit['user']['name']}}</td> --}}
<td>{{ $routeplan['user'] ? $routeplan['user']['name']  . ($routeplan['user']->trashed() ? ' (Deleted User)' : '') : 'Deleted User'}}
<td>{{$routeplan['name']}}</td>
<td>{{date('d-M-Y H:i', strtotime($routeplan['created_at']))}}</td>
<td>{{$routeplan['date']}}</td>
<td><a type="button" href="/routeplan/{{$routeplan['id']}}" class="btn btn-info" style="margin-left: auto;color:white;">View</a>
</td>
<td><a type="button" 
    {{-- onclick="embedMap2()" --}}
    id=""
     onclick="rewriteMap({{ $routeplan }})"
    class="btn btn-success" style="margin-left: auto;color:white;" data-bs-toggle="modal" href="#largemodal">Map</a>
</td>
{{-- <td>
    <form method="POST" action="{{ route('editproduct') }}">
        @csrf
        <input type="hidden" name="id" value="{{ $product->id }}">
        <!-- Other form fields -->
        <button type="submit" class="btn btn-info">View</button>
    </form>
</td> --}}
<td><a type="button" onclick="deleteItem('{{$routeplan['id']}}','{{$routeplan['name']}}','{{$routeplan['user']['name']}}')"  class="btn btn-danger" style="margin-left: auto;color:white;" data-bs-toggle="modal" href="#modalDelete">Delete</a>
</td>
</tr>
@endforeach

@else
                                    <!--<tr><td colspan="7" style="text-align: center">No sales so far</td></tr>-->
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
                            <div id="googleMapRouteplans" class="worldh world-map h-500" ></div>
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
    function deleteItem(id,name,seller){
        //alert(id);
        var itemDetails = document.getElementById("itemDetails");
        itemDetails.innerHTML = "Route Plan Name: "+name+"<br/> Seller Name: "+seller;
        var confirmDeleteLink = document.getElementById('confirmDelete'); //or grab it by tagname etc
        confirmDeleteLink.href = "/deleterouteplan/"+id;
    }
  </script>

{{-- <script>

function embedMap(lat,long){
        //alert(id);
        var mapEmbedFrame = document.getElementById("mapEmbededForNow");
        mapEmbedFrame.src = "https://maps.google.com/maps?q="+lat+","+long+"&hl=es;z=14&amp&output=embed";
        //var confirmDeleteLink = document.getElementById('confirmDelete'); //or grab it by tagname etc
        //confirmDeleteLink.href = "/deletesale/"+id;
    }
    
    function embedMap2() {
        //alert("we get here");
        var mapProp= {
      center:new google.maps.LatLng(-1.286389,
      36.817223),
      zoom:10,
    };
    var routeplans= @json($routeplans);
    

    if(routeplans[0]['routeplanitems'][0]['outlet']){
        alert("we get here routeplan yeah");
    var mapProp= {
      center:new google.maps.LatLng(Number(routeplans[0]['routeplanitems'][0]['outlet']['lat']),
      Number(routeplans[0]['routeplanitems'][0]['outlet']['long'])),
      zoom:10,
    };
    }else{
        alert("we get here!!!!!");
        var mapProp= {
      center:new google.maps.LatLng(-1.286389,
      36.817223),
      zoom:10,
    };
    //alert("we are here");

    }
    document.addEventListener("DOMContentLoaded", function() {
      
    alert("before we get ahead of ourselves");
   var googleMapsDiv= document.getElementById("mapEmbededForNow");
   alert("we dont need the dom yeah");


    
    var map = new google.maps.Map(googleMapsDiv,mapProp);
    if(routeplans.length>0){
        alert("we get here with the plans. wuuhuu");
    var bounds = new google.maps.LatLngBounds();

    console.log(routeplans);
    
    routeplans.forEach(routeplan => {
        var lat1 = Number(routeplan['routeplanitems'][0]['outlet']['lat']);
        var long1 = Number(routeplan['routeplanitems'][0]['outlet']['long']);
        alert(lat1);
        alert(long1);

        // const myPosition = { lat: lat1, lng: long1 };
        //console.log(myPosition);

        // var markerElement = new google.maps.marker.AdvancedMarkerElement({
        //         position: myPosition,
        //         map: map,
        //         title: 'Visit Marker', // Add a title if needed
        //     });

            // Extend the bounds to include this marker's position
         //   bounds.extend(myPosition);

            // var infoContent = "<div><h3>"+visit['outlet']['name']+"</h3>"+
            //     "<p>Latitude: "+lat1+"</p>"+
            //     "<p>Longitude: "+long1+"</p>"+
            //     "<p>Seller: "+visit['user']['name']+"</p>"+
            // "</div>";

            // Create an InfoWindow
            // var infoWindow = new google.maps.InfoWindow({
            //     content: infoContent
            // });
            //
            // var infowindow = new google.maps.InfoWindow({
            //     content: "<div><h3>"+routeplan['routeplanitems'][0]['outlet']['name']+"</h3>"+
            //         "<p>Latitude: "+lat1+"</p>"+
            //         "<p>Longitude: "+long1+"</p>"+
            //         "</div>"
            // });

            // Add a click event listener to the marker to open the InfoWindow
            // marker.addListener('click', function() {
            //     infoWindow.open(map, marker);
            // });
            const myPosition = { lat: -25.344, lng: 131.031 };
            
        
        alert(routeplan['routeplanitems'][0]['outlet']['name']);
        var marker = new google.maps.Marker({position: myPosition,
            title: routeplan['routeplanitems'][0]['outlet']['name'],
        });
        // google.maps.event.addListener(marker, 'click', function() {
        //         infowindow.open(map,marker);
        //     });
        marker.setMap(map);
        
    });
    //map.fitBounds(bounds);
    var lat1 = routeplans[0]['routeplanitems'][0]['outlet']['lat'];
    var long1 = routeplans[0]['routeplanitems'][0]['outlet']['long'];
    }

    });

   // console.log(recentVisits);
    

    // console.log(myPosition);
    // const myPosition2 = { lat: Number(lat1), lng: Number(long1) };
    // console.log(myPosition2);
    // var map = new google.maps.Map(document.getElementById("googleMap"),mapProp);
    // var marker = new google.maps.Marker({position: myPosition});
    // marker.setMap(map);
    // var marker2 = new google.maps.Marker({position: myPosition});
    // marker2.setMap(map);
    }

    

    </script>

<script src="https://maps.googleapis.com/maps/api/js?key=
AIzaSyALLsNWwOC09xsRAqrK0S7dINi6BpNc7iw&callback=embedMap2"></script> --}}

<script>
    var map;
    
    function myMap2() {
        var routeplans= @json($routeplans);

    if(routeplans[0]['routeplanitems'][0]['outlet']){
    var mapProp= {
      center:new google.maps.LatLng(Number(routeplans[0]['routeplanitems'][0]['outlet']['lat']),
      Number(routeplans[0]['routeplanitems'][0]['outlet']['long'])),
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
      
    
   var googleMapsDiv= document.getElementById("googleMapRouteplans");


    
    map = new google.maps.Map(googleMapsDiv,mapProp);
    directionsService = new google.maps.DirectionsService();
    directionsRenderer = new google.maps.DirectionsRenderer();
    directionsRenderer.setMap(map);
    var waypoints = [];
 
    // if(routeplans.length>0){
    // var bounds = new google.maps.LatLngBounds();
    
    // routeplans[0]['routeplanitems'].forEach(routeplanitem => {
    //     var lat1 = Number(routeplanitem['outlet']['lat']);
    //     var long1 = Number(routeplanitem['outlet']['long']);
    
    //     waypoints.push({ location: { lat: lat1, lng: long1 }, stopover: true });

    //     const myPosition = { lat: lat1, lng: long1 };
    //     console.log(myPosition);

    //     // var markerElement = new google.maps.marker.AdvancedMarkerElement({
    //     //         position: myPosition,
    //     //         map: map,
    //     //         title: 'Visit Marker', // Add a title if needed
    //     //     });

    //         // Extend the bounds to include this marker's position
    //         bounds.extend(myPosition);

    //         // var infoContent = "<div><h3>"+visit['outlet']['name']+"</h3>"+
    //         //     "<p>Latitude: "+lat1+"</p>"+
    //         //     "<p>Longitude: "+long1+"</p>"+
    //         //     "<p>Seller: "+visit['user']['name']+"</p>"+
    //         // "</div>";

    //         // Create an InfoWindow
    //         // var infoWindow = new google.maps.InfoWindow({
    //         //     content: infoContent
    //         // });
    //         //
    //         var infowindow = new google.maps.InfoWindow({
    //             content: "<div><h3>"+routeplanitem['outlet']['name']+"</h3>"+
    //                 // "<p>Seller: "+( routeplanitem['outlet']['user']===null ? 'Deleted User': routeplanitem['outlet']['user']['name'])+"</p>"+
    //                 "<p>Latitude: "+lat1+"</p>"+
    //                 "<p>Longitude: "+long1+"</p>"+
    //                 "</div>"
    //         });

    //         // Add a click event listener to the marker to open the InfoWindow
    //         // marker.addListener('click', function() {
    //         //     infoWindow.open(map, marker);
    //         // });
            
        
       
    //     // var marker = new google.maps.Marker({position: myPosition,
    //     //     title: routeplanitem['outlet']['name'],
    //     // });
    //     // google.maps.event.addListener(marker, 'click', function() {
    //     //         infowindow.open(map,marker);
    //     //     });
    //     // marker.setMap(map);
        
    // });
    // map.fitBounds(bounds);
    
    //             const origin = waypoints.shift().location;
    //             const destination = waypoints.pop().location;

    //             const request = {
    //                 origin: origin,
    //                 destination: destination,
    //                 waypoints: waypoints,
    //                 optimizeWaypoints: true,
    //                 travelMode: 'DRIVING'
    //             };

    //             directionsService.route(request, function(result, status) {
    //                 if (status == 'OK') {
    //                     directionsRenderer.setDirections(result);
    //                     console.log('Route drawn with result:', result);
                       
    //                 } else {
    //                     console.error('Directions request failed due to ' + status);
    //                 }
    //             });









    // var lat1 = routeplans[0]['routeplanitems'][0]['outlet']['lat'];
    // var long1 = routeplans[0]['routeplanitems'][0]['outlet']['long'];
    // }

});
   // console.log(recentVisits);
    
    // const myPosition = { lat: -25.344, lng: 131.031 };
    // //console.log(myPosition);
    // const myPosition2 = { lat: Number(lat1), lng: Number(long1) };
    // //console.log(myPosition2);
    // var map = new google.maps.Map(document.getElementById("googleMap"),mapProp);
    // var marker = new google.maps.Marker({position: myPosition});
    // marker.setMap(map);
    // var marker2 = new google.maps.Marker({position: myPosition2});
    // marker2.setMap(map);
    }

    var markers = [];

    function rewriteMap(routeplan){
        
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
            if (directionsRenderer.getMap()) {
            directionsRenderer.set('directions', null); // Clear previous route
            }
        }
        
 
        routeplan.routeplanitems.forEach(routeplanitem => {
            console.log(routeplanitem);
            // Accessing outlet details
            console.log(routeplanitem.outlet);
            waypoints.push({ location: { lat: Number(routeplanitem.outlet.lat), lng: Number(routeplanitem.outlet.long) }, stopover: true });
        });
        
        //waypoints.push({ location: { lat: -1.244, lng: 36.8 }, stopover: true });
        console.log('Map instance:', map);
        // const myPosition = { lat: -25.344, lng: 131.031 };
        // var marker = new google.maps.Marker({position: myPosition});
        // marker.setMap(map);

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
                addMarkers(map,routeplan.routeplanitems);
            } else {
                console.error('Directions request failed due to ' + status);
                 var bounds = new google.maps.LatLngBounds();
                addMarkers(map,routeplan.routeplanitems,bounds);
                map.fitBounds(bounds);
            }
        });

        

        function addMarkers(map, routeplanitems,bounds) {
            var itemNumber = 1;
            routeplanitems.forEach(item => {
                //alert('adding marker');
                var marker = new google.maps.Marker({
                    position: { lat: parseFloat(item.outlet.lat), lng: parseFloat(item.outlet.long) },
                    map: map,
                    label: String(itemNumber),
                    title: item.outlet.name,
                    zIndex: google.maps.Marker.MAX_ZINDEX + 1 
                });
                itemNumber++;

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

