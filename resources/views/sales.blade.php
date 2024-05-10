@extends('layout')


@section('content')

<div class="side-app">

    <!-- CONTAINER -->
    <div class="main-container container-fluid">

  <!-- PAGE-HEADER -->
  <div class="page-header">
    <h1 class="page-title">Sales</h1>
    <div>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">RTMS</a></li>
            <li class="breadcrumb-item active" aria-current="page">Sales</li>
        </ol>
    </div>
</div>
<!-- PAGE-HEADER END -->


        <!-- Row -->
        
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Sales Transactions</h3>
                        <!--<a type="button" href="/add-sale" class="btn btn-danger col-md-3" style="margin-left: auto;margin-right:20px;margin-top:10px;margin-bottom:10px;color:white;">Add Sale</a>-->
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="responsive-datatable" class="table table-bordered text-nowrap border-bottom">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Seller Name</th>
                                        <th>Outlet Name</th>
                                        <th>Products Sold</th>
                                        <th>Pieces</th>
                                        <th>Created</th>
                                        <th>View</th>
                                        <!--<th>View/Edit</th>-->
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(count($sales)>0)
                                    @foreach($sales as $sale)
                                    <?php $saleitems="";$i=1;
                                        //print_r($sale['saleitems']);
                                        ?>
                                    @foreach($sale['saleitems'] as $saleitem)
                                        <?php $saleitems=$saleitems.$saleitem['product']['name']." - ".$saleitem['pieces'];
                                        if($i%2==0){$saleitems.="\n"; }else{$saleitems.="\n"; }$i++;
                                        if($i>2){$saleitems.="...";break;}?>
                                        @endforeach
                                    <tr>                                        
                                        <td>{{$sale['id']}}</td>
                                        <td>{{$sale['user']['name']}}</td>
                                        <td>{{$sale['outlet']['name']}}</td>
                                        <td style="white-space: pre-line;">{{$saleitems}}</td>
                                        <td>{{$sale['pieces']}}</td>
                                        <td>{{'KSh '.number_format($sale['value'])}}</td>
                                        <!--<td><a type="button" href="/editsale/{{$sale['id']}}" class="btn btn-info" style="margin-left: auto;color:white;">View/Edit</a>
                                        </td>-->
                                        <td><a type="button" href="/sale/{{$sale['id']}}" class="btn btn-info" style="margin-left: auto;color:white;">View</a>
                                        </td>
                                        <td><a type="button" onclick="deleteItem({{$sale['id']}},'{{$sale['outlet']['name']}}','{{$sale['user']['name']}}',{{$sale['pieces']}})"  class="btn btn-danger" style="margin-left: auto;color:white;" data-bs-toggle="modal" href="#modalDelete">Delete</a>
                                        </td>
                                        <!--<a class="modal-effect btn btn-primary-light d-grid mb-3" data-bs-effect="effect-scale" >Scale</a>-->
                                        </tr>
                                        @endforeach
                                    
                                    @else
                                    <!--<tr><td colspan="7" style="text-align: center">No sales so far</td></tr>-->
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
    function deleteItem(id,name,sellerName,pieces){
        //alert(id);
        var itemDetails = document.getElementById("itemDetails");
        itemDetails.innerHTML = "Sale Id: "+id+"<br/> Outlet Name: "+name+"<br/> Seller Name: "+sellerName+"<br/> Pieces: "+pieces;
        var confirmDeleteLink = document.getElementById('confirmDelete'); //or grab it by tagname etc
        confirmDeleteLink.href = "/deletesale/"+id;
    }
  </script>







