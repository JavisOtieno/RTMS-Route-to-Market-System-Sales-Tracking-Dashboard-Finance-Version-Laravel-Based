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
/* ---------- Globals ---------- */
var map;
var directionsService;
var directionsRenderer;
var markers = [];

/* Initialize map with a safe default center.
   Call this as the callback from the Google Maps script: callback=initClockinsMap
*/
function initClockinsMap() {
    var defaultCenter = { lat: -1.286389, lng: 36.817223 }; // Nairobi default
    var mapProp = {
        center: new google.maps.LatLng(defaultCenter.lat, defaultCenter.lng),
        zoom: 10
    };

    var googleMapsDiv = document.getElementById("googleMapClockins") || document.getElementById("googleMapVisit");
    if (!googleMapsDiv) {
        // no map container on page (safe exit)
        return;
    }

    map = new google.maps.Map(googleMapsDiv, mapProp);

    directionsService = new google.maps.DirectionsService();
    directionsRenderer = new google.maps.DirectionsRenderer({
        suppressMarkers: true // we add custom markers
    });
    directionsRenderer.setMap(map);
}

/* Helper: clear existing markers and directions */
function clearMapState() {
    // clear markers
    if (Array.isArray(markers)) {
        markers.forEach(m => { try { m.setMap(null); } catch(e) {} });
    }
    markers = [];
    // clear directions
    if (typeof directionsRenderer !== 'undefined' && directionsRenderer !== null) {
        try {
            directionsRenderer.set('directions', null);
        } catch(e) {}
    }
}

/* Called when Map button created by DataTable is clicked.
   The button has data-row attribute with rawurlencoded JSON.
   Use: <button class="open-map-btn" data-row="...">Map</button>
*/
function openMapFromElement(el) {
    if (!el) return;
    try {
        var rowJson = decodeURIComponent(el.getAttribute('data-row'));
        var clockin = JSON.parse(rowJson);
        // if you use Bootstrap 5 modal:
        var modalEl = document.getElementById('largemodal');
        if (modalEl) {
            var modal = new bootstrap.Modal(modalEl);
            modal.show();
        }
        // call your existing rewriteMap (now adapted below expects object)
        rewriteMap(clockin);
    } catch (err) {
        console.error('Failed to open map from element', err);
    }
}

/* Attach a delegated click handler for any .open-map-btn (works with dynamically added buttons) */
document.addEventListener('click', function(e) {
    var target = e.target;
    if (target && target.classList && target.classList.contains('open-map-btn')) {
        openMapFromElement(target);
    }
}, true);

/* ---------- rewriteMap (cleaned/robust) ---------- */
function rewriteMap(clockin) {
    if (!map) {
        console.warn('Map not initialized yet.');
        return;
    }

    clearMapState();

    // Ensure basic structure
    clockin = clockin || {};
    clockin.visits = clockin.visits || [];
    // Some backends may nest relations differently; support both object and array for clockout/user
    // clockin.clockout may be null or object
    // Expect lat/long either on clockin (lat,long) or on clockin.lat/clockin.long
    var waypoints = [];

    // add origin (clockin lat/long) if present
    if (clockin.lat && clockin.long) {
        waypoints.push({ location: { lat: Number(clockin.lat), lng: Number(clockin.long) }, stopover: true });
    } else if (clockin.visits.length > 0 && clockin.visits[0].outlet) {
        // fallback center to first visit outlet
        var firstOutlet = clockin.visits[0].outlet;
        if (firstOutlet.lat && firstOutlet.long) {
            waypoints.push({ location: { lat: Number(firstOutlet.lat), lng: Number(firstOutlet.long) }, stopover: true });
        }
    }

    // visits -> outlets
    alert('visits count: ' + (clockin.visits ? clockin.visits.length : 0));
    clockin.visits.forEach(function(v) {
        if (v && v.outlet && v.outlet.lat && v.outlet.long) {
            alert('adding waypoint for outlet id ' + v.outlet.id+', lat ' + v.outlet.lat + ', long ' + v.outlet.long);
            waypoints.push({ location: { lat: Number(v.outlet.lat), lng: Number(v.outlet.long) }, stopover: true });
        }
    });

    // clockout as last point (if present)
    if (clockin.clockout && clockin.clockout.lat && clockin.clockout.long) {
        waypoints.push({ location: { lat: Number(clockin.clockout.lat), lng: Number(clockin.clockout.long) }, stopover: true });
    }

    // If there are no waypoints, abort
    if (waypoints.length === 0) {
        console.warn('No coordinates available to show on map.');
        return;
    }

    // If only one point (origin only), just put a marker and center
    if (waypoints.length === 1) {
        var only = waypoints[0].location;
        var bounds = new google.maps.LatLngBounds();
        addMarkers(map, clockin, bounds);
        map.fitBounds(bounds);
        return;
    }

    // For directions: origin = first, destination = last, rest -> waypoints
    var origin = waypoints.shift().location;
    var destination = waypoints.length > 0 ? (waypoints.pop().location) : origin;
    var dsWaypoints = waypoints.map(function(w){ return { location: w.location, stopover: true }; });

    var request = {
        origin: origin,
        destination: destination,
        waypoints: dsWaypoints,
        optimizeWaypoints: true,
        travelMode: 'DRIVING'
    };

     if (typeof google === 'undefined' || typeof google.maps === 'undefined') {
        console.warn('Google Maps API not loaded yet.');
        return false;
    }
    if (!map) {
        // create map if missing using a default center
        initClockinsMap(); // make sure this function exists and creates `map`
        if (!map) {
            console.warn('Map still not initialized after initClockinsMap() call.');
            return false;
        }
    }
    if (typeof directionsService === 'undefined' || !directionsService) {
        directionsService = new google.maps.DirectionsService();
    }
    if (typeof directionsRenderer === 'undefined' || !directionsRenderer) {
        directionsRenderer = new google.maps.DirectionsRenderer({ suppressMarkers: true });
        directionsRenderer.setMap(map);
    }

    directionsService.route(request, function(result, status) {
        if (status === 'OK' && result && result.routes && result.routes.length) {
            var route = result.routes[0];
            // compute total distance (meters)
            var totalDistance = 0;
            route.legs.forEach(function(leg) { totalDistance += (leg.distance ? leg.distance.value || 0 : 0); });

            if (totalDistance < 50) {
                // too short, don't draw route — draw markers only
                var bounds = new google.maps.LatLngBounds();
                addMarkers(map, clockin, bounds);
                map.fitBounds(bounds);
            } else {
                directionsRenderer.setDirections(result);
                addMarkers(map, clockin);
            }
        } else {
            console.warn('Directions request failed:', status);
            var bounds = new google.maps.LatLngBounds();
            addMarkers(map, clockin, bounds);
            map.fitBounds(bounds);
        }
    });
}

/* addMarkers: reworked helper that accepts an optional LatLngBounds instance to extend */
function addMarkers(mapInstance, clockin, bounds) {
    bounds = bounds || null;
    var zIndexBase = google.maps.Marker.MAX_ZINDEX || 99999;
    var itemNumber = 1;

    // clockin marker (IN) if present
    if (clockin.lat && clockin.long) {
        var ciPos = { lat: parseFloat(clockin.lat), lng: parseFloat(clockin.long) };
        var clockinMarker = new google.maps.Marker({
            position: ciPos,
            map: mapInstance,
            label: 'IN',
            title: 'Clockin',
            zIndex: zIndexBase + 1
        });
        (function(marker, data){
            var content = '<div><h3>' + (data.user && data.user.name ? data.user.name : 'User') + '</h3>'
                        + '<p><strong>Clockin Time:</strong> ' + (data.created_at || '') + '</p>'
                        + '<p><strong>Latitude:</strong> ' + (data.lat || '') + '</p>'
                        + '<p><strong>Longitude:</strong> ' + (data.long || '') + '</p></div>';
            var iw = new google.maps.InfoWindow({ content: content });
            marker.addListener('click', function(){ iw.open(mapInstance, marker); });
        })(clockinMarker, clockin);

        markers.push(clockinMarker);
        if (bounds) bounds.extend(ciPos);
    }

    // outlets
    var placed = new Set();
    (clockin.visits || []).forEach(function(item){
        var outlet = item.outlet || item;
        if (!outlet || !outlet.lat || !outlet.long) return;
        if (placed.has(outlet.id)) return;
        placed.add(outlet.id);

        var pos = { lat: parseFloat(outlet.lat), lng: parseFloat(outlet.long) };
        var m = new google.maps.Marker({
            position: pos,
            map: mapInstance,
            label: String(itemNumber++),
            title: outlet.name || 'Outlet',
            zIndex: zIndexBase + itemNumber
        });

        (function(marker, outletData){
            var content = '<div><h3>' + (outletData.name || '') + '</h3>'
                        + '<p><strong>Contact Person:</strong> ' + (outletData.contact_person_name || '') + '</p>'
                        + '<p><strong>Phone:</strong> ' + (outletData.phone || '') + '</p>'
                        + '<p><strong>Latitude:</strong> ' + (outletData.lat || '') + '</p>'
                        + '<p><strong>Longitude:</strong> ' + (outletData.long || '') + '</p>'
                        + (outletData.image ? '<img src="' + outletData.image + '" style="width:100px;height:auto;"/>' : '')
                        + '</div>';
            var iw = new google.maps.InfoWindow({ content: content });
            marker.addListener('click', function(){ iw.open(mapInstance, marker); });
        })(m, outlet);

        markers.push(m);
        if (bounds) bounds.extend(pos);
    });

    // clockout marker
    if (clockin.clockout && clockin.clockout.lat && clockin.clockout.long) {
        var coPos = { lat: parseFloat(clockin.clockout.lat), lng: parseFloat(clockin.clockout.long) };
        var outMarker = new google.maps.Marker({
            position: coPos,
            map: mapInstance,
            label: 'OUT',
            title: 'Clockout',
            zIndex: zIndexBase + itemNumber + 1
        });
        (function(marker, data){
            var content = '<div><h3>' + (data.user && data.user.name ? data.user.name : 'User') + '</h3>'
                        + '<p><strong>Clockout Time:</strong> ' + (data.clockout.created_at || '') + '</p>'
                        + '<p><strong>Latitude:</strong> ' + (data.clockout.lat || '') + '</p>'
                        + '<p><strong>Longitude:</strong> ' + (data.clockout.long || '') + '</p></div>';
            var iw = new google.maps.InfoWindow({ content: content });
            marker.addListener('click', function(){ iw.open(mapInstance, marker); });
        })(outMarker, clockin);

        markers.push(outMarker);
        if (bounds) bounds.extend(coPos);
    }

    // If bounds provided, fit
    if (bounds) {
        try { map.fitBounds(bounds); } catch(e) {}
    } else {
        // if no bounds, try to center on first marker
        if (markers.length) {
            try {
                map.setCenter(markers[0].getPosition());
                map.setZoom(12);
            } catch(e) {}
        }
    }
}
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=
    AIzaSyALLsNWwOC09xsRAqrK0S7dINi6BpNc7iw&callback=initClockinsMap"></script>
