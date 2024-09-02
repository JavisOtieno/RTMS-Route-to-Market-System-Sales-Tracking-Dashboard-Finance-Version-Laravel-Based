@extends('layout-form')

@section('content')

<div class="side-app">

    <!-- CONTAINER -->
    <div class="main-container container-fluid">

  <!-- PAGE-HEADER -->
  <div class="page-header">
    <h1 class="page-title">Clockins</h1>
    <div>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">RTMS</a></li>
            <li class="breadcrumb-item active" aria-current="page">Clockins</li>
        </ol>
    </div>
</div>
<!-- PAGE-HEADER END -->


<div class="col-xl-12 row">
    <div class="card col-md-8">
        <div class="card-header">
            <h3 class="card-title">View Clockin</h3> 
        </div>
        <div class="card-body">
            <!--<p>Use <code class="highlighter-rouge">.table-striped</code>to add zebra-striping to any table row within the <code class="highlighter-rouge">.tbody</code>.</p>-->
            
                
                    <form action="/saveeditclockin/{{$clockin['id']}}" method="POST">
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
                                <label for="userId" class="form-label">Seller Name</label>
                                <input readonly name="sellerName" class="form-control" name="sellerName" id="sellerName" placeholder="Seller Name" 
                                value="{{ $clockin['user'] ? $clockin['user']['name']  . ($clockin['user']->trashed() ? ' (Deleted User)' : '') : 'Deleted User'}}" 
                                autocomplete="sellerName">
                            </div>
              
                            <div class="form-group">
                                <label for="userId" class="form-label">Latitude</label>
                                <input readonly name="latitude" class="form-control" name="latitude" id="latitude" placeholder="Latitude" value="{{$clockin['lat']}}" autocomplete="sellerName">
                            </div>

                            <div class="form-group">
                                <label for="userId" class="form-label">Longitude</label>
                                <input readonly name="longitude" class="form-control" name="longitude" id="longitude" placeholder="Longitude" value="{{$clockin['long']}}" autocomplete="sellerName">
                            </div>

                            <div class="form-group">
                                <label for="dateTime" class="form-label">Clockin Date and Time</label>
                                <input readonly type="text" class="form-control" name="dateTime" id="dateTime" placeholder="DateTime" value="{{date('d-M-Y H:i', strtotime($clockin['created_at']))}}" autocomplete="dateTime">
                            </div>

                            <div class="form-group">
                                <label for="dateTime" class="form-label">Clockout Date and Time</label>
                                <input readonly type="text" class="form-control" name="dateTime" id="dateTime" placeholder="DateTime" value="{{$clockin['clockout']==""?'Not Clocked Out':date('d-M-Y H:i', strtotime($clockin['clockout']['created_at']))}}" autocomplete="dateTime">
                            </div>

                            <div class="form-group">
                                <label for="clockinActivities" class="form-label">Clockin Visits</label>
                                <a href="/visits/{{$clockin['id']}}/clockin" class="btn btn-info col-md-12 mt-0 mb-2">View Clockin Visits</a>

                                <a href="/sales/{{$clockin['id']}}/clockin" class="btn btn-info col-md-12 mt-0 mb-2">View Clockin Sales</a>
                                <a href="/posaudits/{{$clockin['id']}}/clockin" class="btn btn-info col-md-12 mt-0 mb-2">View Clockin POS Audits</a>
                                <a href="/competitiveanalysis/{{$clockin['id']}}/clockin" class="btn col-md-12 btn-info mt-0 mb-2">View Clockin Competitive Analysis</a>
                                <a href="/feedback/{{$clockin['id']}}/clockin" class="btn btn-info col-md-12 mt-0 mb-2">View Clockin Feedback</a>
                                
                            </div>
                            
                        </div>
                        {{-- <button class="btn btn-primary mt-4 mb-0">Save</button> --}}
                    </form>
                
            </div>

        </div>
    
    <div class="col-md-3">

        <div class="card" style="width: 18rem;height:95%;background-color:#F7F7F9">
      <div class="card-body">
        <h5 class="card-title">Quick Tips</h5>
        <ol class="card-text">
            <li style="margin-bottom: 10px;"><strong>Seller Name</strong> : This field displays the name of the seller.</li>
            <li style="margin-bottom: 10px;"><strong>Latitude</strong> : This field displays the latitude of the location.</li>
            <li style="margin-bottom: 10px;"><strong>Longitude</strong> : This field displays the longitude of the location.</li>
            <li style="margin-bottom: 10px;"><strong>Date and Time</strong>: This field displays the date and time of the clock-in.</li>
        </ol>

            
</div>
    </div>
    
        </div>
</div>
</div>

    </div>
</div>

@endsection