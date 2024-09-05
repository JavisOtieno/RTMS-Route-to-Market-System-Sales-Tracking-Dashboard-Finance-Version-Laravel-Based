@extends('layout')

@section('content')

<div class="side-app">

    <!-- CONTAINER -->
    <div class="main-container container-fluid">

  <!-- PAGE-HEADER -->
  <div class="page-header">
    <h1 class="page-title">POS Audits</h1>
    <div>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">RTMS</a></li>
            <li class="breadcrumb-item active" aria-current="page">POS Audits</li>
        </ol>
    </div>
</div>
<!-- PAGE-HEADER END -->


<div class="col-xl-12">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">POS Audits</h3>
        </div>
        <div class="row" style="margin: 0 10px;">
            <input type="hidden" id="tableLoaded" value="posaudits"/>
            <h3 class="card-title" style="margin-top:20px;margin-block-end: 0rem;">Search by :</h3>
            <div class="col-md-3 mb-3">
                <label for="name" class="form-label">Seller Name</label>
                <input type="text" class="form-control" id="nameInput" placeholder="Name">
            </div>
            <div class="col-md-3 mb-3">
                <label for="name" class="form-label">Product Name</label>
                <input type="text" class="form-control" id="productNameInput" placeholder="Product Name">
            </div>
            <div class="col-md-3 mb-3">
                <label for="outletName" class="form-label">Outlet Name</label>
                <input type="text" class="form-control" id="outletNameInput" placeholder="Outlet Name">
            </div>
            <div class="col-md-3 mb-3">
                <label for="teamName" class="form-label">Team</label>
                <input type="text" class="form-control" id="teamNameInput" placeholder="Team Name">
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
            <!--<p>Use <code class="highlighter-rouge">.table-striped</code>to add zebra-striping to any table row within the <code class="highlighter-rouge">.tbody</code>.</p>-->
            <div class="table-responsive">
                <table id="responsive-datatable" class="table table-bordered text-nowrap border-bottom">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th id="view-column">View/Edit</th>
                            <th id="delete-column">Delete</th>
                            <th>Seller Name</th>
                            <th>Outlet Name</th>
                            <th>Products Audited</th>
                            <th>Team</th>
                            <th>Date</th>
                            <th>Time</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        @if(count($posaudits)>0)
                        
                        @foreach($posaudits as $posaudit)
<tr>
<td>{{$posaudit['id']}}</td>
<td><a type="button" href="/posaudit/{{$posaudit['id']}}" 
    class="btn btn-info" style="margin-left: auto;color:white;">View/Edit</a>
</td>

<td><a type="button" onclick="deleteItemDefault({{$posaudit['id']}},'{{$posaudit['outlet']['name']}}','{{$posaudit['user']['name']}}','posaudits')"  class="btn btn-danger" style="margin-left: auto;color:white;" data-bs-toggle="modal" href="#modalDelete">Delete</a>
</td>
{{-- <td>{{$posaudit['user']['name']}}</td> --}}
<td>{{ $posaudit['user'] ? $posaudit['user']['name']  . ($posaudit['user']->trashed() ? ' (Deleted User)' : '') : 'Deleted User'}}
<td>{{$posaudit['outlet']['name']}}</td>
<?php $posaudititems="";$i=1;?>
@foreach($posaudit['posaudititems'] as $posaudititem)
<?php 
$posaudititemname=$posaudititem['product'] ? $posaudititem['product']['name']  
. ($posaudititem['product']->trashed() ? ' (Deleted Product)' : '') : 'Deleted Product';
$posaudititems=$posaudititems.$posaudititemname." - ".$posaudititem['pieces'];
$posaudititems.="\n"; 
//code that displays first two items
// if($i%2==0){$posaudititems.="\n"; }else{$posaudititems.="\n"; }$i++;
// if($i>2){$posaudititems.="...";break;}
?>
@endforeach
{{-- <td style="white-space: pre-line;">{{$posaudititems}}</td> --}}
<td style="
max-width: 100px;
white-space: nowrap;
overflow: hidden;
text-overflow: ellipsis;
display: block;
line-height: 1.2em;
max-height: 1.2em;
word-wrap: break-word;
">{{$posaudititems}}</td>
<td>{{$posaudit['team']==null?"None":$posaudit['team']['name']}}</td>

<td>{{date('d-M-Y', strtotime($posaudit['created_at']))}}</td>
<td>{{date('H:i', strtotime($posaudit['created_at']))}}</td>

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

@endsection

