@extends('layout')


@section('content')

<div class="side-app">

    <!-- CONTAINER -->
    <div class="main-container container-fluid">

  <!-- PAGE-HEADER -->
  <div class="page-header">
    <h1 class="page-title">Users</h1>
    <div>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">RTMS</a></li>
            <li class="breadcrumb-item active" aria-current="page">Users</li>
        </ol>
    </div>
</div>
<!-- PAGE-HEADER END -->


        <!-- Row -->
        
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Users</h3>
                        <a type="button" href="/add-user" class="btn btn-danger col-md-3" style="margin-left: auto;margin-right:20px;margin-top:10px;margin-bottom:10px;color:white;">Add User</a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="responsive-datatable" class="table table-bordered text-nowrap border-bottom">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Phone</th>
                                        <th>Email</th>
                                        <th>View/Edit</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                        @if(count($users)>0)
                                        
                                        @foreach($users as $user)
                                        <tr>
                                        <td>{{$user['id']}}</td>
                                        <td>{{$user['name']}}</td>
                                        <td>{{$user['phone']}}</td>
                                        <td>{{$user['email']}}</td>
                                        <td><a type="button" href="/edituser/{{$user['id']}}" class="btn btn-info" style="margin-left: auto;color:white;">View/Edit</a>
                                        </td>
                                        <td><a type="button" onclick="deleteItem({{$user['id']}},'Id: '+{{$user['id']}}+'<br/> Name: '+'{{$user['name']}}'+'<br/> Phone: '+'{{$user['phone']}}'+'<br/> Email: '+'{{$user['email']}}')"  class="btn btn-danger" style="margin-left: auto;color:white;" data-bs-toggle="modal" href="#modalDelete">Delete</a>
                                        </td>
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
        confirmDeleteLink.href = "/deleteuser/"+id;
    }
  </script>





