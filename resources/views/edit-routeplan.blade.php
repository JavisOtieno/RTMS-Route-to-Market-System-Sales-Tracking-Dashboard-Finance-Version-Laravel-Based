
@extends('layout-form')

<style>


/* style.css */
/* body {
    font-family: Arial, sans-serif;
} */
 
.sortable-list {
    margin: 0 auto 0 0;
}
 
.sortable {
    list-style-type: none;
    padding: 0;
}
 
.list-item {
    background-color: #f0f0f0;
    padding: 10px;
    margin: 5px;
    cursor: grab;
}

</style>


@section('content')



<div class="side-app">

    <!-- CONTAINER -->
    <div class="main-container container-fluid">

  <!-- PAGE-HEADER -->
  <div class="page-header">
    <h1 class="page-title">Edit Route Plan</h1>
    <div>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">RTMS</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit Route Plan</li>
        </ol>
    </div>
</div>
<!-- PAGE-HEADER END -->


<div class="col-xl-12 row">
    <div class="card col-md-8">
        <div class="card-header">
            <h3 class="card-title">Edit Route Plan</h3> 
        </div>
        <div class="card-body">
            <!--<p>Use <code class="highlighter-rouge">.table-striped</code>to add zebra-striping to any table row within the <code class="highlighter-rouge">.tbody</code>.</p>-->
            
                
                    <form action="/saveeditrouteplan/{{$routeplan['id']}}" method="POST">
                        @csrf
                        @method('PUT')
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
                            <label for="name" class="form-label">Route Plan Name </label>
                            <input readonly type="name" class="form-control" name="name" id="name" placeholder="Name" value="{{$routeplan['name']}}" autocomplete="name">
                        </div>

                        <div class="form-group">
                            <label for="userId" class="form-label">Seller Name</label>
                            <input readonly name="sellerName" class="form-control" name="sellerName" id="sellerName" placeholder="Seller Name" 
                            value="{{ $routeplan['user'] ? $routeplan['user']['name']  . ($routeplan['user']->trashed() ? ' (Deleted User)' : '') : 'Deleted User'}}" 
                            autocomplete="sellerName">
                        </div>

                        <div class="form-group">
                            <label for="dateTime" class="form-label">Date and Time Added</label>
                            <input readonly type="text" class="form-control" name="dateTime" id="dateTime" placeholder="DateTime" value="{{date('d-M-Y H:i', strtotime($routeplan['created_at']))}}" autocomplete="dateTime">
                        </div>

                        <div class="form-group">
                            <label for="scheduledDate" class="form-label">Scheduled Date</label>
                            <input type="date" class="form-control" name="date" id="date" placeholder="Date" value="{{$routeplan['date']}}" autocomplete="date">
                        </div>

                        <div class="form-group">
                            <label for="productNames" style="font-weight:bold;margin-bottom: 1.5rem;"  class="form-label">Outlets in order</label>
                            <!--<input readonly type="text" class="form-control" name="productNames" id="productNames" placeholder="Products"  autocomplete="products">-->
                            {{-- <div class="row mb-4">
                                <label style="font-weight:bold;" for="productName" class="col-md-6 form-label">Product Name</label>
                                <label style="font-weight:bold;" for="productPieces" class="col-md-6 form-label">Pieces</label>                                    
                            </div> --}}
                            <ol>
                            @foreach($routeplan['routeplanitems'] as $routeplanitem)
                            <div class="row mb-4">
                                {{-- <label style="font-weight:400;" for="planOutlet" class="col-md-1 form-label">
                                    {{$posaudititem['product']['name']}}
                                </label> --}}
                                <div class="col-md-12">
                                    <li>
                                    <input readonly type="text" class="form-control" id="outletName" placeholder="Outlet Name" autocomplete="outletname" 
                                    value="{{$routeplanitem['outlet'] ? $routeplanitem['outlet']['name']  . ($routeplanitem['outlet']->trashed() ? ' (Deleted Outlet)' : '') : 'Deleted Outlet'}} {{$routeplanitem['visit_id']?' - Visited ':''}}"
                                    >
                                    </li>
                                </div>
                            </div>
                            @endforeach
                            </ol>

                        </div>

                        <div class="form-group">
                            <label for="dateTime" class="form-label">Map</label>
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xxl-12">
                            <div id="googleMapRouteplan" class="worldh world-map h-400" ></div>
                            </div>
                        </div>



                        {{-- <div class="sortable-list">
                            <label for="password" class="form-label">Order Outlets</label>
                            <ul id="sortable">
                                @foreach ($outletArray as $outlet)
                                <li class="list-item" draggable="true" data-id="{{$outlet['id']}}">{{$outlet['name']}}</li>
                                @endforeach
                                <!-- Add more list items as needed -->
                            </ul>
                        </div> --}}


                            {{-- <div class="form-group">
                                <label for="password" class="form-label">Hidden</label>
                                
                                <input type="text" class="form-control" name="outletIds" id="outletIds" placeholder="outletIds" autocomplete="outletIds" value="{{$outletString}}">
                            </div> --}}
                            
                            
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

@endsection

{{-- <script>
    document.addEventListener("DOMContentLoaded", function() {
        $(function() {
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
    </script> --}}


<script>
    function myMap() {
        var routeplan= @json($routeplan);

        if(routeplan && routeplan['routeplanitems'] && 
     routeplan['routeplanitems'] && 
     routeplan['routeplanitems']['outlet'] 
    != null){
    var mapProp= {
      center:new google.maps.LatLng(Number(routeplan[0]['routeplanitems'][0]['outlet']['lat']),
      Number(routeplan['routeplanitems']['outlet']['long'])),
      zoom:10,
    };
    // alert("working well");
    }
      else{
        var mapProp= {
        center:new google.maps.LatLng(-1.286389,36.817223),
        zoom:10,
        };
    }

    document.addEventListener("DOMContentLoaded", function() {

    var markers = [];
    var waypoints=[];

    routeplan.routeplanitems.forEach(routeplanitem => {
            console.log(routeplanitem);
            // Accessing outlet details
            console.log(routeplanitem.outlet);
            waypoints.push({ location: { lat: Number(routeplanitem.outlet.lat), lng: Number(routeplanitem.outlet.long) }, stopover: true });
        });
    
    var map = new google.maps.Map(document.getElementById("googleMapRouteplan"),mapProp);

    if(routeplan.routeplanitems.length==1){
            const origin = waypoints.shift().location;

            var bounds = new google.maps.LatLngBounds();
                addMarkers(map,routeplan.routeplanitems,bounds);
                map.fitBounds(bounds);

                //alert('we are here');

        }else{
            //alert('yeah');
            const origin = waypoints.shift().location;
            const destination = waypoints.pop().location;

            const request = {
                origin: origin,
                destination: destination,
                waypoints: waypoints,
                optimizeWaypoints: true,
                travelMode: 'DRIVING'
            };

            var directionsService = new google.maps.DirectionsService();
            var directionsRenderer = new google.maps.DirectionsRenderer();
            directionsRenderer.setMap(map);

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
                    addMarkers(map,routeplan.routeplanitems,bounds);
                    map.fitBounds(bounds);
                } else {
                    directionsRenderer.setDirections(result);
                    console.log('Route drawn with result:', result);
                    addMarkers(map,routeplan.routeplanitems);
                }

            } else {
                console.error('Directions request failed due to ' + status);
                 var bounds = new google.maps.LatLngBounds();
                addMarkers(map,routeplan.routeplanitems,bounds);
                map.fitBounds(bounds);
            }
        });

        }


        function addMarkers(map, routeplanitems,bounds) {
            var itemNumber = 1;

            //should be google.maps.Marker.MAX_ZINDEX + 1 but we're using 
            //google.maps.Marker.MAX_ZINDEX + itemNumber to overlay multiple on the same for now

            routeplanitems.forEach(item => {
                //alert('adding marker');
                var marker = new google.maps.Marker({
                    position: { lat: parseFloat(item.outlet.lat), lng: parseFloat(item.outlet.long) },
                    map: map,
                    label: String(itemNumber),
                    title: item.outlet.name,
                    zIndex: google.maps.Marker.MAX_ZINDEX + itemNumber
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

    });




    }




    

    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=
    AIzaSyALLsNWwOC09xsRAqrK0S7dINi6BpNc7iw&callback=myMap"></script>