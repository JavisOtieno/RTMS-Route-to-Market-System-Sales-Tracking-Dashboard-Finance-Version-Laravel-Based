@extends('layout')


@section('content')

<div class="side-app">

    <!-- CONTAINER -->
    <div class="main-container container-fluid">

  <!-- PAGE-HEADER -->
  <div class="page-header">
    <h1 class="page-title">Services</h1>
    <div>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">RTMS</a></li>
            <li class="breadcrumb-item active" aria-current="page">Services</li>
        </ol>
    </div>
</div>
<!-- PAGE-HEADER END -->


        <!-- Row -->
        
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Services</h3>
                        <a type="button" href="/add-service" class="btn btn-danger col-md-3" style="margin-left: auto;margin-right:20px;margin-top:10px;margin-bottom:10px;color:white;">Add Service</a>
                    </div>
                    <div class="row" style="margin: 0 10px;">
                        <input type="hidden" id="tableLoaded" value="products"/>
                        <h3 class="card-title" style="margin-top:20px;margin-block-end: 0rem;">Search by :</h3>
                        <div class="col-md-3 mb-3">
                            <label for="nameInput" class="form-label">Service Name</label>
                            <input type="text" class="form-control" id="nameInput" placeholder="Product Name">
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
                                        <th>Service Name</th>
                                        <th>Target Type</th>
                                        <th>Target</th>
                                        <th>Date</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                        @if(count($products)>0)
                                        @foreach($products as $product)
                                        <tr>
                                        <td>{{$product['id']}}</td>
                                       
                                        <td><a type="button" href="/editservice/{{$product['id']}}" class="btn btn-info" style="margin-left: auto;color:white;">View/Edit</a>
                                        </td>
                                        <td><a type="button" onclick="deleteItem({{$product['id']}},'{{$product['name']}}','{{$product['description']}}')"  class="btn btn-danger" style="margin-left: auto;color:white;" data-bs-toggle="modal" href="#modalDelete">Delete</a>
                                        </td>
                                        <td>{{$product['name']}}</td>
                                        <td>{{ucfirst($product['targettype'])}}</td>
                                        <td>{{($product['targettype']=='amount'?'KSh ':'').number_format($product['target'])}}</td>
                                        <td>{{date('d-M-Y', strtotime($product['created_at']))}}</td>

                                        
                                        {{-- <td>
                                            <form method="POST" action="{{ route('editproduct') }}">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $product->id }}">
                                                <!-- Other form fields -->
                                                <button type="submit" class="btn btn-info">View/Edit</button>
                                            </form>
                                        </td> --}}
                                        
                                        <!--<a class="modal-effect btn btn-primary-light d-grid mb-3" data-bs-effect="effect-scale" >Scale</a>-->
                                        </tr>
                                        
                                        @endforeach
                                        @else
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
    function deleteItem(id,name,description){
        //alert(id);
        var itemDetails = document.getElementById("itemDetails");
        itemDetails.innerHTML = "Service Id: "+id+"<br/> Service Name: "+name+"<br/> Description: "+description;
        var confirmDeleteLink = document.getElementById('confirmDelete'); //or grab it by tagname etc
        confirmDeleteLink.href = "/deleteservice/"+id;
    }
  </script>





