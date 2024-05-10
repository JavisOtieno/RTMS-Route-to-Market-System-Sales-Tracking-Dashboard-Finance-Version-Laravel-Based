@extends('layout')

@section('content')

<div class="side-app">

    <!-- CONTAINER -->
    <div class="main-container container-fluid">

  <!-- PAGE-HEADER -->
  <div class="page-header">
    <h1 class="page-title">Feedback</h1>
    <div>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">RTMS</a></li>
            <li class="breadcrumb-item active" aria-current="page">Feedback</li>
        </ol>
    </div>
</div>
<!-- PAGE-HEADER END -->


<div class="col-xl-12">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Feedback</h3>
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
                            <th>Feedback</th>
                            <th>Created</th>
                            <th>View</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                        @foreach($feedback as $feed)
<tr>
<td>{{$feed['id']}}</td>
<td>{{$feed['outlet']['name']}}</td>
<td>{{$feed['user']['name']}}</td>
<td>{{$feed['feedback']}}</td>
<td>{{$feed['created_at']}}</td>
<td><a type="button" href="/feedback/{{$feed['id']}}" class="btn btn-info" style="margin-left: auto;color:white;">View</a>
</td>
<td><a type="button" onclick="deleteItemDefault({{$feed['id']}},'{{$feed['outlet']['name']}}','{{$feed['user']['name']}}','feedback')"  class="btn btn-danger" style="margin-left: auto;color:white;" data-bs-toggle="modal" href="#modalDelete">Delete</a>

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

