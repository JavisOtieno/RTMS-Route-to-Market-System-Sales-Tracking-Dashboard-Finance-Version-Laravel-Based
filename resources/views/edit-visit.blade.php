@extends('layout-form')

@section('content')

<div class="side-app">

    <!-- CONTAINER -->
    <div class="main-container container-fluid">

  <!-- PAGE-HEADER -->
  <div class="page-header">
    <h1 class="page-title">Visits</h1>
    <div>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">RTMS</a></li>
            <li class="breadcrumb-item active" aria-current="page">Visits</li>
        </ol>
    </div>
</div>
<!-- PAGE-HEADER END -->


<div class="col-xl-12 row">
    <div class="card col-md-8">
        <div class="card-header">
            <h3 class="card-title">View Visit</h3> 
        </div>
        <div class="card-body">
            <!--<p>Use <code class="highlighter-rouge">.table-striped</code>to add zebra-striping to any table row within the <code class="highlighter-rouge">.tbody</code>.</p>-->
            
                
                    <form action="/saveeditvisit/{{$visit['id']}}" method="POST">
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
                                <input readonly name="sellerName" class="form-control" name="sellerName" id="sellerName" placeholder="Seller Name" value="{{$visit['user']['name']}}" autocomplete="sellerName">
                            </div>
                            <div class="form-group">
                                
                                <label for="outletName" class="form-label">Outlet Name</label>
                                <input readonly type="text" class="form-control" name="outletName" id="outleName" placeholder="Outlet Name" value="{{$visit['outlet']['name']}}" autocomplete="outletname">
                            </div>
              
                            <div class="form-group">
                                <label for="checkinTime" class="form-label">Checkin Time</label>
                                <input readonly type="text" class="form-control" name="checkinTime" id="checkinTime" placeholder="Checkin Time" value="{{date('H:i', $visit['checkin_time'])}}" autocomplete="checkinTime">
                            </div>
                            <div class="form-group">
                                <label for="checkoutTime" class="form-label">Checkout Time</label>
                                @if($visit['checkout_time']=="")
                                <input readonly type="text" class="form-control" name="checkoutTime" id="checkoutTime" placeholder="Checkout Time" value="{{$visit['checkout_time']}}" autocomplete="checkoutTime">
                                        @else
                                        <input readonly type="text" class="form-control" name="checkoutTime" id="checkoutTime" placeholder="Checkout Time" value="{{date('H:i',$visit['checkout_time'])}}" autocomplete="checkoutTime">
                                        @endif
                            </div>
                            <div class="form-group">
                                <label for="duration" class="form-label">Duration</label>
                                @if($visit['checkout_time']=="")
                                        <input readonly type="text" class="form-control" name="duration" id="duration" placeholder="Duration" value="{{gmdate("H:i", strtotime(0))}}" autocomplete="value">
                                        @else
                                        <input readonly type="text" class="form-control" name="duration" id="duration" placeholder="Duration" value="{{gmdate("H:i", $visit['checkout_time']-strtotime($visit['created_at']))}}" autocomplete="value">
                                        @endif
                            </div>
                            <div class="form-group">
                                <label for="dateTime" class="form-label">Date and Time</label>
                                <input readonly type="text" class="form-control" name="dateTime" id="dateTime" placeholder="DateTime" value="{{date('Y-M-d H:i', strtotime($visit['created_at']))}}" autocomplete="dateTime">
                            </div>
                            
                        </div>
                        <!--<button class="btn btn-primary mt-4 mb-0">Save</button>-->
                    </form>
                
            </div>

        </div>
    
    <div class="col-md-3">

        <div class="card" style="width: 18rem;height:95%;background-color:#F7F7F9">
      <div class="card-body">
        <h5 class="card-title">Quick Tips</h5>
        <p class="card-text">This is the quick tips section. Expect highlights on how best to use the system.</p>
      </div>
    </div>
    
        </div>
</div>
</div>

    </div>
</div>

@endsection