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
                <table id="example2" class="table border text-nowrap text-md-nowrap table-striped mb-0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Outlet name</th>
                            <th>User Name</th>
                            <th>POS Audit Items</th>
                            <th>Created</th>
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
<?php $posaudititems=""?>
@foreach($posaudit['posaudititems'] as $posaudititem)
<?php $posaudititems=$posaudititems.$posaudititem['product']['name']." - ".$posaudititem['pieces']." | ";?>
@endforeach
<td>{{$posaudititems}}</td>
<td>{{$posaudit['created_at']}}</td>
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

