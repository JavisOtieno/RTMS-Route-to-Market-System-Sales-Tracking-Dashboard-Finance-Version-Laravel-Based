@extends('layout')

@section('content')

<div class="side-app">

    <!-- CONTAINER -->
    <div class="main-container container-fluid">

  <!-- PAGE-HEADER -->
  <div class="page-header">
    <h1 class="page-title">Clockins Map</h1>
    <div>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">RTMS</a></li>
            <li class="breadcrumb-item active" aria-current="page">Clockins map</li>
        </ol>
    </div>
</div>
<!-- PAGE-HEADER END -->


<div class="col-xl-12">

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Clockins Map</h3>
        </div>
        {{-- <div class="row" style="margin: 0 10px;">
            <input type="hidden" id="tableLoaded" value="outlets"/>
            <h3 class="card-title" style="margin-top:20px;margin-block-end: 0rem;">Search by :</h3>
            <div class="col-md-3 mb-3">
                <label for="nameInput" class="form-label">Outlet Name</label>
                <input type="text" class="form-control" id="nameInput" placeholder="Name">
            </div>
            
            <div class="col-md-3 mb-3">
                <label for="contactNameInput" class="form-label">Contact Name</label>
                <input type="text" class="form-control" id="contactNameInput" placeholder="Contact Name">
            </div>
            <div class="col-md-3 mb-3">
                <label for="phone" class="form-label">Phone</label>
                <input type="tel" class="form-control" id="phoneInput" placeholder="Phone">
            </div>
           
        </div> --}}
        <div class="card-body">
            <div class="table-responsive">
                <div id="googleMapOutlets" class="worldh world-map h-500" ></div>
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

  
<script>
    
    function myMap2() {
        var clockins= @json($clockins);

    if(clockins[0]){
    var mapProp= {
      center:new google.maps.LatLng(Number(clockins[0]['lat']),
      Number(clockins[0]['long'])),
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
    if(clockins.length>0){
    var bounds = new google.maps.LatLngBounds();
    
    clockins.forEach(clockin => {
        var lat1 = Number(clockin['lat']);
        var long1 = Number(clockin['long']);

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
                content: "<div><h3>Seller: "+( clockin['user']===null ? 'Deleted User': clockin['user']['name'])+"</h3>"+
                    "<p>Latitude: "+lat1+"</p>"+
                    "<p>Longitude: "+long1+"</p>"+
                    "</div>"
            });

            // Add a click event listener to the marker to open the InfoWindow
            // marker.addListener('click', function() {
            //     infoWindow.open(map, marker);
            // });
            
        
       
        var marker = new google.maps.Marker({position: myPosition,
            title: clockin['name'],
        });
        google.maps.event.addListener(marker, 'click', function() {
                infowindow.open(map,marker);
            });
        marker.setMap(map);
        
    });
    map.fitBounds(bounds);
    var lat1 = clockin[0]['lat'];
    var long1 = clockin[0]['long'];
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
    AIzaSyALLsNWwOC09xsRAqrK0S7dINi6BpNc7iw&callback=myMap2"></script>

