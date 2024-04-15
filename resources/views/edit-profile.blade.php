@extends('layout')

@section('content')

<div class="side-app">

    <!-- CONTAINER -->
    <div class="main-container container-fluid">

  <!-- PAGE-HEADER -->
  <div class="page-header">
    <h1 class="page-title">Profile</h1>
    <div>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">RTMS</a></li>
            <li class="breadcrumb-item active" aria-current="page">Profile</li>
        </ol>
    </div>
</div>
<!-- PAGE-HEADER END -->


<div class="col-xl-12 row">
    <div class="card col-md-8">
        <div class="card-header">
            <h3 class="card-title">View Profile</h3> 
        </div>
        <div class="card-body">
            <!--<p>Use <code class="highlighter-rouge">.table-striped</code>to add zebra-striping to any table row within the <code class="highlighter-rouge">.tbody</code>.</p>-->
            
                
            <div class="card">
                                    <div class="card-header">
                                        <div class="card-title">Profile Details</div>
                                    </div>
                                    <div class="card-body">
                                        <div class="text-center chat-image mb-5">
                                            <div class="avatar avatar-xxl chat-profile mb-3 brround">
                                                <a class="" href="profile.html"><img alt="avatar" src="../assets/images/users/7.jpg" class="brround"></a>
                                            </div>
                                            <div class="main-chat-msg-name">
                                                <a href="profile.html">
                                                    <h5 class="mb-1 text-dark fw-semibold">{{ auth()->user() ? ucfirst(auth()->user()->name) : '' }}</h5>
                                                </a>
                                                <p class="text-muted mt-0 mb-0 pt-0 fs-13">{{ auth()->user() ? ucfirst(auth()->user()->usertype) : '' }}</p>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label">Name</label>
                                            <div class="wrap-input100 validate-input input-group" id="Password-toggle">
                                                <input type="text" class="form-control" disabled value="{{ auth()->user() ? ucfirst(auth()->user()->name) : '' }}">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label">User Type</label>
                                            <div class="wrap-input100 validate-input input-group" id="Password-toggle1">
                                                <input type="text" class="form-control" disabled value="{{ auth()->user() ? ucfirst(auth()->user()->usertype) : '' }}">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label">Phone</label>
                                            <div class="wrap-input100 validate-input input-group" id="Password-toggle2">
                                                <input type="text" class="form-control" disabled value="{{ auth()->user() ? ucfirst(auth()->user()->phone) : '' }}">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label">Email</label>
                                            <div class="wrap-input100 validate-input input-group" id="Password-toggle2">
                                                <input type="text" class="form-control" disabled value="{{ auth()->user() ? ucfirst(auth()->user()->email) : '' }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer text-center" style="display: none">
                                        <a href="javascript:void(0)" class="btn btn-primary">Update</a>
                                        <a href="javascript:void(0)" class="btn btn-danger">Cancel</a>
                                    </div>
                                </div>
                
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