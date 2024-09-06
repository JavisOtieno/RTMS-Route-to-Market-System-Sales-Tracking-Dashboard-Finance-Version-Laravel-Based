@extends('layout')


@section('content')

<div class="side-app">

    <!-- CONTAINER -->
    <div class="main-container container-fluid">

  <!-- PAGE-HEADER -->
  <div class="page-header">
    <h1 class="page-title">Off Plan Requests</h1>
    <div>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">RTMS</a></li>
            <li class="breadcrumb-item active" aria-current="page">Off Plan Requests</li>
        </ol>
    </div>
</div>
<!-- PAGE-HEADER END -->


        <!-- Row -->
        
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Off Plan Requests</h3>
                    </div>
                    <div class="row" style="margin: 0 10px;">
                        <input type="hidden" id="tableLoaded" value="default"/>
                        <h3 class="card-title" style="margin-top:20px;margin-block-end: 0rem;">Search by :</h3>
                        <div class="col-md-3 mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="nameInput" placeholder="Name">
                        </div>
                 
                        <div class="col-md-3 mb-3">
                            <label for="date" class="form-label">From</label>
                            <input type="date" class="form-control" id="dateFromInput" placeholder="Min Date">
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="date" class="form-label">To</label>
                            <input type="date" class="form-control" id="dateToInput" placeholder="Max Date">
                        </div>

                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="responsive-datatable" class="table table-bordered text-nowrap border-bottom">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th id="edit-column">View/Edit</th>
                                        <th id="delete-column">Delete</th>
                                        {{-- @if(auth()->user()->usertype == 'systemadmin')
                                        <th>Organization</th>
                                        @endif --}}
                                        <th>Seller Name</th>
                                        <th>RoutePlan Name</th>
                                        <th>Status</th>
                                        <th>Date</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                        @if(count($offplanrequests)>0)
                                        
                                        @foreach($offplanrequests as $offplanrequest)
                                        <tr>
                                        <td>{{$offplanrequest['id']}}</td>
                                        <td><a type="button" href="/editoffplanrequest/{{$offplanrequest['id']}}" class="btn btn-info" style="margin-left: auto;color:white;">View/Edit</a>
                                        </td>
                                        <td><a type="button" onclick="deleteItem({{$offplanrequest['id']}},'Id: '+{{$offplanrequest['id']}}+'<br/> Name: '+'{{$offplanrequest['user']['name']}}')"  
                                            class="btn btn-danger" 
                                            style="margin-left: auto;color:white;" 
                                            data-bs-toggle="modal" href="#modalDelete">Delete</a>
                                        </td>
                                        {{-- @if(auth()->user()->usertype == 'systemadmin')
                                        <th>{{$offplanrequest['organization']['name']}}</th>
                                        @endif --}}
                                        <td>{{$offplanrequest['user']['name']}}</td>
                                        <td>{{isset($offplanrequest->routePlan['name'])?$offplanrequest->routePlan['name']:'None'}}</td>
                                        <td>{{ucfirst($offplanrequest['status'])}}</td>
                                        <td>{{date('d-M-Y', strtotime($offplanrequest->routePlan['created_at']))}}</td>
                                    
                                        
                                        {{-- <td>
                                            <form method="POST" action="{{ route('edittargetgroup') }}">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $targetgroup->id }}">
                                                <!-- Other form fields -->
                                                <button type="submit" class="btn btn-info">View/Edit</button>
                                            </form>
                                        </td> --}}
                                        
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
        confirmDeleteLink.href = "/deleteteam/"+id;
    }
  </script>





