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
            <a type="button" href="/add-outlet" class="btn btn-success col-md-3" style="margin-left: auto;margin-right:20px;margin-top:10px;margin-bottom:10px;color:white;">Add Outlet</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="example2" class="table table-bordered text-nowrap border-bottom">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Contact Name</th>
                            <th>Phone</th>
                            <th>View/Edit</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            @foreach($outlets as $outlet)
                            <td>{{$outlet['id']}}</td>
                            <td>{{$outlet['name']}}</td>
                            <td>{{$outlet['contact_person_name']}}</td>
                            <td>{{$outlet['phone']}}</td>
                            <td><a type="button" href="/editoutlet/{{$outlet['id']}}" class="btn btn-info" style="margin-left: auto;color:white;">View/Edit</a>
                            </td>
                            <td><a type="button" onclick="deleteItem({{$outlet['id']}},'{{$outlet['name']}}')"  class="btn btn-danger" style="margin-left: auto;color:white;" data-bs-toggle="modal" href="#modalDelete">Delete</a>
                            </td>
                            <!--<a class="modal-effect btn btn-primary-light d-grid mb-3" data-bs-effect="effect-scale" >Scale</a>-->
                            </tr>
                            
                            @endforeach
                        
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
    function deleteItem(id,name,sku,pieces){
        //alert(id);
        var itemDetails = document.getElementById("itemDetails");
        itemDetails.innerHTML = "Outlet Id: "+id+"<br/> Outlet Name: "+name;
        var confirmDeleteLink = document.getElementById('confirmDelete'); //or grab it by tagname etc
        confirmDeleteLink.href = "/deleteoutlet/"+id;
    }
  </script>