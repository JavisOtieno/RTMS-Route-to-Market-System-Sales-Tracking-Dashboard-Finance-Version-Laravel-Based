@extends('layout-form')

@section('content')

<div class="side-app">

    <!-- CONTAINER -->
    <div class="main-container container-fluid">

  <!-- PAGE-HEADER -->
  <div class="page-header">
    <h1 class="page-title">Sales Map</h1>
    <div>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">RTMS</a></li>
            <li class="breadcrumb-item active" aria-current="page">Sales map</li>
        </ol>
    </div>
</div>
<!-- PAGE-HEADER END -->


<div class="col-xl-12">

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Sales Map</h3>
            {{-- <a type="button" href="/add-sale" class="btn btn-danger col-md-3" style="margin-left: auto;margin-right:20px;margin-top:10px;margin-bottom:10px;color:white;">Add Outlet</a> --}}
        </div>
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
                <label for="outletFilter" class="form-label">Outlet Name</label>
                <select id="outletFilter"  class="form-control select2-show-search form-select">
                    <!-- Options will be populated dynamically -->
                    <option value="">All Outlets</option>
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
            <div class="table-responsive">
                <div id="googleMapSales" class="worldh world-map" style="height:80vh" ></div>
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
    let map;
    let markers = [];  // Store marker references

    function myMap2() {
        var sales = @json($sales);

        console.log("sales 0");
        console.log(sales[0]);
        console.log("sales 0");

        var mapProp = {
            center: new google.maps.LatLng(-1.286389, 36.817223),
            zoom: 10,
        };

        document.addEventListener("DOMContentLoaded", function() {
            var googleMapsDiv = document.getElementById("googleMapSales");
            map = new google.maps.Map(googleMapsDiv, mapProp);

            // $('#userFilter').select2();

            // Populate user filter dropdown
            // populateUserFilter(sales);

            // Initial map update with all sales
            // updateMap(sales);
            applyFiltersAjax();

            $('#userFilter, #outletFilter, #fromDate, #toDate').on('change', function() {
            // applyFilters(sales);
            applyFiltersAjax();
            });
            


        });
    }

    function applyFilters(sales) {

                var selectedOutlet = $('#outletFilter').val();
                var selectedUser = $('#userFilter').val();
                var fromDate = $('#fromDate').val();
                var toDate = $('#toDate').val();
                
               // var filteredsales = selectedUser ? sales.filter(sale => sale.user.name === selectedUser ) : sales;
                var filteredSales = sales.filter(sale => {
                            const userMatches = selectedUser ? sale.user.name === selectedUser : true;
                            const outletMatches = selectedOutlet ? sale.outlet.name === selectedOutlet : true;
                                    // Convert sale.created_at to date object
                            var saleDate = new Date(sale.created_at);

                            // Filter by date range
                            const fromDateMatches = fromDate ? saleDate >= new Date(fromDate) : true;
                            const toDateMatches = toDate ? saleDate <= new Date(toDate) : true;
                            return userMatches && outletMatches && fromDateMatches && toDateMatches;
                        });
                        
                updateMap(filteredSales);

    }

    function applyFiltersAjax(page=1) {
    // alert('test');
    var selectedOutlet = $('#outletFilter').val();
    var selectedUser = $('#userFilter').val();
    var fromDate = $('#fromDate').val();
    var toDate = $('#toDate').val();

    $.ajax({
        url: '/sales/filter',  // Backend route
        type: 'GET',
        data: {
            user: selectedUser,
            outlet: selectedOutlet,
            from_date: fromDate,
            to_date: toDate,
            page:page
        },
        success: function(response) {
            updateMap(response.sales.data);  // Update map with filtered results
            updatePagination(response.sales);  // Update pagination links

        
        },
        error: function(error) {
            console.error("Error fetching sales:", error);
        }
    });
}

/**''
 * Updates the pagination links based on the paginated data.
 */
 function updatePagination(sales) {
    // alert('updating pagination');
    var paginationHtml = '';

    // Only add pagination if there are multiple pages
    if (sales.total > sales.per_page) {
        // alert('sales total > per page');
        paginationHtml += `<ul class="pagination">`;

        // Previous link
        if (sales.current_page > 1) {
            paginationHtml += `<li class="page-item page-prev">
                <a href="#" class="page-link pagination-link" data-page="${sales.current_page - 1}">Previous</a>
            </li>`;
        }

        // If there are more than 20 pages, use an ellipsis format.
        if (sales.last_page > 20) {
            // Always show the first page.
            if (sales.current_page === 1) {
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
            var start = sales.current_page - halfWindow;
            var end = sales.current_page + halfWindow;

            // Adjust if the current page is near the beginning
            if (start < 2) {
                end += 2 - start;
                start = 2;
            }

            // Adjust if the current page is near the end
            if (end > sales.last_page - 1) {
                start -= end - (sales.last_page - 1);
                end = sales.last_page - 1;
                
                if (start < 2) {
                    start = 2;
                }
            }


            // Determine a sliding window around the current page.
            // var range = 2; // pages before and after the current page to display
            // var start = Math.max(2, sales.current_page - range);
            // var end = Math.min(sales.last_page - 1, sales.current_page + range);

            // Show ellipsis if there's a gap between page 1 and the start of the window.
            if (start > 2) {
                paginationHtml += `<li class="page-item disabled">
                    <span class="page-link">...</span>
                </li>`;
            }

            // Loop through the sliding window.
            for (var i = start; i <= end; i++) {
                if (i === sales.current_page) {
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
            if (end < sales.last_page - 1) {
                paginationHtml += `<li class="page-item disabled">
                    <span class="page-link">...</span>
                </li>`;
            }

            // Always show the last page.
            if (sales.current_page === sales.last_page) {
                paginationHtml += `<li class="page-item active">
                    <a class="page-link pagination-link">${sales.last_page}</a>
                </li>`;
            } else {
                paginationHtml += `<li class="page-item">
                    <a href="#" class="page-link pagination-link" data-page="${sales.last_page}">${sales.last_page}</a>
                </li>`;
            }

        } else {
            // For 20 or fewer pages, show all page links.
            for (var i = 1; i <= sales.last_page; i++) {
                if (i === sales.current_page) {
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
        if (sales.current_page < sales.last_page) {
            paginationHtml += `<li class="page-item page-next">
                <a href="#" class="page-link pagination-link" data-page="${sales.current_page + 1}">Next</a>
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

    function populateUserFilter(sales) {
        const userFilter = document.getElementById("userFilter");
        const users = [...new Set(sales.map(sale => sale.user.name))];

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

    function updateMap(sales) {
        clearMarkers();

        if (sales.length > 0) {
            const bounds = new google.maps.LatLngBounds();
            sales.forEach(sale => {
                var lat1 = Number(sale.outlet['lat']);
                var long1 = Number(sale.outlet['long']);
                const myPosition = { lat: lat1, lng: long1 };

                var checkoutDate = new Date(sale.checkout_time * 1000); // Convert to milliseconds

                var checkoutHours = checkoutDate.getHours();
                var minutes = checkoutDate.getMinutes();

                minutes = minutes < 10 ? '0' + minutes : minutes;

                checkoutHours = checkoutHours < 10 ? '0' + checkoutHours : checkoutHours;

                var checkoutTime = checkoutHours + ':' + minutes;

                var date = new Date(sale.created_at);
                var hours = date.getHours();
                var minutes = date.getMinutes();
                var day = date.getDate();
                var month = date.getMonth(); // Months are zero-based, so add 1
                var year = date.getFullYear();

                var monthNames = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];

                // Get month name from array
                var monthName = monthNames[month];

                var saleDate = day + '-' + monthName + '-' + year;

                // Pad single digit minutes with a leading zero
                minutes = minutes < 10 ? '0' + minutes : minutes;

                hours = hours < 10 ? '0' + hours : hours;

                var saleTime = hours + ':' + minutes;

                const infowindow = new google.maps.InfoWindow({
                    content: "<div><h3>" + sale.outlet['name'] + "</h3>" +
                        "<p>Seller: " + (sale.user === null ? 'Deleted User' : sale.user['name']) + "</p>" +
                        "<p>Latitude: " + lat1 + "</p>" +
                        "<p>Longitude: " + long1 + "</p>" +
                        "<p><strong>Date:</strong> "+saleDate+"</p>"+
                        "<p><strong>Sale Time:</strong> "+saleTime+"</p>"+
                        "View: <a target='_blank' href='/editsale/" + sale.id + "'>View Sale Details</a>" +
                    
                        "</div>"
                });

                var marker = new google.maps.Marker({
                    position: myPosition,
                    title: sale.outlet['name'],
                    label: String(sale.id),
                    title: sale.outlet.name,
                    zIndex: google.maps.Marker.MAX_ZINDEX + Number(sale.id)
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
<script 
src="https://maps.googleapis.com/maps/api/js?key=AIzaSyALLsNWwOC09xsRAqrK0S7dINi6BpNc7iw&callback=myMap2"></script>

