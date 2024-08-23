
@extends('layout-form')

<style>


/* style.css */
/* body {
    font-family: Arial, sans-serif;
} */
 
.sortable-list {
    margin: 0 auto 0 0;
    /*chatgpt overflow-y scroll google auto*/
    /* overflow-y: scroll; */
    overflow: auto;
    
}
 
.sortable {
    list-style-type: none;
    padding: 0;
 
}
 
.list-item {
    background-color: #f0f0f0;
    padding: 10px;
    margin: 5px;
    cursor: move;
}

</style>


@section('content')



<div class="side-app">

    <!-- CONTAINER -->
    <div class="main-container container-fluid">

  <!-- PAGE-HEADER -->
  <div class="page-header">
    <h1 class="page-title">Create Route Plan Stage II</h1>
    <div>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">RTMS</a></li>
            <li class="breadcrumb-item active" aria-current="page">Create Route Plan Stage II</li>
        </ol>
    </div>
</div>
<!-- PAGE-HEADER END -->


<div class="col-xl-12 row">
    <div class="card col-md-8">
        <div class="card-header">
            <h3 class="card-title">Final Stage</h3> 
        </div>
        <div class="card-body">
            <!--<p>Use <code class="highlighter-rouge">.table-striped</code>to add zebra-striping to any table row within the <code class="highlighter-rouge">.tbody</code>.</p>-->
            
                
                    <form action="/saverouteplan" method="POST">
                        @csrf
                        @method('POST')
                        <div class="">

                            @if ($errors->any())
                            <div class="alert alert-danger alert-dismissible">
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>
                                            @if ($error == 'Any special error')
                                            Any special error
                                            @else
                                            {{ $error }}
                                            @endif
                                            </li>
                                    @endforeach
                                </ul>
                            </div>
                            @endif

                        <div class="form-group">
                            <label for="name" class="form-label">Route Plan Name (Optional)</label>
                            <input type="name" class="form-control" name="name" id="name" placeholder="Name" value="{{old('name')}}" autocomplete="name">
                        </div>

                        <div class="sortable-list">
                            <label for="password" class="form-label">Order Outlets</label>
                            <ul id="sortable">
                                @foreach ($outletArray as $outlet)
                                <li class="list-item" draggable="true" data-id="{{$outlet['id']}}">{{$outlet['name']}}</li>
                                @endforeach
                                <!-- Add more list items as needed -->
                            </ul>
                        </div>

                        <button type="button" 
                        onclick="displayCurrentRouteMap()"
                        class="btn btn-info ml-2 mr-2 mt-2 mb-2 col-12" 
                        data-bs-toggle="modal" href="#largemodal"
                        >Preview Route Plan</button>

                            {{-- <div class="form-group">
                                <label for="password" class="form-label">Outlet Ids</label> --}}
                                {{-- <input  name="order" id="order"> --}}
                                <input type="hidden" class="form-control" name="outletIds" id="outletIds" placeholder="outlet ids" autocomplete="outletIds" value="{{$outletString}}">
                            {{-- </div> --}}

                            {{-- <div class="form-group">
                                <label for="password" class="form-label">User Id</label> --}}
                                {{-- <input  name="order" id="order"> --}}
                                <input type="hidden" class="form-control" name="user_id" id="user_id" placeholder="User Id" autocomplete="User Id" value="{{$user_id}}">
                            {{-- </div> --}}

                            <div class="form-group">
                                <label for="date" class="form-label">Date</label>
                                {{-- <input  name="order" id="order"> --}}
                                <input type="date" class="form-control" name="date" id="date" placeholder="date" autocomplete="date" value="{{old('date')}}"/>
                            </div>
                            
                            
                        </div>
                        <button class="btn btn-primary mt-4 mb-0">Save</button>
                    </form>
                
            </div>

        </div>
    
    <div class="col-md-3">

        <div class="card" style="width: 18rem;height:95%;background-color:#F7F7F9">
      <div class="card-body">
        <h5 class="card-title">Quick Tips</h5>
        <p class="card-text">This is the quick tips section. Expect highlights on how best to use the system.</p>
      </div>
    </div>
    
        </div>
</div>
</div>

    </div>
</div>

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

document.addEventListener('DOMContentLoaded', function() {
        // Get today's date
        let today = new Date();
        
        // Set tomorrow's date
        let tomorrow = new Date(today);
        tomorrow.setDate(tomorrow.getDate() + 1);
        
        // Format date as YYYY-MM-DD (required by input type=date)
        let tomorrowFormatted = tomorrow.toISOString().split('T')[0];
        
        // Set the input value to tomorrow's date
        document.getElementById('date').value = tomorrowFormatted;
    });

    document.addEventListener("DOMContentLoaded", function() {
        $(function() {
    //         $("#sortable").sortable({
    //             helper: "clone", // Optional: to improve the dragging experience
    //             scroll: true,
    //             start: function(event, ui) {
    //                 ui.helper.css('position', 'absolute').css('z-index', '1000');
    //             },
    //             drag: function(event, ui) {
    //                 ui.helper.css('top', event.pageY + 'px');
    //                 ui.helper.css('left', event.pageX + 'px');
    //             }
    //         });

            

            $("#sortable").sortable({
                start: function(event, ui) {
                    console.log("Dragging started on item: ", ui.item.index());
                },
                stop: function(event, ui) {
                    // alert("Dragging stopped on item: ", ui.item.index());
                    var order = $("#sortable").sortable("toArray", { attribute: "data-id" });
                    //alert(order);
                    //alert(order.join(","));
                    //document.getElementById('order').value = order.join(',');
                    $("#outletIds").val(order.join(","));

                },
                sort: function(event, ui) {
                    console.log("Item is being dragged");
                }
        });

            $("#sortable").disableSelection();
            
            $("#sortableForm").on("submit", function(event) {
                var order = $("#sortable").sortable("toArray", { attribute: "data-id" });
                $("#outletIds").val(order.join(","));
            });
        });


const sortableList =
    document.getElementById("sortable");
let draggedItem = null;
 
sortableList.addEventListener(
    "dragstart",
    (e) => {
        draggedItem = e.target;
        setTimeout(() => {
            e.target.style.display =
                "none";
        }, 0);
        alert("start");
});
 
sortableList.addEventListener(
    "dragend",
    (e) => {
        setTimeout(() => {
            e.target.style.display = "";
            draggedItem = null;
        }, 0);
        alert("end");
});
 
sortableList.addEventListener(
    "dragover",
    (e) => {
        e.preventDefault();
        const afterElement =
            getDragAfterElement(
                sortableList,
                e.clientY);
        const currentElement =
            document.querySelector(
                ".dragging");
        if (afterElement == null) {
            sortableList.appendChild(
                draggedItem
            );} 
        else {
            sortableList.insertBefore(
                draggedItem,
                afterElement
            );}
            alert("over");
    });
 
const getDragAfterElement = (
    container, y
) => {
    const draggableElements = [
        ...container.querySelectorAll(
            "li:not(.dragging)"
        ),];
 
    return draggableElements.reduce(
        (closest, child) => {
            const box =
                child.getBoundingClientRect();
            const offset =
                y - box.top - box.height / 2;
            if (
                offset < 0 &&
                offset > closest.offset) {
                return {
                    offset: offset,
                    element: child,
                };} 
            else {
                return closest;
            }},
        {
            offset: Number.NEGATIVE_INFINITY,
        }
    ).element;
    alert("not sure");
};


    });
    </script>



<script>
    var map;
    var outlets
    
    function myMap2() {
    outlets= @json($outletArray);

    if(outlets[0]){
    var mapProp= {
      center:new google.maps.LatLng(Number(outlets[0].lat),
      Number(outlets[0].long)),
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

    function displayCurrentRouteMap(){
        console.log(outlets);
        
        //alert('we get here');
        //alert (routeplan['routeplanitems'][0]['outlet']['lat']);
        
        //console.log(routeplan);
        waypoints=[];
        if(markers==undefined){
            // console.log(markers);
            //  alert("undefined");
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

        var order = document.getElementById('outletIds').value;

        //alert(order);
        let orderArray = order.split(",");
        //console.log("Outlets");
        //console.log(outlets);
        //console.log("Outlets");
        var newOutletsOrderedArray=[]

        orderArray.forEach(orderItem => {
            var orderItemNumber=Number(orderItem);
            var outlet = outlets.find(outlet => outlet.id === orderItemNumber);
            // console.log("OutletTest");
            // console.log(outlet);
            // console.log("OutletTest");
            // alert(outlet.name)
            newOutletsOrderedArray.push(outlet);
            waypoints.push({ location: { lat: Number(outlet.lat), 
                lng: Number(outlet.long) }, stopover: true });


        }
        );

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

        var bounds = new google.maps.LatLngBounds();
        addMarkers(map,newOutletsOrderedArray,bounds);
        map.fitBounds(bounds);

        directionsService.route(request, function(result, status) {
            if (status == 'OK') {

                // prevents map from ignoring markers and focusing on route
                // especially for close markers
                // directionsRenderer.setOptions({ preserveViewport: true });

                // directionsRenderer.setDirections(result);
                // console.log('Route drawn with result:', result);

                const route = result.routes[0];
                let totalDistance = 0;

                // Loop through each leg to calculate the total distance
                route.legs.forEach(leg => {
                    totalDistance += leg.distance.value; // distance.value is in meters
                });

                if (totalDistance < 50) {
                    console.log('Route is less than 50 meters, not drawing directions.');

                } else {
                    directionsRenderer.setDirections(result);
                    console.log('Route drawn with result:', result);
                }
                
                // var bounds = new google.maps.LatLngBounds();
                // addMarkers(map,newOutletsOrderedArray);
                // map.fitBounds(bounds);

            } else {

                directionsRenderer.setDirections(result);
                console.error('Directions request failed due to ' + status);

            }
        });

        

    
        function addMarkers(map, outlets,bounds) {
            var itemNumber = 1;
            outlets.forEach(outlet => {
                //alert('adding marker');
                var marker = new google.maps.Marker({
                    position: { lat: parseFloat(outlet.lat), lng: parseFloat(outlet.long) },
                    map: map,
                    label: String(itemNumber),
                    title: outlet.name,
                    zIndex: google.maps.Marker.MAX_ZINDEX + 1 
                });
                itemNumber++;

                if(bounds!=undefined){
                const outletPosition = { lat: parseFloat(outlet.lat), lng: parseFloat(outlet.long) };
                console.log(outletPosition);
                // Extend the bounds to include this marker's position
                bounds.extend(outletPosition);
                }

                //marker.setMap(map);

                var infoWindow = new google.maps.InfoWindow({
                    content: `
                        <div>
                            <h3>${outlet.name}</h3>
                            <p><strong>Contact Person:</strong> ${outlet.contact_person_name}</p>
                            <p><strong>Phone:</strong> ${outlet.phone}</p>
                            <p><strong>Latitude:</strong> ${outlet.lat}</p>
                            <p><strong>Longitude:</strong> ${outlet.long}</p>
                            <img src="${outlet.image}" alt="${outlet.name}" style="width:100px;height:auto;"/>
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