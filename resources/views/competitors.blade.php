@extends('layout')

@section('content')

<div class="side-app">

    <!-- CONTAINER -->
    <div class="main-container container-fluid">

  <!-- PAGE-HEADER -->
  <div class="page-header">
    <h1 class="page-title">Competitor Analysis</h1>
    <div>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">RTMS</a></li>
            <li class="breadcrumb-item active" aria-current="page">Competitor Analysis</li>
        </ol>
    </div>
</div>
<!-- PAGE-HEADER END -->


<div class="col-xl-12">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Competitor Analysis</h3>
        </div>
        <div class="card-body">
            <!--<p>Use <code class="highlighter-rouge">.table-striped</code>to add zebra-striping to any table row within the <code class="highlighter-rouge">.tbody</code>.</p>-->
            <div class="table-responsive">
                <table id="responsive-datatable" class="table border text-nowrap text-md-nowrap table-striped mb-0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Outlet Name</th>
                            <th>User Name</th>
                            <th>Brand Visibility</th>
                            <th>Pricing</th>
                            <th>Created</th>
                            <th>View</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                        @foreach($competitors as $competitor)
                        
<tr>
<td>{{$competitor['id']}}</td>
<td>{{$competitor['outlet']['name']}}</td>
<td>{{$competitor['user']['name']}}</td>
<td  style="max-width: 100px;overflow: hidden;text-overflow: ellipsis;white-space: nowrap;">{{$competitor['brand_visibility']}}</td>
<td  style="max-width: 100px;overflow: hidden;text-overflow: ellipsis;white-space: nowrap;">{{$competitor['pricing']}}</td>
<td>{{date('Y-M-d H:i', strtotime($competitor['created_at']))}}</td>
<td><a type="button" href="/competitiveanalysis/{{$competitor['id']}}" class="btn btn-info" style="margin-left: auto;color:white;">View</a>
</td>
<td><a type="button" onclick="deleteItemDefault({{$competitor['id']}},'{{$competitor['outlet']['name']}}','{{$competitor['user']['name']}}','competitoranalysis')"  class="btn btn-danger" style="margin-left: auto;color:white;" data-bs-toggle="modal" href="#modalDelete">Delete</a>

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

