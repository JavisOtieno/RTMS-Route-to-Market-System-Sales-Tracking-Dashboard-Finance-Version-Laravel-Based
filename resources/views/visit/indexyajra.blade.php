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
                                        <th>View</th>
                                        <th>Seller Name</th>
                                        <th>Customer Name</th>
                                        <th>Contact Name</th>
                                        <th>Phone</th>
                                        <th>Team</th>

                                        <th>Region</th>
                                        <th>Territory</th>
                                        {{-- <th>Cluster</th> --}}
                                        {{-- <th>Channel Type</th> --}}

                                        <th>Date</th>
                                        <th>Check in Time</th>
                                        <th>Check out Time</th>
                                        <th>Duration</th>
                                        <th class="no-export">Map</th>
                                        <th id="delete-column">Check Out</th>
                                        <th>Sales</th>
                                        <th>Followups</th>
                                        <th>Feedback</th>

                                        {{-- <th id="map-column">Map</th> --}}

                                        {{-- <th id="delete-column">Delete</th> --}}
                                    </tr>
                                    <tr>
                                        
                                        <th><input class="form-control" style="width: auto;max-width: 90px;" type="text" placeholder="Search ID" /></th>
                                        <th></th>
                                        <th><input class="form-control" style="width: auto;min-width: max-content;" type="text" placeholder="Search Seller Name" /><span style="display: none">Seller Name</span></th>
                                        <th><input class="form-control" style="width: auto;min-width: max-content;" type="text" placeholder="Seller Customer Name" /><span style="display: none">Customer Name</span></th>
                                        <th><input class="form-control" style="width: auto;min-width: max-content;" type="text" placeholder="Search Contact Name" /><span style="display: none">Contact Name</span></th>
                                        <th><input class="form-control" style="width: auto;min-width: max-content;" type="text" placeholder="Search Phone" /><span style="display: none">Phone</span></th>
                                        <th><input class="form-control" style="width: auto;min-width: max-content;" type="text" placeholder="Search Team" /><span style="display: none">Team</span></th>

                                        
                                        <th><input class="form-control" style="width: auto;min-width: max-content;" type="text" placeholder="Search Region" /><span style="display: none">Region</span></th>
                                        <th><input class="form-control" style="width: auto;min-width: max-content;" type="text" placeholder="Search Territory" /><span style="display: none">Territory</span></th>
                                        {{-- <th><input class="form-control" style="width: auto;min-width: max-content;" type="text" placeholder="Search Cluster" /></th> --}}
                                        {{-- <th><input class="form-control" style="width: auto;min-width: max-content;" type="text" placeholder="Search Channel Type" /></th> --}}
                                        <th><input class="form-control" style="width: auto;min-width: max-content;" type="date" placeholder="Search Date" /><span style="display: none">Date</span></th>
                                        <th><input class="form-control" style="width: auto;min-width: max-content;" type="text" placeholder="Search Checkin Time" /><span style="display: none">Checkin Time</span></th>
                                        <th><input class="form-control" style="width: auto;min-width: max-content;" type="text" placeholder="Search Checkout Time" /><span style="display: none">Checkout Time</span></th>
                                        <th><input class="form-control" style="width: auto;min-width: max-content;" type="text" placeholder="Search Duration" /><span style="display: none">Duration</span></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        {{-- <th></th> <!-- No search input for actions --> --}}
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
            // <button class="btn btn-danger btn-sm delete-btn" data-id="${data.id}"
            //             data-bs-toggle="modal" href="#modalDelete" 
            //             onclick="deleteItem(${data.id} ,'${data.name}')">Delete</button>
            var table = $('#responsive-datatable-yajra').DataTable({
                processing: true,
                serverSide: true,
                // ajax: '{!! route('visitsyajra') !!}',
                ajax: {
                    url: '{!! route('visitsyajra') !!}',
                    type: "GET",  // Ensure it's a GET request
                    data: function(d) {
                        d.from_date = $('#dateFromInput').val();
                        d.to_date = $('#dateToInput').val();
                        d.from_time = $('#timeFromInput').val();
                        d.to_time = $('#timeToInput').val();
                        d.from_duration = $('#durationFromInput').val();
                        d.to_duration = $('#durationToInput').val();
                        d.from_checkouttime = $('#checkouttimeFromInput').val();
                        d.to_checkouttime = $('#checkouttimeToInput').val();
                        // alert(d.from_date);
                        // alert(d.to_date);
                    }
                },
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: null,
                        name: 'actions',
                        render: function(data, type, row) {
                            return `
                        <a class="btn btn-info edit-btn" href="/visit/${data.id}" 
                            data-id="${data.id}">View</a>

                    `;
                        },
                        orderable: false,
                        searchable: false,
                        exportable: false
                    },
                    { data: 'user_name', 
                    name: 'user_name', defaultContent: 'No User' }, // Add this,
                        {
                        data: 'outlet_name',
                        name: 'outlet_name'
                    },
                    {
                        data: 'contactpersonname',
                        name: 'contactpersonname'
                    },
                    {
                        data: 'phone',
                        name: 'phone'
                    },
                    {
                        data: 'team_name',
                        name: 'team_name',defaultContent: 'None' 
                    },
                    {
                        data: 'region_name',
                        name: 'region_name',defaultContent: 'None'
                    },
                    {
                        data: 'territory_name',
                        name: 'territory_name',defaultContent: 'None'
                    },
                    // {
                    //     data: 'cluster_name',
                    //     name: 'cluster_name',defaultContent: 'None'
                    // },
                    // {
                    //     data: 'channel_type_name',
                    //     name: 'channel_type_name',defaultContent: 'None'
                    // },

                    // { data: 'created_at', name: 'date' },
                    {
                        data: 'date',
                        name: 'date',
                        // render: function(data, type, row) {
                        //     // Format the date using JavaScript
                        //     var date = new Date(data);
                        //     var options = {
                        //         year: 'numeric',
                        //         month: 'short',
                        //         day: 'numeric'
                        //     };
                        //     return date.toLocaleDateString('en-GB', options).replace(
                        //         / /g, '-');
                        // }
                    },
                    {
                        data: 'time',
                        name: 'time',
                    },
                    { 
                        data: 'checkouttimeexact',
                        name: 'checkouttimeexact',
                        render: function(data, type, row) {
                            if (data == null || data === '') {
                                return "Not Checked Out"; // If checkouttimeexact is empty or null
                            } else {
                                return data;
                            }
                        }
                    },
                    { 
                        data: 'duration',
                        name: 'duration',
                        render: function(data, type, row) {
                            if (data=="") {
                                return "Not Checked Out"; // If checkout_time is empty
                            }else{
                                return data;
                            }
                        }
                    // render: function(data, type, row) {
                    //     if (!data) {
                    //         return ""; // If checkout_time is empty
                    //     } 
                    //     let createdAt = new Date(row.created_at).getTime();
                    //     let checkoutTime = new Date(row.checkout_time * 1000).getTime()
                    //     let diff = (checkoutTime - createdAt) / 1000; // Convert milliseconds to seconds
                        
                    //     let hours = Math.floor(diff / 3600).toString().padStart(2, '0');
                    //     let minutes = Math.floor((diff % 3600) / 60).toString().padStart(2, '0');
                    //     let seconds = Math.floor(diff % 60).toString().padStart(2, '0');

                    //     return `${hours}:${minutes}:${seconds}`;
                    // }
                    },
                    {
                        data: null,
                        name: 'actions',
                        render: function(data, type, row) {
                            
                            return `

                    <a type="button"
                                 onclick="loadPointOnMap(decodeURIComponent('${encodeURIComponent(JSON.stringify(row))}'))"
                                class="btn btn-success" style="margin-left: auto;color:white;" 
                                data-bs-toggle="modal" href="#largemodal">Map</a>
                        `;
                        },
                        orderable: false,
                        searchable: false,
                        exportable: false
                    },
                    {
                        data: null,
                        name: 'actions',
                        render: function(data, type, row) {
                            let today = new Date().toISOString().split('T')[0]; // Get today's date (YYYY-MM-DD)
                            let createdAt = new Date(data.created_at).toISOString().split('T')[0];

                            // alert(today);
                            // alert(createdAt);
                            // alert('test'+data.checkout_time+'test')
                            
                           if (data.checkouttimeexact !== null ) {
                                return 'Checked out';
                            }
                            else if (data.checkouttimeexact === null && createdAt === today )
                            {
                            return `
                        <a class="btn btn-info edit-btn" href="/checkout/${data.id}" 
                            data-id="${data.id}">Force Checkout</a>

                    `;
                            }else{
                                return 'Not Checked out';
                            }
                        },
                        orderable: false,
                        searchable: false,
                        exportable: false
                    },
                    {
                        data: 'sales_list',
                        name: 'sales_list',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'followups_list',
                        name: 'followups_list',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'feedbacks_list',
                        name: 'feedbacks_list',
                        orderable: false,
                        searchable: false
                    },


                ],
                dom: 'lBfrtip', // This defines the layout of the table controls, including buttons
                buttons: [{
                        extend: 'excelHtml5',
                        text: 'Excel (Page)',
                        // "text": '<button class="btn"><i class="fa fa-file-excel-o" style="color: green;"></i>  Excel</button>',
                        "titleAttr": 'Excel',
                        // "action": newexportaction,
                        // exportOptions: {
                        // columns: function (idx, data, node) {
                        //     return !$(node).hasClass('no-export'); // Still excludes based on class
                        //     }
                        // }
                        // exportOptions = {
                        //     columns: [0, 1, 3] // Only export columns 0, 1, 3, and 4 (zero-based index)
                        // }
                        exportOptions: {
                            columns: ':not(:nth-child(1)), :not(:nth-child(4))' // Exclude first (index 0) and fourth column (index 3)
                        }
                        // title: 'Visits Data', // Optional: Set the title for the exported file
                        // exportOptions: {
                        // modifier: 'page' // This line exports all data
                        
                    },
                    {
                        text: 'Export All to Excel',
                        action: function(e, dt, button, config) {
                            var params = dt.ajax.params();
                            params.dateFrom = $('#dateFromInput').val();
                            params.dateTo = $('#dateToInput').val();
                            params.timeFrom = $('#timeFromInput').val();
                            params.timeTo = $('#timeToInput').val();
                            console.log('DataTable Filters:', params);
                            var url = '{{ route("visits.export") }}?' + $.param(params);
                            window.location.href = url;
                        }
                    },
                    {
                        extend: 'copy',
                        text: 'Copy (Page)',
                        title: 'RTMSExport',
                        // "action": newexportaction
                    },
                    {
                        extend: 'pdf',
                        text: 'PDF (Page)',
                        title: 'RTMS Visits Data', // Optional: Set the title for the exported file
                        // "action": newexportaction
                    },
                    // {
                    //     extend: 'print',
                    //     text: 'Print',
                    //     title: 'RTMS Visits Data', // Optional: Set the title for the printed document
                    //     // "action": newexportaction
                    // },
                    // {
                    //     extend: 'colvis',
                        
                    //     title: 'RTMSExport',
                    // }
                ],
                lengthMenu: [
                    [10, 25, 50, 100],
                    [10, 25, 50, 100]
                ], // Page length options
                pageLength: 10, // Default page length
                order: [
                    [0, 'desc']
                ]
            });

            $('#dateFromInput, #dateToInput,#timeFromInput, #timeToInput,#checkouttimeFromInput, #checkouttimeToInput,#durationFromInput, #durationToInput').on('change', function() {
                table.draw(); // Trigger the custom filter when either date input changes
            });

            table.buttons().container().css({
                "position": "relative",
                "inset-inline-start": "0",
                // "display": "flex",
                // "gap": "5px"
            });
            $('.dataTables_filter')
            .css({
                "display": "inline-block",
                "float": "right",
   
            })
            // if ($(window).width() <= 767) {
            // $('.dataTables_filter')
            //     .css({
            //         "margin": "auto",
            //         // "display": "block",
            //         // "width": "100%"
            //     });
            // }

            // Apply the search
            $('#responsive-datatable-yajra thead tr:eq(1) th').each(function(i) {
                var title = $(this).text();
                // alert('hello');
                $('input', this).on('keyup change', function() {
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
        });



    });


    // function newexportaction(e, dt, button, config) {
    //      var self = this;
    //      var oldStart = dt.settings()[0]._iDisplayStart;
    //      var currentDate = new Date().toISOString().split('T')[0]; // Format: YYYY-MM-DD
    //      var exportTitle = `RTMS Visits Data - ${currentDate}`;
         
    //      dt.one('preXhr', function (e, s, data) {
    //          // Just this once, load all data from the server...
    //          data.start = 0;
    //          data.length = 2147483647;
    //          dt.one('preDraw', function (e, settings) {
    //             // var exportOptions = {
    //             //     columns: ':not(.no-export)' // Exclude columns with class 'no-export'
    //             // };
    //             config.exportOptions = {
    //                 columns: ':not(.no-export)',
    //                 title: exportTitle, // Add title
    //             };
    //              // Call the original action function
    //              if (button[0].className.indexOf('buttons-copy') >= 0) {
    //                  $.fn.dataTable.ext.buttons.copyHtml5.action.call(self, e, dt, button, config);
    //              } else if (button[0].className.indexOf('buttons-excel') >= 0) {
    //                  $.fn.dataTable.ext.buttons.excelHtml5.available(dt, config) ?
    //                      $.fn.dataTable.ext.buttons.excelHtml5.action.call(self, e, dt, button, config) :
    //                      $.fn.dataTable.ext.buttons.excelFlash.action.call(self, e, dt, button, config);
    //              } else if (button[0].className.indexOf('buttons-csv') >= 0) {
    //                  $.fn.dataTable.ext.buttons.csvHtml5.available(dt, config) ?
    //                      $.fn.dataTable.ext.buttons.csvHtml5.action.call(self, e, dt, button, config) :
    //                      $.fn.dataTable.ext.buttons.csvFlash.action.call(self, e, dt, button, config);
    //              } else if (button[0].className.indexOf('buttons-pdf') >= 0) {
    //                  $.fn.dataTable.ext.buttons.pdfHtml5.available(dt, config) ?
    //                      $.fn.dataTable.ext.buttons.pdfHtml5.action.call(self, e, dt, button, config) :
    //                      $.fn.dataTable.ext.buttons.pdfFlash.action.call(self, e, dt, button, config);
    //              } else if (button[0].className.indexOf('buttons-print') >= 0) {
    //                  $.fn.dataTable.ext.buttons.print.action(e, dt, button, config);
    //              }
    //              dt.one('preXhr', function (e, s, data) {
    //                  // DataTables thinks the first item displayed is index 0, but we're not drawing that.
    //                  // Set the property to what it was before exporting.
    //                  settings._iDisplayStart = oldStart;
    //                  data.start = oldStart;
    //              });
    //              // Reload the grid with the original page. Otherwise, API functions like table.cell(this) don't work properly.
    //              setTimeout(dt.ajax.reload, 0);
    //              // Prevent rendering of the full data to the DOM
    //              return false;
    //          });
    //      });
    //      // Requery the server with the new one-time export settings
    //      dt.ajax.reload();
    //  }




</script>
