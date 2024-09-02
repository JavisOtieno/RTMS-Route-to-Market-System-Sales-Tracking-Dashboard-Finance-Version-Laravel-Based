@extends('layout-form')

@section('content')

<div class="side-app">

    <!-- CONTAINER -->
    <div class="main-container container-fluid">

  <!-- PAGE-HEADER -->
  <div class="page-header">
    <h1 class="page-title">Clockins</h1>
    <div>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">RTMS</a></li>
            <li class="breadcrumb-item active" aria-current="page">Clockins</li>
        </ol>
    </div>
</div>
<!-- PAGE-HEADER END -->


<div class="col-xl-12 row">
    <div class="card col-md-8">
        <div class="card-header">
            <h3 class="card-title">View Clockin</h3> 
        </div>
        <div class="card-body">
            <!--<p>Use <code class="highlighter-rouge">.table-striped</code>to add zebra-striping to any table row within the <code class="highlighter-rouge">.tbody</code>.</p>-->
            
                
                    <form action="/saveeditclockin/{{$clockin['id']}}" method="POST">
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
                                <label for="userId" class="form-label">Seller Name</label>
                                <input readonly name="sellerName" class="form-control" name="sellerName" id="sellerName" placeholder="Seller Name" 
                                value="{{ $clockin['user'] ? $clockin['user']['name']  . ($clockin['user']->trashed() ? ' (Deleted User)' : '') : 'Deleted User'}}" 
                                autocomplete="sellerName">
                            </div>
              
                            <div class="form-group">
                                <label for="userId" class="form-label">Latitude</label>
                                <input readonly name="latitude" class="form-control" name="latitude" id="latitude" placeholder="Latitude" value="{{$clockin['lat']}}" autocomplete="sellerName">
                            </div>

                            <div class="form-group">
                                <label for="userId" class="form-label">Longitude</label>
                                <input readonly name="longitude" class="form-control" name="longitude" id="longitude" placeholder="Longitude" value="{{$clockin['long']}}" autocomplete="sellerName">
                            </div>

                            <div class="form-group">
                                <label for="dateTime" class="form-label">Clockin Date and Time</label>
                                <input readonly type="text" class="form-control" name="dateTime" id="dateTime" placeholder="DateTime" value="{{date('d-M-Y H:i', strtotime($clockin['created_at']))}}" autocomplete="dateTime">
                            </div>

                            <div class="form-group">
                                <label for="dateTime" class="form-label">Clockout Date and Time</label>
                                <input readonly type="text" class="form-control" name="dateTime" id="dateTime" placeholder="DateTime" value="{{$clockin['clockout']==""?'Not Clocked Out':date('d-M-Y H:i', strtotime($clockin['clockout']['created_at']))}}" autocomplete="dateTime">
                            </div>

                            <div class="form-group">
                                <label for="clockinActivities" class="form-label">Clockin Visits</label>
                                <a href="/visits/{{$clockin['id']}}/clockin" class="btn btn-info col-md-12 mt-0 mb-2">View Clockin Visits</a>

                                <a href="/sales/{{$clockin['id']}}/clockin" class="btn btn-info col-md-12 mt-0 mb-2">View Clockin Sales</a>
                                <a href="/posaudits/{{$clockin['id']}}/clockin" class="btn btn-info col-md-12 mt-0 mb-2">View Clockin POS Audits</a>
                                <a href="/competitiveanalysis/{{$clockin['id']}}/clockin" class="btn col-md-12 btn-info mt-0 mb-2">View Clockin Competitive Analysis</a>
                                <a href="/feedback/{{$clockin['id']}}/clockin" class="btn btn-info col-md-12 mt-0 mb-2">View Clockin Feedback</a>
                                
                            </div>

                            <div class="form-group">
                                <label for="dateTime" class="form-label">Map</label>
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xxl-12">
                                <div id="googleMapClockin" class="worldh world-map h-400" ></div>
                                </div>
                            </div>
                            
                        </div>
                        {{-- <button class="btn btn-primary mt-4 mb-0">Save</button> --}}
                    </form>
                
            </div>

        </div>
    
    <div class="col-md-3">

        <div class="card" style="width: 18rem;height:95%;background-color:#F7F7F9">
      <div class="card-body">
        <h5 class="card-title">Quick Tips</h5>
        <ol class="card-text">
            <li style="margin-bottom: 10px;"><strong>Seller Name</strong> : This field displays the name of the seller.</li>
            <li style="margin-bottom: 10px;"><strong>Latitude</strong> : This field displays the latitude of the location.</li>
            <li style="margin-bottom: 10px;"><strong>Longitude</strong> : This field displays the longitude of the location.</li>
            <li style="margin-bottom: 10px;"><strong>Date and Time</strong>: This field displays the date and time of the clock-in.</li>
        </ol>

            
</div>
    </div>
    
        </div>
</div>
</div>

    </div>
</div>

@endsection

<script>
    function myMap() {
        var clockin= @json($clockin);

    if(clockin){
        var mapProp= {
        center:new google.maps.LatLng(Number(clockin['lat']),
        Number(clockin['long'])),
        zoom:10,
        };
    }else{
        var mapProp= {
        center:new google.maps.LatLng(-1.286389,36.817223),
        zoom:10,
        };
    }

    document.addEventListener("DOMContentLoaded", function() {
    
    var map = new google.maps.Map(document.getElementById("googleMapClockin"),mapProp);

    var lat1 = Number(clockin['lat']);
    var long1 = Number(clockin['long']);
    const clockinPosition = { lat: Number(lat1), lng: Number(long1) };
    
    var date = new Date(clockin.created_at);
            var hours = date.getHours();
            var minutes = date.getMinutes();

            // Pad single digit minutes with a leading zero
            minutes = minutes < 10 ? '0' + minutes : minutes;

            var clockinTime = hours + ':' + minutes;

    var infoWindow = new google.maps.InfoWindow({
                content: "<div><h3>"+( clockin['user']===null ? 'Deleted User': clockin['user']['name'])+"</h3>"+
                    "<p>Time: "+clockinTime+"</p>"+
                    "<p>Latitude: "+lat1+"</p>"+
                    "<p>Longitude: "+long1+"</p>"+
                    "</div>"
            });



    var marker = new google.maps.Marker({position: clockinPosition,
            title: clockin['user']['name'],
            // label: String(outlet.id),
            // title: outlet.name
        });
        // google.maps.event.addListener(marker, 'click', function() {
        //         infowindow.open(map,marker);
        //     });
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
        marker.setMap(map);

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
    AIzaSyALLsNWwOC09xsRAqrK0S7dINi6BpNc7iw&callback=myMap"></script>