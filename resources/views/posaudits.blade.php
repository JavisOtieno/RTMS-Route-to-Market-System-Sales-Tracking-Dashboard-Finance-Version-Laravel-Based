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
        <div class="card-body">
            <!--<p>Use <code class="highlighter-rouge">.table-striped</code>to add zebra-striping to any table row within the <code class="highlighter-rouge">.tbody</code>.</p>-->
            <div class="table-responsive">
                <table id="responsive-datatable" class="table border text-nowrap text-md-nowrap table-striped mb-0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Outlet name</th>
                            <th>Seller Name</th>
                            <th>Products Audited</th>
                            <th>Created</th>
                            <th>View</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(count($posaudits)>0)
                        
                        @foreach($posaudits as $posaudit)
<tr>
<td>{{$posaudit['id']}}</td>
<td>{{$posaudit['outlet']['name']}}</td>
<td>{{$posaudit['user']['name']}}</td>
<?php $posaudititems="";$i=1;?>
@foreach($posaudit['posaudititems'] as $posaudititem)
<?php $posaudititems=$posaudititems.$posaudititem['product']['name']." - ".$posaudititem['pieces'];
if($i%2==0){$posaudititems.="\n"; }else{$posaudititems.="\n"; }$i++;
if($i>2){$posaudititems.="...";break;}
?>
@endforeach
<td style="white-space: pre-line;">{{$posaudititems}}</td>
<td>{{date('Y-M-d H:i', strtotime($posaudit['created_at']))}}</td>
<td><a type="button" href="/posaudit/{{$posaudit['id']}}" class="btn btn-info" style="margin-left: auto;color:white;">View</a>
</td>
<td><a type="button" onclick="deleteItemDefault({{$posaudit['id']}},'{{$posaudit['outlet']['name']}}','{{$posaudit['user']['name']}}','posaudits')"  class="btn btn-danger" style="margin-left: auto;color:white;" data-bs-toggle="modal" href="#modalDelete">Delete</a>
</td>
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

