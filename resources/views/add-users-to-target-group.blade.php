@extends('layout')


@section('content')

<div class="side-app">

    <!-- CONTAINER -->
    <div class="main-container container-fluid">

  <!-- PAGE-HEADER -->
  <div class="page-header">
    <h1 class="page-title">Add Sellers to Target Group</h1>
    <div>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">RTMS</a></li>
            <li class="breadcrumb-item active" aria-current="page">Add Sellers to Target Group</li>
        </ol>
    </div>
</div>
<!-- PAGE-HEADER END -->


        <!-- Row -->
        {{-- action="{{ route('pushuserstotargetgroup') }}" --}}
            {{-- Then the route needs to have a name
            Route::post('/checkboxes', [CheckboxController::class, 'process'])->name('processCheckboxes'); --}}
        <form action="pushuserstotargetgroup" id="Userstotargetgroup" method="POST">
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
                        <h3 class="card-title col-md-3">Select Target Group</h3>
                        <div class="col-md-4" style="margin-left:20px;margin-right:20px;margin-top:10px;margin-bottom:10px;">
                            <div class="form-group" style="margin-block-end: 0rem;">
                                
                                <select class="form-select form-select select2" id="target_group_id" name="target_group_id">
                                        
                                        <option value="0">None</option>
                                        @foreach($targetgroups as $targetgroup)
                                        <option value="{{$targetgroup['id']}}">{{$targetgroup['name']." - KSh ".number_format($targetgroup['amount'])}}</option>
                                        @endforeach
                                    </select>
                            </div>
                        </div>
                        <input type="submit" class="btn btn-danger col-md-4" style="margin-left: auto;margin-right:20px;margin-top:10px;margin-bottom:10px;color:white;" value="Add Sellers To Target Group"></input>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="basic-datatable" class="table table-bordered text-nowrap border-bottom">
                                <thead>
                                    <tr>
                                        
                                        <th>ID</th>
                                        {{-- <th>Select - Seller Name</th> --}}
                                        <th>Sellers
                                            {{-- <div class="form-group" style="margin-top:10px;" >
                                                <label class="custom-control custom-checkbox mb-0" >
                                            <input type="checkbox" id="selectallusers" class="custom-control-input" name="users[]" value="">
                                                        <span class="custom-control-label"> Select All</span>
                                                </label>
                                            </div> --}}
                                        </th>
                                        {{-- <th>Name</th> --}}
                                        <th>Targets</th>
                                        <th>Phone</th>
                                        <th>Email</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                        @if(count($users)>0)
                                        
                                        @foreach($users as $user)
                                        <tr>
                                            <td>{{$user['id']}}</td>
                                            <td>
                                                <div class="form-group" >
                                                    <label class="custom-control custom-checkbox mb-0" >
                                                        <input style="margin: 0 auto" type="checkbox" class="custom-control-input" name="users[]" value="{{$user['id']}}">
                                                        <span class="custom-control-label"> {{$user['name']}}</span>
                                                    </label>
                                                </div>
                                            </td>
                                        
                                        {{-- <td>{{$user['name']}}</td> --}}
                                        <td>{{$user['targetgroup']==null?"None":'KSh '.number_format($user['targetgroup']['amount'])}}</td>
                                        <td>{{$user['phone']}}</td>
                                        <td>{{$user['email']}}</td>
                                        
                                        
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


@endsection

<script>
    function deleteItem(id,message){
        //alert(id);
        var itemDetails = document.getElementById("itemDetails");
        itemDetails.innerHTML = message;
        var confirmDeleteLink = document.getElementById('confirmDelete'); //or grab it by tagname etc
        confirmDeleteLink.href = "/deleteuser/"+id;
    }
  </script>





