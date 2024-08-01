@extends('layout-form')

@section('content')

<div class="side-app">

    <!-- CONTAINER -->
    <div class="main-container container-fluid">

  <!-- PAGE-HEADER -->
  <div class="page-header">
    <h1 class="page-title">Clockouts Map</h1>
    <div>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">RTMS</a></li>
            <li class="breadcrumb-item active" aria-current="page">Clockouts Map</li>
        </ol>
    </div>
</div>
<!-- PAGE-HEADER END -->


<div class="col-xl-12">

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Clockouts Map</h3>
        </div>
        <div class="row" style="margin: 0 10px;">
            <input type="hidden" id="tableLoaded" value="outlets"/>
            <h3 class="card-title" style="margin-top:20px;margin-block-end: 0rem;">Search by :</h3>
            <div class="col-md-3 mb-3">
                <label for="nameInput" class="form-label">Seller Name</label>
                <select id="userFilter"  class="form-control select2-show-search form-select">
                    <!-- Options will be populated dynamically -->
                    <option value="">All Users</option>
                    @foreach($users as $user)
                    <option value="{{$user['name']}}">{{$user['name']}}</option>
                    @endforeach
                </select>
                
            </div>



            <div class="col-md-3 mb-3">
            
            <label for="date" class="form-label">From</label>
            <input type="date" class="form-control" id="fromDate" placeholder="Min Date">
            </div>
            <div class="col-md-3 mb-3">
            
            <label for="date" class="form-label">To</label>
            <input type="date" class="form-control" id="toDate" placeholder="Max Date">
            </div>

            <div class="col-md-3 mb-3">
                <div class="row">
                <div class="col-md-6 ">
                    <label for="fromTime" class="form-label">Time From</label>
                    <input type="time" class="form-control" id="fromTime" placeholder="Min Date">
                </div>
                <div class="col-md-6 ">
                    <label for="toTime" class="form-label">Time To</label>
                    <input type="time" class="form-control" id="toTime" placeholder="Max Date">
                </div>
                </div>
                </div>

           
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <div id="googleMapClockouts" class="worldh world-map h-500" ></div>
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

  
{{-- <script>
    
    function myMap2() {
        var clockouts= @json($clockouts);

    if(clockouts[0]){
    var mapProp= {
      center:new google.maps.LatLng(Number(clockouts[0]['lat']),
      Number(clockouts[0]['long'])),
      zoom:10,
    };
    }else{
        var mapProp= {
      center:new google.maps.LatLng(-1.286389,
      36.817223),
      zoom:10,
    };
    //alert("we are here");

    }
    document.addEventListener("DOMContentLoaded", function() {
      
    
   var googleMapsDiv= document.getElementById("googleMapOutlets");


    
    var map = new google.maps.Map(googleMapsDiv,mapProp);
    if(clockouts.length>0){
    var bounds = new google.maps.LatLngBounds();
    
    clockouts.forEach(clockout => {
        var lat1 = Number(clockout['lat']);
        var long1 = Number(clockout['long']);

        const myPosition = { lat: lat1, lng: long1 };
        console.log(myPosition);

        // var markerElement = new google.maps.marker.AdvancedMarkerElement({
        //         position: myPosition,
        //         map: map,
        //         title: 'Visit Marker', // Add a title if needed
        //     });

            // Extend the bounds to include this marker's position
            bounds.extend(myPosition);

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
            var infowindow = new google.maps.InfoWindow({
                content: "<div><h3>Seller: "+( clockout['user']===null ? 'Deleted User': clockout['user']['name'])+"</h3>"+
                    "<p>Latitude: "+lat1+"</p>"+
                    "<p>Longitude: "+long1+"</p>"+
                    "</div>"
            });

            // Add a click event listener to the marker to open the InfoWindow
            // marker.addListener('click', function() {
            //     infoWindow.open(map, marker);
            // });
            
        
       
        var marker = new google.maps.Marker({position: myPosition,
            title: clockout['name'],
        });
        google.maps.event.addListener(marker, 'click', function() {
                infowindow.open(map,marker);
            });
        marker.setMap(map);
        
    });
    map.fitBounds(bounds);
    var lat1 = clockout[0]['lat'];
    var long1 = clockout[0]['long'];
    }

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
    

    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=
    AIzaSyALLsNWwOC09xsRAqrK0S7dINi6BpNc7iw&callback=myMap2"></script> --}}

    
    <script>
        let map;
        let markers = [];  // Store marker references
    
        function myMap2() {
            var clockouts = @json($clockouts);
    
            console.log("clockout 0");
            console.log(clockouts[0]);
            console.log("clockout 0");
    
            var mapProp = {
                center: new google.maps.LatLng(-1.286389, 36.817223),
                zoom: 10,
            };
    
            document.addEventListener("DOMContentLoaded", function() {
                var googleMapsDiv = document.getElementById("googleMapClockouts");
                map = new google.maps.Map(googleMapsDiv, mapProp);
    
                // $('#userFilter').select2();
    
                // Populate user filter dropdown
                // populateUserFilter(visits);
    
                // Initial map update with all visits
                updateMap(clockouts);
    
                $('#userFilter, #outletFilter, #fromDate, #toDate, #fromTime, #toTime').on('change', function() {
                applyFilters(clockouts);
                });
                
    
    
            });
        }
    
        function applyFilters(clockouts) {
    
                    // var selectedOutlet = $('#outletFilter').val();
                    var selectedUser = $('#userFilter').val();
                    var fromDate = $('#fromDate').val();
                    var toDate = $('#toDate').val();
                    var fromTime = $('#fromTime').val();
                    var toTime = $('#toTime').val();

                    
                   // var filteredVisits = selectedUser ? visits.filter(visit => visit.user.name === selectedUser ) : visits;
                    var filteredClockouts = clockouts.filter(clockout => {
                                const userMatches = selectedUser ? clockout.user.name === selectedUser : true;
                                // const outletMatches = selectedOutlet ? outlet.name === selectedOutlet : true;
                                        // Convert visit.created_at to date object
                                var clockoutDate = new Date(clockout.created_at);
    
                                // Filter by date range
                                const fromDateMatches = fromDate ? clockoutDate >= new Date(fromDate) : true;
                                const toDateMatches = toDate ? clockoutDate <= new Date(toDate) : true;

                                // Extract time components from clockinDate
                                var clockoutHours = clockoutDate.getHours();
                                var clockoutMinutes = clockoutDate.getMinutes();

                                // Filter by time range
                                const fromTimeMatches = fromTime ? (clockoutHours * 60 + clockoutMinutes) >= 
                                (parseInt(fromTime.split(':')[0]) * 60 + parseInt(fromTime.split(':')[1])) : true;
                                const toTimeMatches = toTime ? (clockoutHours * 60 + clockoutMinutes) <= 
                                (parseInt(toTime.split(':')[0]) * 60 + parseInt(toTime.split(':')[1])) : true;

                                return userMatches && fromDateMatches && toDateMatches && fromTimeMatches && toTimeMatches;

                                //return userMatches  && fromDateMatches && toDateMatches;

                            });
                            
                    updateMap(filteredClockouts);
    
        }
    
        function populateUserFilter(clockouts) {
            const userFilter = document.getElementById("userFilter");
            const users = [...new Set(clockouts.map(clockout => clockout.user.name))];
    
            // Add an option for 'All Users'
            const allUsersOption = document.createElement('option');
            allUsersOption.value = '';
            allUsersOption.text = 'All Users';
            userFilter.add(allUsersOption);
    
            users.forEach(user => {
                const option = document.createElement('option');
                option.value = user;
                option.text = user;
                userFilter.add(option);
            });
        }
    
        function updateMap(clockouts) {
            clearMarkers();
    
            if (clockouts.length > 0) {
                const bounds = new google.maps.LatLngBounds();
                clockouts.forEach(clockout => {

                    var lat1 = Number(clockout['lat']);
                    var long1 = Number(clockout['long']);
                    const myPosition = { lat: lat1, lng: long1 };
    
    
                    var date = new Date(clockout.created_at);
                    var hours = date.getHours();
                    var minutes = date.getMinutes();
                    var day = date.getDate();
                    var month = date.getMonth() + 1; // Months are zero-based, so add 1
                    var year = date.getFullYear();
    
                    var monthNames = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
    
                    // Get month name from array
                    var monthName = monthNames[month];
    
                    var clockoutDate = day + '-' + monthName + '-' + year;
    
                    // Pad single digit minutes with a leading zero
                    minutes = minutes < 10 ? '0' + minutes : minutes;
    
                    hours = hours < 10 ? '0' + hours : hours;
    
                    var clockoutTime = hours + ':' + minutes;

    
                    const infowindow = new google.maps.InfoWindow({
                        content: "<div><h3>Seller: "+( clockout['user']===null ? 'Deleted User': clockout['user']['name'])+"</h3>"+
                            "<p>Latitude: " + lat1 + "</p>" +
                            "<p>Longitude: " + long1 + "</p>" +
                            "<p><strong>Date: </strong> "+clockoutDate+"</p>"+
                            "<p><strong>Time: </strong> "+clockoutTime+"</p>"+
                            "</div>"
                    });
    
                    var marker = new google.maps.Marker({
                        position: myPosition,
                        title: clockout['name'],
                        label: String(clockout.id),
                        title: clockout.user.name,
                        zIndex: google.maps.Marker.MAX_ZINDEX + Number(clockout.id)
                    });
                    google.maps.event.addListener(marker, 'click', function() {
                        infowindow.open(map, marker);
                    });
                    marker.setMap(map);
    
                    markers.push(marker);  // Add marker to the array
    
                    bounds.extend(myPosition);
                });
    
                map.fitBounds(bounds);
            }
        }
    
        function clearMarkers() {
            markers.forEach(marker => marker.setMap(null));  // Remove each marker from the map
            markers = [];  // Clear the markers array
        }
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyALLsNWwOC09xsRAqrK0S7dINi6BpNc7iw&callback=myMap2" async defer></script>
    



