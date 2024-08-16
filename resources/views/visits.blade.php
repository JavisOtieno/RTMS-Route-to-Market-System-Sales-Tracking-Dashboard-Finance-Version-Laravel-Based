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


        <!-- Row -->
        
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Outlet Visits </h3>
                   </div>
                   <div class="row" style="margin: 0 10px;">
                    <input type="hidden" id="tableLoaded" value="visits"/>
                    <h3 class="card-title" style="margin-top:20px;margin-block-end: 0rem;">Search by :</h3>
                    <div class="col-md-3 mb-3">
                        <label for="name" class="form-label">Seller Name</label>
                        <input type="text" class="form-control" id="nameInput" placeholder="Name">
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="outletName" class="form-label">Outlet Name</label>
                        <input type="text" class="form-control" id="outletNameInput" placeholder="Outlet Name">
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="date" class="form-label">From</label>
                        <input type="date" class="form-control" id="dateFromInput" placeholder="Min Date">
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="date" class="form-label">To</label>
                        <input type="date" class="form-control" id="dateToInput" placeholder="Max Date">
                    </div>
                    {{-- <div class="col-md-3 mb-3">
                        <label for="time" class="form-label">Clockin After</label>
                        <input type="time" class="form-control" id="timeInput" placeholder="Time">
                    </div> --}}
                    {{-- <div class="col-md-3 mb-3">
                        <label for="targets" class="form-label">Targets</label>
                        <select class="form-select form-select select2" id="targetsInput">
                            <option value="None">None</option>
                            @foreach($targetgroups as $targetgroup)
                            <option value="{{number_format($targetgroup['amount'])}}">{{$targetgroup['name']." - KSh ".number_format($targetgroup['amount'])}}</option>
                            @endforeach
                        </select>
        
                    </div> --}}
                    
                </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="responsive-datatable" class="table table-bordered text-nowrap border-bottom">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th id="view-column">View</th>
                                        <th>Seller Name</th>
                                        <th>Outlet Name</th>
                                        <th>Date</th>
                                        <th>Check In Time</th>
                                        <th>Check Out Time</th>
                                        <th>Duration<br/>(HH:mm:ss)</th>
                                        <th id="map-column">Map</th>
                                        <th id="delete-column">Check Out</th>
                                        <!--<th>Duration</th>-->
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                        @if(count($visits)>0)
                                        @foreach($visits as $visit)
                                        <tr>
                                        <td>{{$visit['id']}}</td>
                                        <td><a type="button" href="/visit/{{$visit['id']}}" class="btn btn-info" style="margin-left: auto;color:white;">View</a>
                                        </td>
                                        <td>{{ $visit['user'] ? $visit['user']['name']  . ($visit['user']->trashed() ? ' (Deleted User)' : '') : 'Deleted User'}}</td>
                                        <td>{{$visit['outlet']['name']}}</td>
                                        <td>{{date('d-M-Y', strtotime($visit['created_at']))}}</td>
                                        <td>{{date('H:i', strtotime($visit['created_at']))}}</td>
                                        @if($visit['checkout_time']=="")
                                        <td>N/A</td>
                                        @else
                                        <td>{{date('H:i',$visit['checkout_time'])}}</td>
                                        @endif
                                        @if($visit['checkout_time']=="")
                                        <td>{{gmdate("H:i:s", strtotime(0))}}</td>
                                        @else
                                        <td>{{gmdate("H:i:s", $visit['checkout_time']-strtotime($visit['created_at']))}}</td>
                                        
                                        @endif
                                        
                                        {{-- <td>
                                            <form method="POST" action="{{ route('editclockout') }}">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $clockout->id }}">
                                                <!-- Other form fields -->
                                                <button type="submit" class="btn btn-info">View/Edit</button>
                                            </form>
                                        </td> --}}
                                        {{-- <td><a type="button" onclick="embedMap('{{$visit['outlet']['lat']}}','{{$visit['outlet']['long']}}')"
                                            class="btn btn-success" style="margin-left: auto;color:white;" data-bs-toggle="modal" href="#largemodal">Map</a>
                                      </td> --}}
                                      <td><a type="button"
                                        onclick="loadPointOnMap({{ $visit }})"
                                        class="btn btn-success" style="margin-left: auto;color:white;" 
                                        data-bs-toggle="modal" href="#largemodal">Map</a>
                                  </td>
                                  @if($visit['checkout_time']=="")
                                  <td><a type="button" href="/checkout/{{$visit['id']}}" class="btn btn-info" style="margin-left: auto;color:white;">Check Out</a>
                                  </td>
                                  @else
                                  <td>Checked out</td>
                                  @endif
                                        <!--<td>$visit['duration']</td>-->
                                        <!--<a class="modal-effect btn btn-primary-light d-grid mb-3" data-bs-effect="effect-scale" >Scale</a>-->
                                        </tr>
                                        
                                        @endforeach
                                        @else
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
                                            <div id="googleMapVisit" class="worldh world-map h-500" ></div>
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
    function deleteItem(id,name,sku,pieces){
        //alert(id);
        var itemDetails = document.getElementById("itemDetails");
        itemDetails.innerHTML = "Sale Id: "+id+"<br/> Product Name: "+name+"<br/> SKU: "+sku+"<br/> Pieces: "+pieces;
        var confirmDeleteLink = document.getElementById('confirmDelete'); //or grab it by tagname etc
        confirmDeleteLink.href = "/deletesale/"+id;
    }

    // function embedMap(lat,long){
    //     //alert(id);
    //     var mapEmbedFrame = document.getElementById("mapEmbededForNow");
    //     mapEmbedFrame.src = "https://maps.google.com/maps?q="+lat+","+long+"&hl=es;z=14&amp&output=embed";
    //     //var confirmDeleteLink = document.getElementById('confirmDelete'); //or grab it by tagname etc
    //     //confirmDeleteLink.href = "/deletesale/"+id;
    // }
  </script>


<script>
    var map;
    var marker;
    
    function myMap2() {

        var mapProp= {
      center:new google.maps.LatLng(-1.3,
      36.8),
      zoom:10,
    };

    document.addEventListener("DOMContentLoaded", function() {
    
   var googleMapsDiv= document.getElementById("googleMapVisit");
    
    map = new google.maps.Map(googleMapsDiv,mapProp);

            
});


    }


    function loadPointOnMap(visit){
        

        if(marker==undefined){
            // console.log(markers);
            // alert("undefined");
        }else{
                marker.setMap(null);

        }
        

        //waypoints.push({ location: { lat: -1.244, lng: 36.8 }, stopover: true });
        console.log('Map instance:', map);


        //should be google.maps.Marker.MAX_ZINDEX + 1 but we're using 
        //google.maps.Marker.MAX_ZINDEX + itemNumber to overlay multiple on the same for now

        var outletPosition = { lat: parseFloat(visit.outlet.lat), lng: parseFloat(visit.outlet.long) };

            //alert('adding marker');
            marker = new google.maps.Marker({
                position: outletPosition,
                map: map,
                title: visit.outlet.name
            });

            map.setCenter(outletPosition);
            map.setZoom(12);


            //marker.setMap(map);
            var checkoutTime = "";

            if(visit.checkout_time==""){
                checkoutTime="N/A";
                //test
            }else{
            var checkoutDate = new Date(visit.checkout_time * 1000); // Convert to milliseconds
            var checkoutHours = checkoutDate.getHours();
            var minutes = checkoutDate.getMinutes();
            minutes = minutes < 10 ? '0' + minutes : minutes;
            checkoutTime = checkoutHours + ':' + minutes;
            }

            var date = new Date(visit.created_at);
            var hours = date.getHours();
            var minutes = date.getMinutes();
            var day = date.getDate();
            var month = date.getMonth() + 1; // Months are zero-based, so add 1
            var year = date.getFullYear();

            var monthNames = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];

            // Get month name from array
            var monthName = monthNames[month];

            var visitDate = day + '-' + monthName + '-' + year;

            // Pad single digit minutes with a leading zero
            minutes = minutes < 10 ? '0' + minutes : minutes;

            var visitTime = hours + ':' + minutes;

            var infoWindow = new google.maps.InfoWindow({
                content: `
                    <div>
                        <h3>${visit.outlet.name}</h3>
                        <p><strong>Contact Person:</strong> ${visit.outlet.contact_person_name}</p>
                        <p><strong>Phone:</strong> ${visit.outlet.phone}</p>
                        <p><strong>Latitude:</strong> ${visit.outlet.lat}</p>
                        <p><strong>Date:</strong> ${visitDate}</p>
                        <p><strong>Checkin Time:</strong> ${visitTime}</p>
                        <p><strong>Checkout Time:</strong> ${checkoutTime}</p>
                    </div>
                `
            });

            // Open the info window
            infoWindow.open(map,marker);

            //added the toggle functionality here because for this case the map opens up the infoview on load
            marker.addListener('click', function () {

                if (infoWindow) {
                infoWindow.close(); // Close the InfoWindow if it's open
            } else {
                infoWindow.open(map, marker); // Open the InfoWindow if it's closed
            }

                });

            

    }
    

    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=
    AIzaSyALLsNWwOC09xsRAqrK0S7dINi6BpNc7iw&callback=myMap2"></script>



