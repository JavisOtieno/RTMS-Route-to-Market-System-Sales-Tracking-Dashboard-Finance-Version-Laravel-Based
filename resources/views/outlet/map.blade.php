@extends('layout-form')

@section('content')

<div class="side-app">

    <!-- CONTAINER -->
    <div class="main-container container-fluid">

  <!-- PAGE-HEADER -->
  <div class="page-header">
    <h1 class="page-title">Customers Map</h1>
    <div>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">RTMS</a></li>
            <li class="breadcrumb-item active" aria-current="page">Customers map</li>
        </ol>
    </div>
</div>
<!-- PAGE-HEADER END -->


<div class="col-xl-12">

    <div class="card">
        {{-- <div class="card-header">
            <h3 class="card-title">Outlets Map</h3>
            <a type="button" href="/add-outlet" class="btn btn-danger col-md-3" style="margin-left: auto;margin-right:20px;margin-top:10px;margin-bottom:10px;color:white;">Add Outlet</a>
        </div> --}}

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
                <label for="outletFilter" class="form-label">Customer Name</label>
                <select id="outletFilter"  class="form-control select2-show-search form-select">
                    <!-- Options will be populated dynamically -->
                    <option value="">All Customers</option>
                    @foreach($outlets as $outlet)
                    <option value="{{$outlet['name']}}">{{$outlet['name']}}</option>
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

           
        </div>

        <div class="card-body">
            <div>
                <div id="googleMapOutlets" class="worldh world-map" style="height:80vh"></div>
            </div>
            <div id="paginationLinks" class="mt-3">
                <!-- Pagination links will be dynamically injected here -->
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
        itemDetails.innerHTML = "Customer Id: "+id+"<br/> Customer Name: "+name;
        var confirmDeleteLink = document.getElementById('confirmDelete'); //or grab it by tagname etc
        confirmDeleteLink.href = "/deleteoutlet/"+id;
    }
    function embedMap(lat,long){
        //alert(id);
        var mapEmbedFrame = document.getElementById("mapEmbededForNow");
        mapEmbedFrame.src = "https://maps.google.com/maps?q="+lat+","+long+"&hl=es;z=14&amp&output=embed";
        //var confirmDeleteLink = document.getElementById('confirmDelete'); //or grab it by tagname etc
        //confirmDeleteLink.href = "/deleteoutlet/"+id;
    }
  </script>

  
{{-- <script>
    
    function myMap2() {
        var outlets= @json($outlets);

    if(outlets[0]){
    var mapProp= {
      center:new google.maps.LatLng(Number(outlets[0]['lat']),
      Number(outlets[0]['long'])),
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
    if(outlets.length>0){
    var bounds = new google.maps.LatLngBounds();
    
    outlets.forEach(outlet => {
        var lat1 = Number(outlet['lat']);
        var long1 = Number(outlet['long']);

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
                content: "<div><h3>"+outlet['name']+"</h3>"+
                    "<p>Seller: "+( outlet['user']===null ? 'Deleted User': outlet['user']['name'])+"</p>"+
                    "<p>Latitude: "+lat1+"</p>"+
                    "<p>Longitude: "+long1+"</p>"+
                    "</div>"
            });

            // Add a click event listener to the marker to open the InfoWindow
            // marker.addListener('click', function() {
            //     infoWindow.open(map, marker);
            // });
            
        
       
        var marker = new google.maps.Marker({
            position: myPosition,
            label: String(outlet.id),
            title: outlet.name,
            zIndex: google.maps.Marker.MAX_ZINDEX + Number(outlet.id)
        });
        google.maps.event.addListener(marker, 'click', function() {
                infowindow.open(map,marker);
            });
        marker.setMap(map);
        
    });
    map.fitBounds(bounds);
    var lat1 = outlet[0]['lat'];
    var long1 = outlet[0]['long'];
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
            var outlets = @json($outlets);
    
            console.log("outlets 0");
            console.log(outlets[0]);
            console.log("outlets 0");
    
            var mapProp = {
                center: new google.maps.LatLng(-1.286389, 36.817223),
                zoom: 10,
            };
    
            document.addEventListener("DOMContentLoaded", function() {
                var googleMapsDiv = document.getElementById("googleMapOutlets");
                map = new google.maps.Map(googleMapsDiv, mapProp);
    
                // $('#userFilter').select2();
    
                // Populate user filter dropdown
                // populateUserFilter(visits);
    
                // Initial map update with all visits
                // updateMap(outlets);
                applyFiltersAjax();
    
                $('#userFilter, #outletFilter, #fromDate, #toDate').on('change', function() {
                // applyFilters(outlets);
                applyFiltersAjax();
                });
                
    
    
            });
        }
    
        function applyFilters(outlets) {
    
                    var selectedOutlet = $('#outletFilter').val();
                    var selectedUser = $('#userFilter').val();
                    var fromDate = $('#fromDate').val();
                    var toDate = $('#toDate').val();
                    
                   // var filteredVisits = selectedUser ? visits.filter(visit => visit.user.name === selectedUser ) : visits;
                    var filteredOutlets = outlets.filter(outlet => {
                                const userMatches = selectedUser ? outlet.user.name === selectedUser : true;
                                const outletMatches = selectedOutlet ? outlet.name === selectedOutlet : true;
                                        // Convert visit.created_at to date object
                                var outletDate = new Date(outlet.created_at);
    
                                // Filter by date range
                                const fromDateMatches = fromDate ? outletDate >= new Date(fromDate) : true;
                                const toDateMatches = toDate ? outletDate <= new Date(toDate) : true;
                                return userMatches && outletMatches && fromDateMatches && toDateMatches;
                            });
                            
                    updateMap(filteredOutlets);
    
        }

        function applyFiltersAjax(page=1) {
    // alert('test');
    var selectedOutlet = $('#outletFilter').val();
    var selectedUser = $('#userFilter').val();
    var fromDate = $('#fromDate').val();
    var toDate = $('#toDate').val();

    $.ajax({
        url: '/outlets/filter',  // Backend route
        type: 'GET',
        data: {
            user: selectedUser,
            outlet: selectedOutlet,
            from_date: fromDate,
            to_date: toDate,
            page:page
        },
        success: function(response) {
            updateMap(response.outlets.data);  // Update map with filtered results
            updatePagination(response.outlets);  // Update pagination links

        
        },
        error: function(error) {
            console.error("Error fetching outlets:", error);
        }
    });
}

/**''
 * Updates the pagination links based on the paginated data.
 */
 function updatePagination(outlets) {
    // alert('updating pagination');
    var paginationHtml = '';

    // Only add pagination if there are multiple pages
    if (outlets.total > outlets.per_page) {
        // alert('outlets total > per page');
        paginationHtml += `<ul class="pagination">`;

        // Previous link
        if (outlets.current_page > 1) {
            paginationHtml += `<li class="page-item page-prev">
                <a href="#" class="page-link pagination-link" data-page="${outlets.current_page - 1}">Previous</a>
            </li>`;
        }

        // If there are more than 20 pages, use an ellipsis format.
        if (outlets.last_page > 20) {
            // Always show the first page.
            if (outlets.current_page === 1) {
                paginationHtml += `<li class="page-item active">
                    <a class="page-link pagination-link">1</a>
                </li>`;
            } else {
                paginationHtml += `<li class="page-item">
                    <a href="#" class="page-link pagination-link" data-page="1">1</a>
                </li>`;
            }

            var windowSize = 10; // total number of pages to display in the sliding window (excluding first and last)
            var halfWindow = Math.floor(windowSize / 2);

            // Start and end centered around the current page
            var start = outlets.current_page - halfWindow;
            var end = outlets.current_page + halfWindow;

            // Adjust if the current page is near the beginning
            if (start < 2) {
                end += 2 - start;
                start = 2;
            }

            // Adjust if the current page is near the end
            if (end > outlets.last_page - 1) {
                start -= end - (outlets.last_page - 1);
                end = outlets.last_page - 1;
                
                if (start < 2) {
                    start = 2;
                }
            }


            // Determine a sliding window around the current page.
            // var range = 2; // pages before and after the current page to display
            // var start = Math.max(2, outlets.current_page - range);
            // var end = Math.min(outlets.last_page - 1, outlets.current_page + range);

            // Show ellipsis if there's a gap between page 1 and the start of the window.
            if (start > 2) {
                paginationHtml += `<li class="page-item disabled">
                    <span class="page-link">...</span>
                </li>`;
            }

            // Loop through the sliding window.
            for (var i = start; i <= end; i++) {
                if (i === outlets.current_page) {
                    paginationHtml += `<li class="page-item active">
                        <a class="page-link pagination-link">${i}</a>
                    </li>`;
                } else {
                    paginationHtml += `<li class="page-item">
                        <a href="#" class="page-link pagination-link" data-page="${i}">${i}</a>
                    </li>`;
                }
            }

            // Show ellipsis if there's a gap between the end of the window and the last page.
            if (end < outlets.last_page - 1) {
                paginationHtml += `<li class="page-item disabled">
                    <span class="page-link">...</span>
                </li>`;
            }

            // Always show the last page.
            if (outlets.current_page === outlets.last_page) {
                paginationHtml += `<li class="page-item active">
                    <a class="page-link pagination-link">${outlets.last_page}</a>
                </li>`;
            } else {
                paginationHtml += `<li class="page-item">
                    <a href="#" class="page-link pagination-link" data-page="${outlets.last_page}">${outlets.last_page}</a>
                </li>`;
            }

        } else {
            // For 20 or fewer pages, show all page links.
            for (var i = 1; i <= outlets.last_page; i++) {
                if (i === outlets.current_page) {
                    paginationHtml += `<li class="page-item active">
                        <a class="page-link pagination-link">${i}</a>
                    </li>`;
                } else {
                    paginationHtml += `<li class="page-item">
                        <a href="#" class="page-link pagination-link" data-page="${i}">${i}</a>
                    </li>`;
                }
            }
        }

        // Next link
        if (outlets.current_page < outlets.last_page) {
            paginationHtml += `<li class="page-item page-next">
                <a href="#" class="page-link pagination-link" data-page="${outlets.current_page + 1}">Next</a>
            </li>`;
        }

        paginationHtml += `</ul>`;
    }
    $('#paginationLinks').html(paginationHtml);
}



document.addEventListener('click', function(e) {
  // Check if the clicked element or one of its parents has the class 'pagination-link'
  const paginationLink = e.target.closest('.pagination-link');
  if (paginationLink) {
    e.preventDefault();
    const page = paginationLink.dataset.page; // gets the data-page attribute
    // alert(page);
    applyFiltersAjax(page);
  }
});
    
        function populateUserFilter(outlets) {
            const userFilter = document.getElementById("userFilter");
            const users = [...new Set(outlets.map(outlet => outlet.user.name))];
    
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
    
        function updateMap(outlets) {
            clearMarkers();
    
            if (outlets.length > 0) {
                const bounds = new google.maps.LatLngBounds();
                outlets.forEach(outlet => {
                    var lat1 = Number(outlet['lat']);
                    var long1 = Number(outlet['long']);
                    const myPosition = { lat: lat1, lng: long1 };
    
    
                    var date = new Date(outlet.created_at);
                    var hours = date.getHours();
                    var minutes = date.getMinutes();
                    var day = date.getDate();
                    var month = date.getMonth(); // Months are zero-based, so add 1
                    var year = date.getFullYear();
    
                    var monthNames = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
    
                    // Get month name from array
                    var monthName = monthNames[month];
    
                    var outletDate = day + '-' + monthName + '-' + year;
    
                    // Pad single digit minutes with a leading zero
                    minutes = minutes < 10 ? '0' + minutes : minutes;
    
                    hours = hours < 10 ? '0' + hours : hours;
    
                    var outletTime = hours + ':' + minutes;
    
                    const infowindow = new google.maps.InfoWindow({
                        content: "<div><h3>" + outlet['name'] + "</h3>" +
                            "<p>Seller: " + (outlet.user === null ? 'Deleted User' : outlet.user['name']) + "</p>" +
                            "<p>Latitude: " + lat1 + "</p>" +
                            "<p>Longitude: " + long1 + "</p>" +
                            "<p><strong>Created:</strong> "+outletDate+" "+outletTime+"</p>"+
                            "View: <a target='_blank' href='/editcustomer/" + outlet.id + "'>View Customer Details</a>" +
                        
                            "</div>"
                    });
    
                    var marker = new google.maps.Marker({
                        position: myPosition,
                        title: outlet['name'],
                        label: String(outlet.id),
                        title: outlet.name,
                        zIndex: google.maps.Marker.MAX_ZINDEX + Number(outlet.id)
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
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyALLsNWwOC09xsRAqrK0S7dINi6BpNc7iw&callback=myMap2"></script>
    
    