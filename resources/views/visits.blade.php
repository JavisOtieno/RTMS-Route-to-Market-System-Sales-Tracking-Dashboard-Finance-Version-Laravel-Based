@extends('layout')


@section('content')

<div class="side-app">

    <!-- CONTAINER -->
    <div class="main-container container-fluid">

  <!-- PAGE-HEADER -->
  <div class="page-header">
    <h1 class="page-title">Visits</h1>
    <div>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">RTMS</a></li>
            <li class="breadcrumb-item active" aria-current="page">Visits</li>
        </ol>
    </div>
</div>
<!-- PAGE-HEADER END -->


        <!-- Row -->
        
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Outlet Visits </h3>
                   </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example2" class="table table-bordered text-nowrap border-bottom">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Seller Name</th>
                                        <th>Outlet Name</th>
                                        <th>Date</th>
                                        <th>Check In Time</th>
                                        <th>Check Out Time</th>
                                        <th>Duration</th>
                                        <!--<th>Duration</th>-->
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                        @if(count($visits)>0)
                                        @foreach($visits as $visit)
                                        <tr>
                                        <td>{{$visit['id']}}</td>
                                        <td>{{$visit['user']['name']}}</td>
                                        <td>{{$visit['outlet']['name']}}</td>
                                        <td>{{date('Y-m-d', strtotime($visit['created_at']))}}</td>
                                        <td>{{date('H:i', strtotime($visit['created_at']))}}</td>
                                        <td>{{date('H:i',$visit['checkout_time'])}}</td>
                                        <td>{{gmdate("H:i", strtotime($visit['created_at'])-$visit['checkout_time'])}}</td>
                                        <!--<td>$visit['duration']</td>-->
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
    function deleteItem(id,name,sku,pieces){
        //alert(id);
        var itemDetails = document.getElementById("itemDetails");
        itemDetails.innerHTML = "Sale Id: "+id+"<br/> Product Name: "+name+"<br/> SKU: "+sku+"<br/> Pieces: "+pieces;
        var confirmDeleteLink = document.getElementById('confirmDelete'); //or grab it by tagname etc
        confirmDeleteLink.href = "/deletesale/"+id;
    }
  </script>





