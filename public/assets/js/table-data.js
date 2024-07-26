$(function(e) {
    "use strict";

    //______Basic Data Table
    var tableAllocate=$('#basic-datatable').DataTable({
        language: {
            searchPlaceholder: 'Search...',
            sSearch: '',
        },
        "order": [0, 'desc'],
        'ordering': true,
    });

    $('#routeplan_user_id').on('change', function() {
        var selectedOption = $(this).val();
        if (selectedOption) {
            fetchTableData(selectedOption);
        } else {
            table.clear().draw();
        }
    });

    function fetchTableData(option) {
        $.ajax({
            url: '/updateoutletscreaterouteplan/' + option, // Replace with your actual route to fetch data
            method: 'GET',
            dataType: 'json',
            success: function(response) {
                updateDataTable(response); // Call function to update DataTable
            },
            error: function(xhr, status, error) {
                console.error('Error fetching data:', error);
            }
        });
    }

    function updateDataTable(data) {
        // Clear existing DataTable rows
        tableAllocate.clear();
        //alert("we are here");

        // console.log("data");
        // console.log(data);
        // console.log("data");

        // Add new rows based on fetched data
        $.each(data.outlets, function(index, outlet) {

            console.log('outlet');
            console.log(outlet);
            console.log('outlet');
            
            tableAllocate.row.add([
                outlet.id,
                '<div class="form-group" ><label class="custom-control custom-checkbox mb-0" >'+
                '<input type="checkbox" style="margin: 0 auto" class="custom-control-input" name="outlets[]"  value="' + outlet.id + '"> '+
                '<span class="custom-control-label">'+outlet.name+'</span></label></div>', // Example for Outlets column
                outlet.user ? outlet.user.name + (outlet.user.trashed ? ' (Deleted User)' : '') : 'Deleted User',
                outlet.contact_person_name,
                outlet.phone
            ]).draw();

           // alert("we are here too");
        });
    }



    //______Basic Data Table
    var table2=$('#responsive-datatable').DataTable({
        "order": [0, 'desc'],
        'ordering': true,
        language: {
            searchPlaceholder: 'Search...',
            scrollX: "100%",
            sSearch: '',
        
        },
        buttons: [
            {
                extend: 'copy',
                title: 'RTMSExport',
                exportOptions: {
                    columns: function(idx, data, node) {
                        // Prevent export of columns with certain IDs
                        var columnId = $(node).attr('id');
                        return columnId !== 'map-column' && columnId !== 'view-column' &&columnId !== 'edit-column' && columnId !== 'delete-column';
                    }
                }
            }
            , 
        {
            extend: 'excelHtml5',
            title: 'RTMSExport',
            exportOptions: {
                columns: function(idx, data, node) {
                    // Prevent export of columns with certain IDs
                    var columnId = $(node).attr('id');
                    return columnId !== 'map-column' && columnId !== 'view-column' && columnId !== 'edit-column' && columnId !== 'delete-column';
                }
            }
        }
        
        , 
        {
            extend: 'pdf',
            title: 'RTMSExport',
            exportOptions: {
                columns: function(idx, data, node) {
                    // Prevent export of columns with certain IDs
                    var columnId = $(node).attr('id');
                    return columnId !== 'map-column' && columnId !== 'view-column' &&columnId !== 'edit-column' && columnId !== 'delete-column';
                }
            }
        }
        ,         {
            extend: 'colvis',
            title: 'RTMSExport',
            // columns: function(idx, data, node) {
            //         // Prevent export of columns with certain IDs
            //         var columnId = $(node).attr('id');
            //         return columnId !== 'edit-column' && columnId !== 'delete-column';
            //     }
            
        }
    ],
        
    });
    table2.buttons().container()
        .appendTo('#responsive-datatable_wrapper .col-md-6:eq(0)');

//OUTLETS ALLOCATE TO USERS TABLE FORM
 
        // Handle 'select all' checkbox
        $('#selectalloutlets').on('click', function() {
            alert('clicked');
            var rows = tableAllocate.rows({ 'search': 'applied' }).nodes();
            $('input[type="checkbox"]', rows).prop('checked', this.checked);
        });

        // Handle 'select all' checkbox
        $('#selectalloutletsroutes').on('click', function() {
            alert('clicked');
            var rows = tableAllocate.rows({ 'search': 'applied' }).nodes();
            $('input[type="checkbox"]', rows).prop('checked', this.checked);
        });
    
        // Handle form submission
        $('#Outletstouser').on('submit', function(event) {

            $('#Outletstouser input[type="hidden"][name="outletcheckboxes[]"]').remove();

            event.preventDefault(); // Prevent the default form submission; 
            
    
            // Gather all checkboxes (including those not in view)
            var allCheckboxes = tableAllocate.$('input[type="checkbox"]');
    
            // Iterate through all checkboxes to collect their values
            var selectedCheckboxes = [];
            allCheckboxes.each(function() {
                if (this.checked) {
                    selectedCheckboxes.push($(this).val());
                }
            });
    
            // Log the selected checkboxes or send them to the server
            // console.log("Hello");
            // console.log(selectedCheckboxes);
            // console.log("Hello");
            
    
            // Optionally, you can add the selected checkboxes to the form as hidden inputs
            selectedCheckboxes.forEach(function(value) {
                $('<input>').attr({
                    type: 'hidden',
                    name: 'outletcheckboxes[]',
                    value: value
                }).appendTo('#Outletstouser');
                // alert(value);
            });

            // alert("stop");
    
            // Submit the form
            
            this.submit();
            
            
        });

    //OUTLETS ALLOCATE TO USERS TABLE FORM

    //OUTLETS ALLOCATE TO USERS TABLE FORM

//        Handle 'select all' checkbox
        $('#selectallusers').on('click', function() {
            var rows = tableAllocate.rows({ 'search': 'applied' }).nodes();
            $('input[type="checkbox"]', rows).prop('checked', this.checked);
        });
    
        // Handle form submission
        $('#Userstotargetgroup').on('submit', function(event) {

            $('#Userstotargetgroup input[type="hidden"][name="usercheckboxes[]"]').remove();

            event.preventDefault(); // Prevent the default form submission;
            
    
            // Gather all checkboxes (including those not in view)
            var allCheckboxes = tableAllocate.$('input[type="checkbox"]');
    
            // Iterate through all checkboxes to collect their values
            var selectedCheckboxes = [];
            allCheckboxes.each(function() {
                if (this.checked) {
                    selectedCheckboxes.push($(this).val());
                }
            });
    
            // Log the selected checkboxes or send them to the server
            console.log(selectedCheckboxes);
    
            // Optionally, you can add the selected checkboxes to the form as hidden inputs
            selectedCheckboxes.forEach(function(value) {
                $('<input>').attr({
                    type: 'hidden',
                    name: 'usercheckboxes[]',
                    value: value
                }).appendTo('#Userstotargetgroup');
            });
    
            // Submit the form
            
            this.submit();
            
            
        });

    //OUTLETS ALLOCATE TO USERS TABLE FORM


    $('#Outletstorouteplan').on('submit', function(event) {

        $('#Outletstorouteplan input[type="hidden"][name="outletcheckboxes[]"]').remove();

        event.preventDefault(); // Prevent the default form submission; 
        

        // Gather all checkboxes (including those not in view)
        var allCheckboxes = tableAllocate.$('input[type="checkbox"]');

        // Iterate through all checkboxes to collect their values
        var selectedCheckboxes = [];
        allCheckboxes.each(function() {
            if (this.checked) {
                selectedCheckboxes.push($(this).val());
            }
        });

        // Log the selected checkboxes or send them to the server
        // console.log("Hello");
        // console.log(selectedCheckboxes);
        // console.log("Hello");
        

        // Optionally, you can add the selected checkboxes to the form as hidden inputs
        selectedCheckboxes.forEach(function(value) {
            $('<input>').attr({
                type: 'hidden',
                name: 'outletcheckboxes[]',
                value: value
            }).appendTo('#Outletstorouteplan');
            //alert(value);
        });

        //alert("stop");

        // Submit the form
        
        this.submit();
        
        
    });


    

    



    // $('#responsive-datatable tbody').on('click', 'tr', function () {
    //     var data = table2.row(this).data();
    //     alert('You clicked on ' + data[0] + '\'s row');
    //     table2.column(1).search(data[0]).draw();
    // });
    //table.column(0).click(alert("hello"));
    // <input type="hidden" id="tableLoaded" value="users"/>
    var tableLoaded=$('#tableLoaded').val();
    //alert(tableLoaded);
    if(tableLoaded=="users"){
    $('#nameInput').on('keyup', function() {
        //alert(this.value);
        table2.column(1).search(this.value).draw(); // Column index 0 for 'Name'
    });
    // alert("file loads");

    $('#phoneInput').on('keyup', function() {
        //alert(this.value);
        table2.column(2).search(this.value).draw(); // Column index 1 for 'Position'
    });

    $('#emailInput').on('keyup', function() {
        //alert(this.value);
        table2.column(3).search(this.value).draw(); // Column index 0 for 'Name'
    });

  
    $('#targetsInput').change(function(){
        var selectedValue = $(this).val();
        table2.column(4).search(this.value).draw(); 
        //console.log("Selected value: " + selectedValue);
      });
    }else if(tableLoaded=="targetgroups"){
        $('#nameInput').on('keyup', function() {
            //alert(this.value);
            table2.column(1).search(this.value).draw(); // Column index 0 for 'Name'
        });
        $('#amountInput').on('keyup', function() {
            //alert(this.value);
            table2.column(2).search(this.value).draw(); // Column index 1 for 'Position'
        });

    }else if(tableLoaded=="clockins"){
        $('#nameInput').on('keyup', function() {
            //alert(this.value);
            table2.column(1).search(this.value).draw(); // Column index 0 for 'Name'
        });
        // $('#dateInput').on('keyup', function() {
        //     //alert(this.value);
        //     table2.column(2).search(this.value).draw(); // Column index 1 for 'Position'
        // });
        // $('#timeInput').on('keyup', function() {
        // table2.column(2).search('>' + this.value, true, false).draw();
        // });

    }
    else if(tableLoaded=="clockouts"){
        $('#nameInput').on('keyup', function() {
            //alert(this.value);
            table2.column(1).search(this.value).draw(); // Column index 0 for 'Name'
        });
        // $('#dateInput').on('keyup', function() {
        //     //alert(this.value);
        //     table2.column(2).search(this.value).draw(); // Column index 1 for 'Position'
        // });
        // $('#timeInput').on('keyup', function() {
        // table2.column(2).search('>' + this.value, true, false).draw();
        // });

    }
    else if(tableLoaded=="visits"){
        $('#nameInput').on('keyup', function() {
            //alert(this.value);
            table2.column(1).search(this.value).draw(); // Column index 0 for 'Name'
        });
        $('#outletNameInput').on('keyup', function() {
            //alert(this.value);
            table2.column(2).search(this.value).draw(); // Column index 0 for 'Name'
        });
        // $('#dateInput').on('keyup', function() {
        //     //alert(this.value);
        //     table2.column(2).search(this.value).draw(); // Column index 1 for 'Position'
        // });
        // $('#timeInput').on('keyup', function() {
        // table2.column(2).search('>' + this.value, true, false).draw();
        // });

    }
    else if(tableLoaded=="sales" || tableLoaded=="posaudits" || tableLoaded=="competitoranalysis" || tableLoaded=="feedback"){
        $('#nameInput').on('keyup', function() {
            //alert(this.value);
            table2.column(1).search(this.value).draw(); // Column index 0 for 'Name'
        });
        $('#outletNameInput').on('keyup', function() {
            //alert(this.value);
            table2.column(2).search(this.value).draw(); // Column index 0 for 'Name'
        });

    }
    else if(tableLoaded=="outlets"){
        $('#nameInput').on('keyup', function() {
            //alert(this.value);
            table2.column(1).search(this.value).draw(); // Column index 1 for 'Name'
        });
        $('#contactNameInput').on('keyup', function() {
            //alert(this.value);
            table2.column(2).search(this.value).draw(); // Column index 2 for 'Contact Name'
        });
        $('#phoneInput').on('keyup', function() {
            //alert(this.value);
            table2.column(3).search(this.value).draw(); // Column index 3 for 'Phone'
        });

    }
    else if(tableLoaded=="Outletstouser"){
        $('#nameInput').on('keyup', function() {
            //alert(this.value);
            tableAllocate.column(1).search(this.value).draw(); // Column index 1 for 'Name'
        });
        $('#currentSellerInput').on('keyup', function() {
            //alert(this.value);
            tableAllocate.column(2).search(this.value).draw(); // Column index 1 for 'Name'
        });
        $('#contactNameInput').on('keyup', function() {
            //alert(this.value);
            tableAllocate.column(3).search(this.value).draw(); // Column index 2 for 'Contact Name'
        });
        $('#phoneInput').on('keyup', function() {
            //alert(this.value);
            tableAllocate.column(4).search(this.value).draw(); // Column index 3 for 'Phone'
        });

    }
    else if(tableLoaded=="products"){
        $('#nameInput').on('keyup', function() {
            //alert(this.value);
            table2.column(1).search(this.value).draw(); // Column index 1 for 'Name'
        });
        $('#skuInput').on('keyup', function() {
            //alert(this.value);
            table2.column(2).search(this.value).draw(); // Column index 2 for 'Contact Name'
        });
        $('#priceInput').on('keyup', function() {
            //alert(this.value);
            table2.column(3).search(this.value).draw(); // Column index 3 for 'Phone'
        });

    }    


    //______File-Export Data Table
    var table = $('#file-datatable').DataTable({
        buttons: ['copy', 'excel', 'pdf', 'colvis'],
        language: {
            searchPlaceholder: 'Search...',
            scrollX: "100%",
            sSearch: '',
        }
    });
    table.buttons().container()
        .appendTo('#file-datatable_wrapper .col-md-6:eq(0)');

    //______Delete Data Table
    var table = $('#delete-datatable').DataTable({
        language: {
            searchPlaceholder: 'Search...',
            sSearch: '',
        }
    });
    $('#delete-datatable tbody').on('click', 'tr', function() {
        if ($(this).hasClass('selected')) {
            $(this).removeClass('selected');
        } else {
            table.$('tr.selected').removeClass('selected');
            $(this).addClass('selected');
        }
    });
    $('#button').on('click', function() {
        table.row('.selected').remove().draw(false);
    });
    $('#example3').DataTable( {
        responsive: {
            details: {
                display: $.fn.dataTable.Responsive.display.modal( {
                    header: function ( row ) {
                        var data = row.data();
                        return 'Details for '+data[0]+' '+data[1];
                    }
                } ),
                renderer: $.fn.dataTable.Responsive.renderer.tableAll( {
                    tableClass: 'table'
                } )
            }
        }
    } );
    $('#example2').DataTable({
		responsive: true,
        "order": [0, 'desc'],
        'ordering': true,
		language: {
			searchPlaceholder: 'Search...',
			sSearch: '',
			lengthMenu: '_MENU_ items/page',
		}
	});
	

    //______Select2 
    $('.select2').select2({
        minimumResultsForSearch: Infinity
    });

});