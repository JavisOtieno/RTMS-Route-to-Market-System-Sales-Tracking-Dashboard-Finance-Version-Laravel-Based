@extends('layout-form')

@section('content')

<div class="side-app">

    <!-- CONTAINER -->
    <div class="main-container container-fluid">

  <!-- PAGE-HEADER -->
  <div class="page-header">
    <h1 class="page-title">Offplan Request</h1>
    <div>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">RTMS</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit Offplan Request</li>
        </ol>
    </div>
</div>
<!-- PAGE-HEADER END -->


<div class="col-xl-12 row">
    <div class="card col-md-8">
        <div class="card-header">
            <h3 class="card-title">Edit Offplan Request</h3> 
        </div>
        <div class="card-body">
            <!--<p>Use <code class="highlighter-rouge">.table-striped</code>to add zebra-striping to any table row within the <code class="highlighter-rouge">.tbody</code>.</p>-->
            
                
                    <form action="/saveeditoffplanrequest/{{$offplanrequest['id']}}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="">
                            @if ($errors->any())
                            <div class="alert alert-danger alert-dismissible">
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>
                                            @if ($error == 'Any special error')
                                            Any special error
                                            @else
                                            {{ $error }}
                                            @endif
                                            </li>
                                    @endforeach
                                </ul>
                            </div>
                            @endif
                            <div class="form-group">
                                <label for="sellerName" class="form-label">Seller Name</label>
                                <input type="text" class="form-control" name="sellerName" value="{{old('sellerName',$offplanrequest['user']['name'])}}" id="sellerName" placeholder="Seller Name" readonly  autocomplete="sellerName">
                            </div>
                            <div class="form-group">
                                <label for="routeplanName" class="form-label">Route Plan Name</label>
                                <input type="text" class="form-control" name="routeplanName" value="{{old('',$offplanrequest['routeplan']['name'])}}" id="routeplanName" placeholder="Route Plan Name" readonly autocomplete="routePlanName">
                            </div>
                            
                            <div class="form-group">
                                <label for="status" class="form-label">Status</label>
                                <select name="status" class="form-control form-select select2" data-bs-placeholder="Select Status">
                                    <option value="pending" {{$offplanrequest["status"]=='pending'?'selected':'' }}>Pending</option>
                                    <option value="approved" {{$offplanrequest["status"]=='approved'?'selected':'' }}>Approved</option>
                                    <option value="disapproved" {{$offplanrequest["status"]=='disapproved'?'selected':'' }}>Disapproved</option>
                                </select>
                            </div>
                   
                        </div>

                        <button class="btn btn-primary col-12 mt-4 mb-0">Save</button>
                    </form>
                
            </div>

        </div>
    
    <div class="col-md-3">

        <div class="card" style="width: 18rem;height:95%;background-color:#F7F7F9">
      <div class="card-body">
        <h5 class="card-title">Quick Tips</h5>
        <ol class="card-text">
        <li style="margin-bottom: 10px;"><strong>Name</strong>: Enter the name of the organization. It is editable and pre-filled with the existing value.</li>
        <li style="margin-bottom: 10px;"><strong>Phone</strong>: Enter the organization phone. It is editable and pre-filled with the existing value.</li>
        </ol>
      </div>
    </div>
    
        </div>
</div>
</div>

    </div>
</div>

@endsection