@extends('layout-form')

@section('content')

<div class="side-app">

    <!-- CONTAINER -->
    <div class="main-container container-fluid">

  <!-- PAGE-HEADER -->
  <div class="page-header">
    <h1 class="page-title">Outlets</h1>
    <div>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">RTMS</a></li>
            <li class="breadcrumb-item active" aria-current="page">Outlets</li>
        </ol>
    </div>
</div>
<!-- PAGE-HEADER END -->


<div class="col-xl-12 row">
    <div class="card col-md-8">
        <div class="card-header">
            <h3 class="card-title">Edit Outlet</h3> 
        </div>
        <div class="card-body">
            <!--<p>Use <code class="highlighter-rouge">.table-striped</code>to add zebra-striping to any table row within the <code class="highlighter-rouge">.tbody</code>.</p>-->
            
                
                    <form action="/saveeditoutlet/{{$outlet['id']}}" method="POST">
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
                                <a href="{{$outlet['user']==null?'#': 'editseller/'.$outlet['user']['id'] }}">
                                <input type="userName" readonly class="form-control" name="userName" id="userName" placeholder="User Name" 
                                value="{{ $outlet['user'] ? $outlet['user']['name'] . ($outlet['user']->trashed() ? ' (Deleted User)' : '') : 'Deleted User'}}"
                                {{-- value="{{$outlet['user']['name']}}"  --}}
                                autocomplete="username">
                                </a>

                                <input type="hidden" readonly class="form-control" name="userId" id="userId" placeholder="User Id" 
                                value="{{ $outlet['user'] ? $outlet['user']['id']  . ($outlet['user']->trashed() ? ' (Deleted User)' : '') : 'Deleted User'}}" 
                                {{-- value="{{$outlet['user']['id']}}"  --}}
                                autocomplete="userid">
                            </div>
                            <div class="form-group">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" name="name" id="name" placeholder="Name" value="{{old('name',$outlet['name'])}}" autocomplete="name">
                            </div>
                            <div class="form-group">
                                <label for="contactPersonName" class="form-label">Contact Person Name</label>
                                <input type="text" class="form-control" name="contactPersonName" id="contactPersonName" placeholder="Contact Person Name" value="{{old('contact_person_name',$outlet['contact_person_name'])}}"  autocomplete="contactPersonNmae">
                            </div>
                            <div class="form-group">
                                <label for="phone" class="form-label">Phone</label>
                                <input type="text" class="form-control" name="phone" placeholder="Phone" value="{{old('phone',$outlet['phone'])}}"  autocomplete="phone">
                            </div>
                            <div class="form-group">
                                <label for="lat" class="form-label">Lat</label>
                                {{-- readonly --}}
                                <input readonly type="text"  class="form-control" name="lat" id="lat" placeholder="Lat" value="{{old('lat',$outlet['lat'])}}"  autocomplete="lat">
                            </div>
                            <div class="form-group">
                                <label for="long" class="form-label">Long</label>
                                {{-- readonly --}}
                                <input readonly ="text" class="form-control" name="long" id="long" placeholder="long" value="{{old('long',$outlet['long'])}}"  autocomplete="long">
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
                                    <option {{(isset($outlet)&&isset($outlet['team'])?old('team_id',$outlet['team']['id']):old('team_id'))==$team['id']? 'selected':''}}
                                     value="{{$team['id']}}">{{$team['name']}}</option>
                            
                                    @endforeach
                                </select>
                            </div>
                            @endif

                            <div class="form-group">
                                <label for="dateTime" class="form-label">Date and Time Added</label>
                                <input readonly type="text" class="form-control" name="dateTime" id="dateTime" placeholder="DateTime" value="{{date('d-M-Y H:i', strtotime($outlet['created_at']))}}" autocomplete="dateTime">
                            </div>

                            <div class="form-group">
                                <label for="outletActivities" class="form-label">Outlet Activities</label>
                                <a href="/visits/{{$outlet['id']}}/outlet" class="btn btn-info col-md-12 mt-0 mb-2">View Outlet Visits</a>
                                <a href="/sales/{{$outlet['id']}}/outlet" class="btn btn-info col-md-12 mt-0 mb-2">View Outlet Sales</a>
                                <a href="/posaudits/{{$outlet['id']}}/outlet" class="btn btn-info col-md-12 mt-0 mb-2">View Outlet POS Audits</a>
                                <a href="/competitiveanalysis/{{$outlet['id']}}/outlet" class="btn col-md-12 btn-info mt-0 mb-2">View Outlet Competitive Analysis</a>
                                <a href="/feedback/{{$outlet['id']}}/outlet" class="btn btn-info col-md-12 mt-0 mb-2">View Outlet Feedback</a>
                            </div>

                            <div class="form-group">

                                <label for="image" class="form-label">Image (Optional)</label>

                                {{-- <div style="margin: auto;" class="col-xl-6 col-lg-3 col-md-4 col-sm-4 col-xxl-2">
                                    <div class="card overflow-hidden">
                                        <a href="#"><img style="width: 100%;" src="{{url('storage/'.$outlet['image'])}}" alt="img" class="file-manager-list w-100"></a>
                                        <div class="card-footer">
                                            <div class="d-flex">
                                                <div class="">
                                                    <h5 class="mb-0 fw-semibold text-break">{{$outlet['name']}}</h5>
                                                </div>
                                                <div class="ms-auto my-auto">
                                                    <!--<span class="text-muted mb-0">66 KB</span>-->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div> --}}

                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xxl-12">
                                    <div class="card overflow-hidden" style="background: #fce9ec;">
                                        <a class="col-xl-7" style="margin: 20px auto">
                                            @if($outlet['image'])
                                            <a href="{{url('showimage/'.$outlet['image'])}}">
                                            <img style="width: 100%;" src="{{url('storage/'.$outlet['image'])}}" alt="img">
                                            </a>
                                            @else
                                            <img style="width: 100%;" src="{{asset('assets/images/new-images/no-image-available.jpg')}}" alt="img">
                                            
                                            @endif
                                        </a>

                                        <div class="card-footer">
                                            <div class="d-flex">
                                                <div class="" style="margin: auto">
                                                    <h5 style="text-align: center" class="mb-0 fw-semibold text-break">{{$outlet['name']}}</h5>
                                                </div>
                                                {{-- <div class="ms-auto my-auto">
                                                    <span class="text-muted mb-0">67 KB</span>
                                                </div> --}}
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="form-group">
                                <label for="dateTime" class="form-label">Map</label>
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xxl-12">
                                <div id="googleMapOutlet" class="worldh world-map h-400" ></div>
                                </div>
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
            <li style="margin-bottom: 10px;"><strong>Name</strong>: This field displays the name of the outlet. It can be edited to update the outlet's name.</li>
            <li style="margin-bottom: 10px;"><strong>Contact Person Name</strong>: This field displays the name of the contact person at the outlet. It can be edited to update the contact person's name.</li>
            <li style="margin-bottom: 10px;"><strong>Phone</strong>: This field displays the phone number of the outlet. It can be edited to update the phone number.</li>
            <li style="margin-bottom: 10px;"><strong>Lat</strong>: This field displays the latitude of the outlet's location.</li>
            <li style="margin-bottom: 10px;"><strong>Long</strong>: This field displays the longitude of the outlet's location.</li>
            <li style="margin-bottom: 10px;"><strong>Date and Time Added</strong>: This field displays the date and time when the outlet was added.</li>
            <li style="margin-bottom: 10px;"><strong>Image (Optional)</strong>: This field displays an image of the outlet. </li>
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
        var outlet= @json($outlet);



    if(outlet){
        var mapProp= {
        center:new google.maps.LatLng(Number(outlet['lat']),
        Number(outlet['long'])),
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

    var lat1 = Number(outlet['lat']);
    var long1 = Number(outlet['long']);
    const myPosition = { lat: Number(lat1), lng: Number(long1) };

    var infoWindow = new google.maps.InfoWindow({
                content: "<div><h3>"+outlet['name']+"</h3>"+
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