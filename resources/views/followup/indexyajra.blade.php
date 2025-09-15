@extends('layout')

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


            <div class="col-xl-12">

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Followups</h3>
                        {{-- <a type="button" href="/add-followup" class="btn btn-danger col-md-3"
                            style="margin-left: auto;margin-right:20px;margin-top:10px;margin-bottom:10px;color:white;">Add
                            Followups</a> --}}
                    </div>
                    <div class="row" style="margin: 0 10px;">
                        <input type="hidden" id="tableLoaded" value="outlets"/>
                        <h3 class="card-title" style="margin-top:20px;margin-block-end: 0rem;">Date Time Range Filter :</h3>
                        
                        <div class="col-md-3 mb-3">
                            <label for="date" class="form-label">From</label>
                            <input type="date" class="form-control" id="dateFromInput" placeholder="Min Date">
                        </div>
            
                        <div class="col-md-3 mb-3">
                            <label for="date" class="form-label">To</label>
                            <input type="date" class="form-control" id="dateToInput" placeholder="Max Date">
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="timeFromInput" class="form-label">Time From</label>
                            <input type="time" class="form-control" id="timeFromInput" placeholder="Min Date">
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="timeToInput" class="form-label">Time To</label>
                            <input type="time" class="form-control" id="timeToInput" placeholder="Max Date">
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
                                        <th>View/Edit</th>
                                        <th id="delete-column">Delete</th>
                                        <th>Outlet Name</th>
                                        <th>Seller Name</th>
                                        {{-- <th>Contact Name</th>
                                        <th>Phone</th> --}}
                                        <th>Type</th>
                                        <th>Description</th>
                                        <th>Team</th>

                                        {{-- <th>Region</th>
                                        <th>Territory</th>
                                        <th>Cluster</th>
                                        <th>Channel Type</th> --}}

                                        <th>Date</th>
                                        <th>Time</th>
                                        {{-- <th>Check out Time</th>
                                        <th>Duration</th>
                                        <th class="no-export">Map</th> --}}

                                        {{-- <th id="map-column">Map</th> --}}

                                        
                                    </tr>
                                    <tr>
                                        <th><input class="form-control" style="width: auto;max-width: 90px;" type="text" placeholder="Search ID" /></th>
                                        <th></th>
                                        <th></th>
                                        <th><input class="form-control" style="width: auto;min-width: max-content;" type="text" placeholder="Search Outlet Name" /></th>
                                        <th><input class="form-control" style="width: auto;min-width: max-content;" type="text" placeholder="Search Seller Name" /></th>
                                        <th><input class="form-control" style="width: auto;min-width: max-content;" type="text" placeholder="Search Type" /></th>
                                        <th><input class="form-control" style="width: auto;min-width: max-content;" type="text" placeholder="Search Description" /></th>
                                        
                                        {{-- <th><input type="text" placeholder="Search Contact Name" /></th>
                                        <th><input type="text" placeholder="Search Phone" /></th> --}}
                                        <th><input class="form-control" style="width: auto;min-width: max-content;" type="text" placeholder="Search Team" /></th>

                                        
                                        {{-- <th><input type="text" placeholder="Search Region" /></th>
                                        <th><input type="text" placeholder="Search Territory" /></th>
                                        <th><input type="text" placeholder="Search Cluster" /></th>
                                        <th><input type="text" placeholder="Search Channel Type" /></th> --}}
                                        <th>
                                            <input class="form-control" style="width: auto;min-width: max-content;" type="date" placeholder="Search Date" />
                                        </th>
                                        <th>
                                            <input class="form-control" style="width: auto;min-width: max-content;" type="time" placeholder="Search Time" />
                                        </th>
                                        {{-- <th><input type="text" placeholder="Search Checkout Time" /></th>
                                        <th><input type="text" placeholder="Search Duration" /></th> --}}
                                        
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
                    <div id="googleMapFollowup" class="worldh world-map h-500"></div>
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
    function deleteItem(id, message) {
        //alert(id);
        var itemDetails = document.getElementById("itemDetails");
        itemDetails.innerHTML = "Followup Id: " + id + message;
        var confirmDeleteLink = document.getElementById('confirmDelete'); //or grab it by tagname etc
        confirmDeleteLink.href = "/deletefollowup/" + id;
    }

    function embedMap(lat, long) {
        //alert(id);
        var mapEmbedFrame = document.getElementById("mapEmbededForNow");
        mapEmbedFrame.src = "https://maps.google.com/maps?q=" + lat + "," + long + "&hl=es;z=14&amp&output=embed";
        //var confirmDeleteLink = document.getElementById('confirmDelete'); //or grab it by tagname etc
        //confirmDeleteLink.href = "/deletefollowup/"+id;
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

            var googleMapsDiv = document.getElementById("googleMapFollowup");

            map = new google.maps.Map(googleMapsDiv, mapProp);


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
                // ajax: '{!! route('followupsyajra') !!}',
                ajax: {
                    url: '{!! route('followupsyajra') !!}',
                    type: "GET",  // Ensure it's a GET request
                    data: function(d) {
                        d.from_date = $('#dateFromInput').val();
                        d.to_date = $('#dateToInput').val();
                        d.from_time = $('#timeFromInput').val();
                        d.to_time = $('#timeToInput').val();
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
                        <a class="btn btn-info edit-btn" href="/followup/${data.id}" 
                            data-id="${data.id}">View/Edit</a>

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

                        //     return `
                        //         <a type="button" onclick="deleteItem(${data.id},'<br/>Outlet: ${data.outlet_name} <br/>Seller: ${data.user_name}<br/>Followup: ${data.followup}')"  class="btn btn-danger" style="margin-left: auto;color:white;" data-bs-toggle="modal" href="#modalDelete">Delete</a>
                        // `;
                    let details = `<br/>Outlet: ${data.outlet_name}<br/>Seller: ${data.user_name}<br/>Followup: ${data.followup}`;

                    return `
                        <a type="button"
                        onclick="deleteItem(${data.id}, decodeURIComponent('${encodeURIComponent(details)}'))"
                        class="btn btn-danger"
                        style="margin-left: auto;color:white;"
                        data-bs-toggle="modal"
                        href="#modalDelete">
                            Delete
                        </a>
                    `;
                        },
                        orderable: false,
                        searchable: false,
                        exportable: false
                    },
                    {
                        data: 'outlet_name',
                        name: 'outlets.name'
                    },
                    { data: 'user_name', 
                    name: 'users.name', defaultContent: 'No User' }, // Add this,
                    {
                        data: 'type',
                        name: 'type'
                    },
                    {data: 'description',
                    name: 'description',
                    render: function(data, type, row) {
                        if (data && data.length > 50) { // Limit to 50 characters
                            return data.substr(0, 50) + '...'; 
                        }
                        return data;
                    }},
                    {
                        data: 'team_name',
                        name: 'teams.name',defaultContent: 'None' 
                    },
                    // {
                    //     data: 'region_name',
                    //     name: 'region_name',defaultContent: 'None'
                    // },
                    // {
                    //     data: 'territory_name',
                    //     name: 'territory_name',defaultContent: 'None'
                    // },
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
                        name: 'created_at',
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
                        name: 'created_at',
                    },



                ],
                dom: 'lBfrtip', // This defines the layout of the table controls, including buttons
                buttons: [
                {
                    extend: 'excelHtml5',
                    text: 'Excel',
                    title: 'RTMSExport',
                    exportOptions: {
                        columns: ':visible:not(.no-export)',
                        format: {
                        header: function (data, columnIdx) {
                            // read the first thead <tr> (index 0) and take the th at columnIdx
                            return $('#responsive-datatable-yajra thead tr').first().find('th').eq(columnIdx).text().trim();
                        }
                        }
                    }
                },
                {
                    extend: 'copy',
                    text: 'Copy',
                    title: 'RTMSExport',
                    exportOptions: {
                        columns: ':visible:not(.no-export)',
                        format: {
                        header: function (data, columnIdx) {
                            // read the first thead <tr> (index 0) and take the th at columnIdx
                            return $('#responsive-datatable-yajra thead tr').first().find('th').eq(columnIdx).text().trim();
                        }
                        }
                    }
                },
                {
                        extend: 'pdf',
                        text: 'PDF',
                        title: 'RTMSExport', // Optional: Set the title for the exported file
                        // "action": newexportaction
                        exportOptions: {
                            columns: ':visible:not(.no-export)',
                            format: {
                            header: function (data, columnIdx) {
                                // read the first thead <tr> (index 0) and take the th at columnIdx
                                return $('#responsive-datatable-yajra thead tr').first().find('th').eq(columnIdx).text().trim();
                            }
                        }
                        }
                },
                {
                        extend: 'print',
                        text: 'Print',
                        title: 'RTMSExport', // Optional: Set the title for the printed document
                        // "action": newexportaction
                        exportOptions: {
                            columns: ':visible:not(.no-export)',
                            format: {
                            header: function (data, columnIdx) {
                                // read the first thead <tr> (index 0) and take the th at columnIdx
                                return $('#responsive-datatable-yajra thead tr').first().find('th').eq(columnIdx).text().trim();
                            }
                            }
                    }
                },
                {
                        extend: 'colvis',
                        text: 'Columns',
                        columnText: function (dt, idx, title) {
                            // force label to come from first row <th>
                            return $('#responsive-datatable-yajra thead tr').first().find('th').eq(idx).text().trim();
                        }
                }
                    // {
                    //     extend: 'excelHtml5',
                    //     text: 'Excel',
                    //     // "text": '<button class="btn"><i class="fa fa-file-excel-o" style="color: green;"></i>  Excel</button>',
                    //     "titleAttr": 'Excel',
                    //     // "action": newexportaction,
                    //     // exportOptions: {
                    //     // columns: function (idx, data, node) {
                    //     //     return !$(node).hasClass('no-export'); // Still excludes based on class
                    //     //     }
                    //     // }
                    //     // exportOptions = {
                    //     //     columns: [0, 1, 3] // Only export columns 0, 1, 3, and 4 (zero-based index)
                    //     // }
                    //     exportOptions: {
                    //         columns: ':not(:nth-child(1)), :not(:nth-child(4))' // Exclude first (index 0) and fourth column (index 3)
                    //     }
                    //     // title: 'Followup Data', // Optional: Set the title for the exported file
                    //     // exportOptions: {
                    //     // modifier: 'page' // This line exports all data
                        
                    // },
                    // {
                    //     extend: 'copy',
                    //     text: 'Copy',
                    //     title: 'RTMSExport',
                    //     // "action": newexportaction
                    // },
                    // {
                    //     extend: 'pdf',
                    //     text: 'PDF',
                    //     title: 'RTMS Followup Data', // Optional: Set the title for the exported file
                    //     // "action": newexportaction
                    // },
                    // {
                    //     extend: 'print',
                    //     text: 'Print',
                    //     title: 'RTMS Followup Data', // Optional: Set the title for the printed document
                    //     // "action": newexportaction
                    // },
                    // {
                    //     extend: 'colvis',
                        
                    //     title: 'RTMSExport',
                    // }
                ],
                lengthMenu: [
                    [10, 25, 50, 100, 1000],
                    [10, 25, 50, 100, 1000]
                ], // Page length options
                pageLength: 10, // Default page length
                order: [
                    [0, 'desc']
                ]
            });

            $('#dateFromInput, #dateToInput, #timeFromInput, #timeToInput').on('change', function() {
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
    //      var exportTitle = `RTMS Followup Data - ${currentDate}`;
         
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
