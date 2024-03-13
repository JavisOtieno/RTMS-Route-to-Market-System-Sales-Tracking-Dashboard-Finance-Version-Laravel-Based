@extends('layout')

@section('content')

<div class="side-app">

    <!-- CONTAINER -->
    <div class="main-container container-fluid">

  <!-- PAGE-HEADER -->
  <div class="page-header">
    <h1 class="page-title">Geos</h1>
    <div>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">RTMS</a></li>
            <li class="breadcrumb-item active" aria-current="page">Geos</li>
        </ol>
    </div>
</div>
<!-- PAGE-HEADER END -->


<div class="col-xl-12">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Locations</h3>
        </div>
        <div class="card-body">
            <!--<p>Use <code class="highlighter-rouge">.table-striped</code>to add zebra-striping to any table row within the <code class="highlighter-rouge">.tbody</code>.</p>-->
            <div class="table-responsive">
                <table class="table border text-nowrap text-md-nowrap table-striped mb-0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>User Id</th>
                            <th>Lat</th>
                            <th>Long</th>
                            <th>Created</th>
                            <th>View</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                        @foreach($geos as $geo)
<tr>
<td>{{$geo['id']}}</td>
<td>{{$geo['user_id']}}</td>
<td>{{$geo['lat']}}</td>
<td>{{$geo['long']}}</td>
<td>{{$geo['created_at']}}</td>
<td><a href="javascript:void(0)" class="btn btn-secondary">View</a></td>
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