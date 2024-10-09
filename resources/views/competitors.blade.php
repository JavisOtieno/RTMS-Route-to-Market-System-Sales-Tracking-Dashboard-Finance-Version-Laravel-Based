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
        <div class="row" style="margin: 0 10px;">
            <input type="hidden" id="tableLoaded" value="competitoranalysis"/>
            <h3 class="card-title" style="margin-top:20px;margin-block-end: 0rem;">Search by :</h3>
            <div class="col-md-3 mb-3">
                <label for="name" class="form-label">Seller Name</label>
                <input type="text" class="form-control" id="nameInput" placeholder="Name">
            </div>
            <div class="col-md-3 mb-3">
                <label for="outletName" class="form-label">Customer Name</label>
                <input type="text" class="form-control" id="outletNameInput" placeholder="Customer Name">
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
                            <th>Customer Name</th>
                            <th>Brand Visibility</th>
                            <th>Pricing</th>
                            <th>Team</th>
                            <th>Date</th>
                            <th>Time</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        
                        @foreach($competitors as $competitor)
                        
<tr>
<td>{{$competitor['id']}}</td>
<td><a type="button" href="/competitiveanalysis/{{$competitor['id']}}" class="btn btn-info" style="margin-left: auto;color:white;">View/Edit</a>
</td>
<td><a type="button" onclick="deleteItemDefault({{$competitor['id']}},'{{$competitor['outlet']['name']}}','{{$competitor['user']['name']}}','competitoranalysis')"  class="btn btn-danger" style="margin-left: auto;color:white;" data-bs-toggle="modal" href="#modalDelete">Delete</a>

{{-- <td>{{$competitor['user']['name']}}</td> --}}
<td>{{$competitor['user'] ? $competitor['user']['name']  . ($competitor['user']->trashed() ? ' (Deleted User)' : '') : 'Deleted User'}}
<td>{{$competitor['outlet']['name']}}</td>
<td  style="max-width: 100px;overflow: hidden;text-overflow: ellipsis;white-space: nowrap;">{{$competitor['brand_visibility']}}</td>
<td  style="max-width: 100px;overflow: hidden;text-overflow: ellipsis;white-space: nowrap;">{{$competitor['pricing']}}</td>
<td>{{$competitor['team']==null?"None":$competitor['team']['name']}}</td>
<td>{{date('d-M-Y', strtotime($competitor['created_at']))}}</td>
<td>{{date('H:i', strtotime($competitor['created_at']))}}</td>

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

