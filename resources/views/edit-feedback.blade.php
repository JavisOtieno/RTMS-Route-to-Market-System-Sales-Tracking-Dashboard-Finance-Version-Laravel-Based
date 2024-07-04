@extends('layout-form')

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


<div class="col-xl-12 row">
    <div class="card col-md-8">
        <div class="card-header">
            <h3 class="card-title">View Feedback</h3> 
        </div>
        <div class="card-body">
            <!--<p>Use <code class="highlighter-rouge">.table-striped</code>to add zebra-striping to any table row within the <code class="highlighter-rouge">.tbody</code>.</p>-->
            
                
                    <form action="/saveeditsale/{{$feedback['id']}}" method="POST">
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
                                {{-- value="{{$feedback['user']['name']}}" --}}
                                value="{{ $feedback['user'] ? $feedback['user']['name']  . ($feedback['user']->trashed() ? ' (Deleted User)' : '') : 'Deleted User'}}" 
                                 autocomplete="sellerName">
                            </div>
                            <div class="form-group">
                                
                                <label for="outletName" class="form-label">Outlet Name</label>
                                <input readonly type="text" class="form-control" name="outletName" id="outleName" placeholder="Outlet Name" value="{{$feedback['outlet']['name']}}" autocomplete="outletname">
                            </div>
              
                            <div class="form-group">
                                <label for="dateTime" class="form-label">Date and Time</label>
                                <input readonly type="text" class="form-control" name="dateTime" id="dateTime" placeholder="DateTime" value="{{date('d-M-Y H:i', strtotime($feedback['created_at']))}}" autocomplete="dateTime">
                            </div>

                            <div class="form-group">
                                <label for="feedback" class="form-label">Feedback</label>
                                <textarea type="text" readonly rows="6" class="form-control" name="feedback" id="description" placeholder="feedback" autocomplete="long">{{$feedback['feedback']}}</textarea>
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
                <li style="margin-bottom: 10px;"><strong>Outlet Name</strong> : This field displays the latitude of the location.</li>
                <li style="margin-bottom: 10px;"><strong>Date and Time</strong>: This field displays the date and time of the feedback.</li>
                <li style="margin-bottom: 10px;"><strong>Feedback </strong>:  This field displays the feedback provided.</li>
            </ol>
      </div>
    </div>
    
        </div>
</div>
</div>

    </div>
</div>

@endsection