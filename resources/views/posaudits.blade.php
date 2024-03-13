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
                <table class="table border text-nowrap text-md-nowrap table-striped mb-0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>User Id</th>
                            <th>Name</th>
                            <th>SKU</th>
                            <th>Pieces</th>
                            <th>Created</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                        @foreach($posaudits as $posaudit)
<tr>
<td>{{$posaudit['id']}}</td>
<td>{{$posaudit['user_id']}}</td>
<td>{{$posaudit['name']}}</td>
<td>{{$posaudit['sku']}}</td>
<td>{{$posaudit['pieces']}}</td>
<td>{{$posaudit['created_at']}}</td>
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

@endsection