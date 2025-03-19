@extends('layout')

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


<div class="col-xl-12">

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Outlets</h3>
            <a type="button" href="/add-outlet" class="btn btn-danger col-md-3" style="margin-left: auto;margin-right:20px;margin-top:10px;margin-bottom:10px;color:white;">Add Outlet</a>
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
                <label for="date" class="form-label">From</label>
                <input type="date" class="form-control" id="dateFromInput" placeholder="Min Date">
            </div>

            <div class="col-md-3 mb-3">
                <label for="date" class="form-label">To</label>
                <input type="date" class="form-control" id="dateToInput" placeholder="Max Date">
            </div>
   
           
        </div> --}}
        <div class="card-body">
            <div class="table-responsive">
                <table id="responsive-datatable-yajra" class="table table-bordered text-nowrap border-bottom">
                    <thead>
                        <tr>
                            <th>ID</th>
                            {{-- <th>View/Edit</th> --}}
                            <th>Actions</th>
                            <th>Name</th>
                            <th>Contact Name</th>
                            <th>Phone</th>
                            <th>Date</th>
                            
                            {{-- <th id="map-column">Map</th> --}}
                            
                            {{-- <th id="delete-column">Delete</th> --}}
                        </tr>
                        <tr>
                            <th><input type="text" placeholder="Search ID" /></th>
                            <th><input type="text" placeholder="Search Actions" /></th>
                            <th><input type="text" placeholder="Search Name" /></th>
                            <th><input type="text" placeholder="Search Contact Name" /></th>
                            <th><input type="text" placeholder="Search Phone" /></th>
                            <th><input type="text" placeholder="Search Date" /></th>
                            <th></th> <!-- No search input for actions -->
                        </tr>
                    </thead>

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
                                        <div id="googleMapOutlet" class="worldh world-map h-500" ></div>
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
    var map;
    var marker;
    
    function myMap2() {

        var mapProp= {
      center:new google.maps.LatLng(-1.3,
      36.8),
      zoom:10,
    };

    document.addEventListener("DOMContentLoaded", function() {
    
   var googleMapsDiv= document.getElementById("googleMapOutlet");
    
    map = new google.maps.Map(googleMapsDiv,mapProp);

            
});


    }


    function loadPointOnMap(outlet){
        

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

        var outletPosition = { lat: parseFloat(outlet.lat), lng: parseFloat(outlet.long) };

            //alert('adding marker');
            marker = new google.maps.Marker({
                position: outletPosition,
                map: map,
                title: outlet.name
            });

            map.setCenter(outletPosition);
            map.setZoom(12);


            //marker.setMap(map);
            var placeholderImage = "/assets/images/new-images/no-image-available.jpg";
            var outletImage = outlet.image ? outlet.image : placeholderImage;

            var infoWindow = new google.maps.InfoWindow({
                content: `
                    <div>
                        <h3>${outlet.name}</h3>
                        <p><strong>Contact Person:</strong> ${outlet.contact_person_name}</p>
                        <p><strong>Phone:</strong> ${outlet.phone}</p>
                        <p><strong>Latitude:</strong> ${outlet.lat}</p>
                        <p><strong>Longitude:</strong> ${outlet.long}</p>
                        <img 
                        src="${outletImage}" 
                        alt="${outlet.name}" 
                        onerror="this.onerror=null;this.src='/assets/default-images/no_image_available.jpg';"
                        style="width:100px;height:auto;"/>
                    </div>
                `
            });
            

            // Open the info window
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
        ajax: '{!! route('yajratestoutlets') !!}',
        columns: [
            { data: 'id', name: 'id' },
                        {
                data: null,
                name: 'actions',
                render: function(data, type, row) {
                    return `
                        <a class="btn btn-info btn-sm edit-btn" href="/editoutlet/${data.id}" 
                            data-id="${data.id}">Edit</a>
                        <button class="btn btn-danger btn-sm delete-btn" data-id="${data.id}"
                        data-bs-toggle="modal" href="#modalDelete" 
                        onclick="deleteItem(${data.id} ,'${data.name}')">Delete</button>
                    `;
                },
                orderable: false,
                searchable: false
            },
            { data: 'name', name: 'name' },
            { data: 'contact_person_name', name: 'contact_person_name' },
            { data: 'phone', name: 'phone' },
            // { data: 'created_at', name: 'date' },
            {
                data: 'created_at',
                name: 'created_at',
                render: function(data, type, row) {
                    // Format the date using JavaScript
                    var date = new Date(data);
                    var options = { year: 'numeric', month: 'short', day: 'numeric' };
                    return date.toLocaleDateString('en-GB', options).replace(/ /g, '-');
                }
            }

            
            
        ],
        dom: 'lBfrtip', // This defines the layout of the table controls, including buttons
    buttons: [
        {
            extend: 'excelHtml5',
            text: 'Excel',
            title: 'Outlets Data' // Optional: Set the title for the exported file
        },
        {
            extend: 'copy',
            text: 'Copy',
            title: 'RTMSExport',
        },
        {
            extend: 'pdf',
            text: 'PDF',
            title: 'Outlets Data' // Optional: Set the title for the exported file
        },
        {
            extend: 'print',
            text: 'Print',
            title: 'Outlets Data' // Optional: Set the title for the printed document
        },
        {
            extend: 'colvis',
            title: 'RTMSExport',
        }
    ],
            lengthMenu: [ [10, 25, 50, 100],[10, 25, 50, 100] ], // Page length options
        pageLength: 10, // Default page length
        order: [[0, 'desc']]
    });

        // Apply the search
    $('#responsive-datatable-yajra thead tr:eq(1) th').each(function (i) {
        var title = $(this).text();
        // alert('hello');
        $('input', this).on('keyup change', function () {
            // alert(this.value+' '+i);
            if (table.column(i).search() !== this.value) {
                // alert('hello');
                table
                    .column(i)
                    .search(this.value)
                    .draw();
            }
            // Apply descending order based on id after search
            table.order([0, 'desc']).draw();
        });
    });

    $('.dt-buttons .dt-button').css({
        'background-color': '#28a745',
        'color': '#fff',
        'border-radius': '5px'
    });

    

});





        });
</script>
