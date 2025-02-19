@extends('layout-form')

@section('content')

<div class="side-app">

    <!-- CONTAINER -->
    <div class="main-container container-fluid">

  <!-- PAGE-HEADER -->
  <div class="page-header">
    <h1 class="page-title">Followups</h1>
    <div>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">RTMS</a></li>
            <li class="breadcrumb-item active" aria-current="page">Followups</li>
        </ol>
    </div>
</div>
<!-- PAGE-HEADER END -->


<div class="col-xl-12 row">
    <div class="card col-md-8">
        <div class="card-header">
            <h3 class="card-title">Edit Followup</h3> 
        </div>
        <div class="card-body">
            <!--<p>Use <code class="highlighter-rouge">.table-striped</code>to add zebra-striping to any table row within the <code class="highlighter-rouge">.tbody</code>.</p>-->
            
                
                    <form action="/saveeditfollowup/{{$followup['id']}}" method="POST">
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
                                <a href="{{$followup['user']==null?'#': '/editseller/'.$followup['user']['id'] }}">
                                <input type="userName" readonly class="form-control" name="userName" id="userName" placeholder="User Name" 
                                value="{{ $followup['user'] ? $followup['user']['name'] . ($followup['user']->trashed() ? ' (Deleted User)' : '') : 'Deleted User'}}"
                                {{-- value="{{$followup['user']['name']}}"  --}}
                                autocomplete="username">
                                </a>

                                <input type="hidden" readonly class="form-control" name="userId" id="userId" placeholder="User Id" 
                                value="{{ $followup['user'] ? $followup['user']['id']  . ($followup['user']->trashed() ? ' (Deleted User)' : '') : 'Deleted User'}}" 
                                {{-- value="{{$followup['user']['id']}}"  --}}
                                autocomplete="userid">
                            </div>
                            <div class="form-group">
                                <label for="type" class="form-label">Type</label>
                                <input type="text" class="form-control" name="type" id="type" placeholder="Type" value="{{old('type',$followup['type'])}}" autocomplete="type">
                            </div>
                            
                            <div class="form-group">
                                <label for="description" class="form-label">Description</label>
                                <textarea type="text" readonly class="form-control" name="description" placeholder="Description"   autocomplete="description">value="{{old('description',$followup['description'])}}"</textarea>
                            </div>
                            <div class="form-group">
                                <label for="date" class="form-label">Date</label>
                                <input type="text" readonly class="form-control" name="date" placeholder="Date" value="{{old('date',$followup['date'])}}"  autocomplete="date">
                            </div>
                            <div class="form-group">
                                <label for="description" class="form-label">Time</label>
                                <input type="text" readonly class="form-control" name="time" placeholder="Time" value="{{old('time',$followup['time'])}}"  autocomplete="time">
                            </div>
                            
                            @if (auth()->user()->usertype == "admin")
                            <div class="form-group">
                                <label for="team_id" class="form-label">Team</label>
                                <select name="team_id" class="form-control form-select select2" data-bs-placeholder="Select Team">
                                    <option value="0">None</option>
                                    @foreach($teams as $team)
                                    {{-- <option value="{{ $team['id'] }}" {{ old('team_id', '') == $team['id'] ? 'selected' : '' }}>
                                        {{ $team['name'] }}
                                    </option> --}}
                                    <option {{(isset($followup)&&isset($followup['team'])?old('team_id',$followup['team']['id']):old('team_id'))==$team['id']? 'selected':''}}
                                     value="{{$team['id']}}">{{$team['name']}}</option>
                            
                                    @endforeach
                                </select>
                            </div>
                            @endif

                            <div class="form-group">
                                <label for="dateTime" class="form-label">Date and Time Added</label>
                                <input readonly type="text" class="form-control" name="dateTime" id="dateTime" placeholder="DateTime" value="{{date('d-M-Y H:i', strtotime($followup['created_at']))}}" autocomplete="dateTime">
                            </div>

                          

                         



                            
                        </div>
                        <button class="btn btn-primary col-12 mt-4 mb-0">Save</button>
                    </form>
                
            </div>

        </div>
    
    <div class="col-md-3">

        <div class="card" style="width: 18rem;height:95%;background-color:#F7F7F9">
      <div class="card-body">
        <h5 class="card-title">Quick Tips</h5>
        <ol class="card-text">
            {{-- It is readonly and cannot be modified. --}}
            <li style="margin-bottom: 10px;"><strong>Seller Name</strong>: This field displays the name of the seller</li>
            <li style="margin-bottom: 10px;"><strong>Name</strong>: This field displays the name of the customer. It can be edited to update the customer's name.</li>
            <li style="margin-bottom: 10px;"><strong>Contact Person Name</strong>: This field displays the name of the contact person at the customer. It can be edited to update the contact person's name.</li>
            <li style="margin-bottom: 10px;"><strong>Phone</strong>: This field displays the phone number of the customer. It can be edited to update the phone number.</li>
            <li style="margin-bottom: 10px;"><strong>Lat</strong>: This field displays the latitude of the customer's location.</li>
            <li style="margin-bottom: 10px;"><strong>Long</strong>: This field displays the longitude of the customer's location.</li>
            <li style="margin-bottom: 10px;"><strong>Date and Time Added</strong>: This field displays the date and time when the customer was added.</li>
            <li style="margin-bottom: 10px;"><strong>Image (Optional)</strong>: This field displays an image of the customer. </li>
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
        var followup= @json($followup);



    if(followup){
        var mapProp= {
        center:new google.maps.LatLng(Number(followup['lat']),
        Number(followup['long'])),
        zoom:10,
        };
    }else{
        var mapProp= {
        center:new google.maps.LatLng(-1.286389,36.817223),
        zoom:10,
        };
    }

    document.addEventListener("DOMContentLoaded", function() {
    
    var map = new google.maps.Map(document.getElementById("googleMapOutlet"),mapProp);

    var lat1 = Number(followup['lat']);
    var long1 = Number(followup['long']);
    const myPosition = { lat: Number(lat1), lng: Number(long1) };

    var infoWindow = new google.maps.InfoWindow({
                content: "<div><h3>"+followup['name']+"</h3>"+
                    "<p>Contact Person: "+( outlet['user']===null ? 'Deleted User': outlet['user']['name'])+"</p>"+
                    "<p>Contact Phone: "+outlet['phone']+"</p>"+
                    "<p>Latitude: "+lat1+"</p>"+
                    "<p>Longitude: "+long1+"</p>"+
                    "</div>"
            });



    var marker = new google.maps.Marker({position: myPosition,
            title: outlet['name'],
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