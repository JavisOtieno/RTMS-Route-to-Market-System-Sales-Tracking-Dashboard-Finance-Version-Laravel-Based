@extends('layout')

@section('content')
    <div class="side-app">

        <!-- CONTAINER -->
        <div class="main-container container-fluid">

            <!-- PAGE-HEADER -->
            <div class="page-header">
                <h1 class="page-title">Visits</h1>
                <div>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">RTMS</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Visits</li>
                    </ol>
                </div>
            </div>
            <!-- PAGE-HEADER END -->


            <div class="col-xl-12">

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Visits</h3>
                        
                    </div>
                    <div class="row" style="margin: 0 10px;">
                        <input type="hidden" id="tableLoaded" value="outlets"/>
                        <h3 class="card-title" style="margin-top:20px;margin-block-end: 0rem;">Date Filter :</h3>
                        <div class="row">
                        <div class="col-md-3 mb-3">
                            <label for="date" class="form-label">From</label>
                            <input type="date" class="form-control" id="dateFromInput" placeholder="Min Date">
                        </div>
            
                        <div class="col-md-3 mb-3">
                            <label for="date" class="form-label">To</label>
                            <input type="date" class="form-control" id="dateToInput" placeholder="Max Date">
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="timeFromInput" class="form-label">Checkin Time From (H:M)</label>
                            <input type="time" class="form-control" id="timeFromInput" placeholder="Min Time">
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="timeToInput" class="form-label">Checkin Time To (H:M)</label>
                            <input type="time" class="form-control" id="timeToInput" placeholder="Max Time">
                        </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3 mb-3">
                                <label for="durationFromInput" class="form-label">Duration From (H:M:S)</label>
                                <input type="time" step="1" class="form-control" id="durationFromInput" placeholder="Min Duration">
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="durationToInput" class="form-label">Duration To (H:M:S)</label>
                                <input type="time" step="1" class="form-control" id="durationToInput" placeholder="Max Duration">
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="timeFromInput" class="form-label">Checkout Time From (H:M)</label>
                                <input type="time" class="form-control" id="checkouttimeFromInput" placeholder="Min Time">
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="timeToInput" class="form-label">Checkout Time To (H:M)</label>
                                <input type="time" class="form-control" id="checkouttimeToInput" placeholder="Max Time">
                            </div>
                        </div>
            
                        {{-- <div class="col-md-3 mb-3">
                            <label for="nameInput" class="form-label">Outlet Name</label>
                            <input type="text" class="form-control" id="nameInput" placeholder="Name">
                        </div>
                        
                        <div class="col-md-3 mb-3">
                            <label for="contactNameInput" class="form-label">Contact Name</label>
                            <input type="text" class="form-control" id="contactNameInput" placeholder="Contact Name">
                        </div> --}}
                                
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="responsive-datatable-yajra" class="table table-bordered text-nowrap border-bottom">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Date</th>
            <th>Start Time</th>
            <th id="map-column">Map</th>
        </tr>
    </thead>
    <tbody></tbody> <!-- Leave empty for Yajra -->
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
                    <h6 class="modal-title">Delete</h6><button aria-label="Close" class="btn-close"
                        data-bs-dismiss="modal"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <h6>Are you sure you want to delete?</h6>
                    <strong id="itemDetails">Details</strong>
                </div>
                <div class="modal-footer">
                    <a id="confirmDelete" class="btn btn-danger" style="color: white">Delete</a> <button
                        class="btn btn-light" data-bs-dismiss="modal">Close</button>
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
                    <div id="googleMapVisit" class="worldh world-map h-500"></div>
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
    function deleteItem(id, name, sku, pieces) {
        //alert(id);
        var itemDetails = document.getElementById("itemDetails");
        itemDetails.innerHTML = "Visit Id: " + id + "<br/> Visit Name: " + name;
        var confirmDeleteLink = document.getElementById('confirmDelete'); //or grab it by tagname etc
        confirmDeleteLink.href = "/deletevisit/" + id;
    }

    function embedMap(lat, long) {
        //alert(id);
        var mapEmbedFrame = document.getElementById("mapEmbededForNow");
        mapEmbedFrame.src = "https://maps.google.com/maps?q=" + lat + "," + long + "&hl=es;z=14&amp&output=embed";
        //var confirmDeleteLink = document.getElementById('confirmDelete'); //or grab it by tagname etc
        //confirmDeleteLink.href = "/deletesale/"+id;
    }
</script>


<script>
    var map;
    var marker;

    function myMap2() {

        var mapProp = {
            center: new google.maps.LatLng(-1.3,
                36.8),
            zoom: 10,
        };

        document.addEventListener("DOMContentLoaded", function() {

            var googleMapsDiv = document.getElementById("googleMapVisit");

            map = new google.maps.Map(googleMapsDiv, mapProp);


        });


    }


    function loadPointOnMap(visit) {
        visit = JSON.parse(visit);

        // alert(visit.time);

        console.log('visit');
        console.log(visit);
        console.log('visit');


        if (marker == undefined) {
            // console.log(markers);
            // alert("undefined");
        } else {
            marker.setMap(null);

        }


        //waypoints.push({ location: { lat: -1.244, lng: 36.8 }, stopover: true });
        console.log('Map instance:', map);


        //should be google.maps.Marker.MAX_ZINDEX + 1 but we're using 
        //google.maps.Marker.MAX_ZINDEX + itemNumber to overlay multiple on the same for now

        var visitPosition = {
            lat: parseFloat(visit.outlet_lat),
            lng: parseFloat(visit.outlet_long)
        };
        // var visitPosition = {
        //     lat: parseFloat(1-1.289),
        //     lng: parseFloat(36.822)
        // };

        //alert('adding marker');
        marker = new google.maps.Marker({
            position: visitPosition,
            map: map,
            title: visit.outlet_name
        });

        map.setCenter(visitPosition);
        map.setZoom(12);


        //marker.setMap(map);
        var checkoutTime = "";

        if(visit.checkouttimeexact==null){
            checkoutTime="N/A";
            //test
        }else{
        // var checkoutDate = new Date(visit.checkout_time * 1000); // Convert to milliseconds
        // var checkoutHours = checkoutDate.getHours();
        // var minutes = checkoutDate.getMinutes();
        // minutes = minutes < 10 ? '0' + minutes : minutes;
        checkoutTime = visit.checkouttimeexact;
        }

        // if(visit.checkout_time==""){
        //     checkoutTime="N/A";
        //     //test
        // }else{
        // var checkoutDate = new Date(visit.checkout_time * 1000); // Convert to milliseconds
        // var checkoutHours = checkoutDate.getHours();
        // var minutes = checkoutDate.getMinutes();
        // minutes = minutes < 10 ? '0' + minutes : minutes;
        // checkoutTime = checkoutHours + ':' + minutes;
        // }

        // var date = new Date(visit.created_at);
        // var hours = date.getHours();
        // var minutes = date.getMinutes();
        // var day = date.getDate();
        // var month = date.getMonth(); // Months are zero-based, so add 1
        // var year = date.getFullYear();

        // var monthNames = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];

        // // Get month name from array
        // var monthName = monthNames[month];

        // var visitDate = day + '-' + monthName + '-' + year;

        // // Pad single digit minutes with a leading zero
        // minutes = minutes < 10 ? '0' + minutes : minutes;

        // var visitTime = hours + ':' + minutes;

        var infoWindow = new google.maps.InfoWindow({
                content: `
                    <div>
                        <h3>Seller: ${visit.user_name}</h3>
                        <p><strong>Outlet Name:</strong> ${visit.outlet_name}</p>
                        <p><strong>Contact Person:</strong> ${visit.contactpersonname}</p>
                        <p><strong>Phone:</strong> ${visit.phone}</p>
                        <p><strong>Latitude:</strong> ${visit.outlet_lat}</p>
                        <p><strong>Longitude:</strong> ${visit.outlet_long}</p>
                        <p><strong>Date:</strong> ${visit.date}</p>
                        <p><strong>Checkin Time:</strong> ${visit.time}</p>
                        <p><strong>Checkout Time:</strong> ${checkoutTime}</p>
                        <p><strong>Duration:</strong> ${visit.duration}</p>
                        <p><strong>View:<strong> <a href='/visit/${visit.id}' >View Visit Details</a></p>
                    </div>
                `
            });


        // Open the info window
        let isInfoWindowOpen = true;
        infoWindow.open(map, marker);

        //added the toggle functionality here because for this case the map opens up the infoview on load

        marker.addListener('click', function() {
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


<script>
document.addEventListener("DOMContentLoaded", function() {
    $(function() {
        var table = $('#responsive-datatable-yajra').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: '{!! route("clockins.yajra") !!}',
                type: 'GET',
                data: function(d) {
                    d.name = $('#nameInput').val();
                    d.from_date = $('#dateFromInput').val();
                    d.to_date = $('#dateToInput').val();
                    d.from_time = $('#timeFromInput').val();
                    d.to_time = $('#timeToInput').val();
                }
            },
            columns: [
                { data: 'id', name: 'id' },
                { data: 'name', name: 'users.name', defaultContent: 'No User' },
                { data: 'date', name: 'created_at' },
                { data: 'time', name: 'created_at' },
                { data: 'map', name: 'map', orderable: false, searchable: false }
            ],
            order: [[0, 'desc']],
            lengthMenu: [10, 25, 50, 100],
            pageLength: 10,
        });

        // Redraw on filter change
        $('#nameInput, #dateFromInput, #dateToInput, #timeFromInput, #timeToInput').on('change keyup', function() {
            table.draw();
        });
    });
});
</script>

<script>
    var map;
    // var directionsRenderer;
    // var directionsService;
    
    function myMap2() {
        var clockins= @json($clockins);
        console.log("clockin 0");
        console.log(clockins[0]);
        console.log("clockin 0");


    if (clockins[0] && clockins[0]['visits'] && 
    clockins[0]['visits'][0] && clockins[0]['visits'][0]['outlet'] != null) {

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
            // if (directionsRenderer && directionsRenderer.getMap()) {
            //     directionsRenderer.set('directions', null); // Clear previous route
            // }

            if (typeof directionsRenderer !== 'undefined' && directionsRenderer.getMap()) {
                directionsRenderer.set('directions', null); // Clear previous route
            }
            
        }

        waypoints.push({ location: { lat: Number(clockin.lat), lng: Number(clockin.long) }, stopover: true });


        clockin.visits.forEach(visit => {
            // console.log("visit");
            // console.log(visit);
            // console.log("visit");
            // // Accessing outlet details
            // console.log("visit outlet");
            // console.log(visit.outlet);
            // console.log("visit outlet");
            waypoints.push({ location: { lat: Number(visit.outlet.lat), lng: Number(visit.outlet.long) }, stopover: true });
        });

        if(clockin && clockin['clockout'] != null){
            console.log("clockout");
            console.log(clockin.clockout);
            console.log("clockout");
            waypoints.push({ location: { lat: Number(clockin.clockout.lat), 
                lng: Number(clockin.clockout.long) }, stopover: true });

        }

        console.log("waypoints");
        console.log(waypoints);
        console.log("waypoints");


        
        //waypoints.push({ location: { lat: -1.244, lng: 36.8 }, stopover: true });
        console.log('Map instance:', map);
        // const myPosition = { lat: -25.344, lng: 131.031 };
        // var marker = new google.maps.Marker({position: myPosition});
        // marker.setMap(map);



        

        //NO NEED AS CLOCKIN WILL ALWAYS BE THE ORIGIN
        if(clockin.visits.length==0 && clockin.clockout==null){
            const origin = waypoints.shift().location;

            console.log("origin");
            console.log(origin);
            console.log("origin");
            
            var bounds = new google.maps.LatLngBounds();
                addMarkers(map,clockin,bounds);
                map.fitBounds(bounds);
                //  alert('one');

        }

        else{

            const origin = waypoints.shift().location;
            // const destination = waypoints.pop().location;
            const destination = waypoints.length > 0 ? waypoints.pop().location : null;

            const request = {
                origin: origin,
                // destination: destination,
                waypoints: waypoints,
                optimizeWaypoints: true,
                travelMode: 'DRIVING'
            };

            if (destination!=null) {
                    request.destination = destination;
                }


            directionsService.route(request, function(result, status) {
            if (status == 'OK') {

                const route = result.routes[0];
                let totalDistance = 0;

                // Loop through each leg to calculate the total distance
                route.legs.forEach(leg => {
                    totalDistance += leg.distance.value; // distance.value is in meters
                });

                if (totalDistance < 50) {
                    console.log('Route is less than 50 meters, not drawing directions.');
                    var bounds = new google.maps.LatLngBounds();
                    addMarkers(map,clockin,bounds);
                    map.fitBounds(bounds);
                } else {
                    directionsRenderer.setDirections(result);
                    console.log('Route drawn with result:', result);
                    addMarkers(map, clockin);
                }

                // directionsRenderer.setDirections(result);
                // console.log('Route drawn with result:', result);
                // addMarkers(map,clockin);

            } else {
                console.error('Directions request failed due to ' + status);
                 var bounds = new google.maps.LatLngBounds();
                addMarkers(map,clockin,bounds);
                map.fitBounds(bounds);
                // alert('many');
            }
        });

        }


        

        function addMarkers(map, clockin,bounds) {
            var itemNumber = 1;
            var placedOutlets = [];

            var clockinmarker = new google.maps.Marker({
                    position: { lat: parseFloat(clockin.lat), lng: parseFloat(clockin.long) },
                    map: map,
                    label: 'IN',
                    title: "Clockin",
                    zIndex: google.maps.Marker.MAX_ZINDEX + 0.5
                });
                if(bounds!=undefined){
                const clockinPosition = { lat: parseFloat(clockin.lat), lng: parseFloat(clockin.long) };
                console.log(clockinPosition);
                bounds.extend(clockinPosition);
                }
                var infoWindow = new google.maps.InfoWindow({
                    content: `
                        <div>
                            <h3>${clockin.user.name}</h3>
                            <p><strong>Clockin Time:</strong> ${clockin.created_at}</p>
                            <p><strong>Latitude:</strong> ${clockin.lat}</p>
                            <p><strong>Longitude:</strong> ${clockin.long}</p>
                        </div>
                    `
                });

                clockinmarker.addListener('click', function () {
                    infoWindow.open(map, clockinmarker);
                });

                markers.push(clockinmarker);

            
            clockin.visits.forEach(item => {
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

            if(clockin && clockin['clockout'] != null){
            var clockoutmarker = new google.maps.Marker({
                    position: { lat: parseFloat(clockin.clockout.lat), 
                        lng: parseFloat(clockin.clockout.long) },
                    map: map,
                    label: 'OUT',
                    title: "Clockout",
                    zIndex: google.maps.Marker.MAX_ZINDEX + itemNumber
                });
                if(bounds!=undefined){
                const clockoutPosition = { lat: parseFloat(clockin.clockout.lat), 
                    lng: parseFloat(clockin.clockout.long) };
                console.log(clockoutPosition);
                bounds.extend(clockoutPosition);
                }
                var infoWindow = new google.maps.InfoWindow({
                    content: `
                        <div>
                            <h3>${clockin.user.name}</h3>
                            <p><strong>Clockin Time:</strong> ${clockin.clockout.created_at}</p>
                            <p><strong>Latitude:</strong> ${clockin.clockout.lat}</p>
                            <p><strong>Longitude:</strong> ${clockin.clockout.long}</p>
                        </div>
                    `
                });

                clockoutmarker.addListener('click', function () {
                    infoWindow.open(map, clockoutmarker);
                });

                markers.push(clockoutmarker);    
        }


    }


        


    // document.addEventListener("DOMContentLoaded", function() {
    //     console.log('Map instance:', map);
    //     alert('we get here too');

    // // function rewriteMap(){
        
    // // }
    
    // });
    
    }
    

    </script>
