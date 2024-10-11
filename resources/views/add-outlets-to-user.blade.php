@include('components/header')
@include('components/header-extension-main')

<!-- outletcheckboxes Outletstouser -->

<div class="side-app">

    <!-- CONTAINER -->
    <div class="main-container container-fluid">

  <!-- PAGE-HEADER -->
  <div class="page-header">
    <h1 class="page-title">Allocate Customers To Sellers</h1>
    <div>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">RTMS</a></li>
            <li class="breadcrumb-item active" aria-current="page">Allocate Customers To Sellers</li>
        </ol>
    </div>
</div>
<!-- PAGE-HEADER END -->


        <!-- Row -->
        {{-- action="{{ route('pushuserstotargetgroup') }}" --}}
            {{-- Then the route needs to have a name
            Route::post('/checkboxes', [CheckboxController::class, 'process'])->name('processCheckboxes'); --}}
        <form action="pushoutletstouser" id="Outletstouser" method="POST">
            @csrf
        
            <div class="col-lg-12">
                <div class="card">
                    
                    <div class="card-header row">
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
                        <h3 class="card-title col-md-2">Select Seller</h3>
                        <div class="col-md-4" style="margin-left:20px;margin-right:20px;margin-top:10px;margin-bottom:10px;">
                            {{-- <div class="form-group" style="margin-block-end: 0rem;">
                                
                                <select class="form-select form-select select2" id="user_id" name="user_id">
                                        
                                        // <option value="0">None</option> 
                                        @foreach($users as $user)
                                        <option value="{{$user['id']}}">{{$user['name']}}</option>
                                        @endforeach
                                    </select>
                            </div> --}}
                            <div class="form-group" style="margin-block-end: 0rem;">
                                {{-- <label class="form-label"> Users</label> --}}
                                <select class="form-control select2-show-search form-select" name="user_id" id="user_id" data-placeholder="Choose one">
                                        <option value="0" label="Choose one">Choose one</option>
                                        @foreach($users as $user)
                                        <option value="{{$user['id']}}">{{$user['name']}}</option>
                                        @endforeach
                                        
                                    </select>
                            </div>
                        </div>
                        <input type="submit" class="btn btn-danger col-md-4" style="margin-left: auto;margin-right:20px;margin-top:10px;margin-bottom:10px;color:white;" value="Allocate Selected Outlets To Seller"></input>
                    </div>
                    <div class="row" style="margin: 0 10px;">
                        <input type="hidden" id="tableLoaded" value="Outletstouser"/>
                        <h3 class="card-title" style="margin-top:20px;margin-block-end: 0rem;">Search by :</h3>
                        <div class="col-md-3 mb-3">
                            <label for="nameInput" class="form-label">Customer Name</label>
                            <input type="text" class="form-control" id="nameInput" placeholder="Name">
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="currentSellerInput" class="form-label">Seller</label>
                            <input type="text" class="form-control" id="currentSellerInput" placeholder="Seller">
                        </div>
                        
                        <div class="col-md-3 mb-3">
                            <label for="contactNameInput" class="form-label">Contact Name</label>
                            <input type="text" class="form-control" id="contactNameInput" placeholder="Contact Name">
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="phone" class="form-label">Contact Phone</label>
                            <input type="tel" class="form-control" id="phoneInput" placeholder="Phone">
                        </div>
                       
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="basic-datatable" class="table table-bordered text-nowrap border-bottom">
                                <thead>
                                    <tr>
                                        
                                        <th>ID</th>
                                        {{-- <th>Select - Outlet Name</th> --}}
                                        <th>Customer Name
                                            {{-- <div class="form-group" style="margin-top:10px;" >
                                                <label class="custom-control custom-checkbox mb-0" >
                                            <input type="checkbox" id="selectalloutlets" class="custom-control-input" name="users[]" value="">
                                                        <span class="custom-control-label"> Select All</span>
                                                </label>
                                            </div> --}}
                                        </th>
                                        <th>Seller</th>
                                        {{-- <th>Name</th> --}}
                                        <th>Contact Name</th>
                                        <th>Contact Phone</th>

                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                        @if(count($outlets)>0)
                                        
                                        @foreach($outlets as $outlet)
                                        <tr>
                                            <td>{{$outlet['id']}}</td>
                                            <td>
                                                <div class="form-group" >
                                                    <label class="custom-control custom-checkbox mb-0" >
                                                        <input style="margin: 0 auto" type="checkbox"  class="custom-control-input" name="outlets[]" value="{{$outlet['id']}}">
                                                        <span class="custom-control-label"> {{$outlet['name']}}</span>
                                                    </label>
                                                </div>
                                            </td>
                                        
                                        {{-- <td>{{$user['name']}}</td> --}}
                                        <td>
                                            {{-- {{$outlet['user']['name']}} --}}
                                            {{ $outlet['user'] ? $outlet['user']['name']  . ($outlet['user']->trashed() ? ' (Deleted User)' : '') : 'Deleted User'}}
                                        </td>
                                        <td>{{$outlet['contact_person_name']}}</td>
                                        <td>{{$outlet['phone']}}</td>
                                        
                                        
                                        <!--<a class="modal-effect btn btn-primary-light d-grid mb-3" data-bs-effect="effect-scale" >Scale</a>-->
                                        </tr>
                                        @endforeach
                                        @else
                                        <!--<tr><td colspan="7" style="text-align: center">No users so far</td></tr>-->
                                        <!--let datatables display no data available-->
                                        @endif
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            
        </form>


                        



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




<script>
    function deleteItem(id,message){
        //alert(id);
        var itemDetails = document.getElementById("itemDetails");
        itemDetails.innerHTML = message;
        var confirmDeleteLink = document.getElementById('confirmDelete'); //or grab it by tagname etc
        confirmDeleteLink.href = "/deleteuser/"+id;
    }
  </script>
  <script>





</script>

@include('components/footer-selectjs-table')