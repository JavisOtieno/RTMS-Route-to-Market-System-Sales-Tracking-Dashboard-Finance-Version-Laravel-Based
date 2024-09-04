@extends('layout-form')

@section('content')

<div class="side-app">

    <!-- CONTAINER -->
    <div class="main-container container-fluid">

  <!-- PAGE-HEADER -->
  <div class="page-header">
    <h1 class="page-title">Teams</h1>
    <div>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">RTMS</a></li>
            <li class="breadcrumb-item active" aria-current="page">Add Team</li>
        </ol>
    </div>
</div>
<!-- PAGE-HEADER END -->


<div class="col-xl-12 row">
    <div class="card col-md-8">
        <div class="card-header">
            <h3 class="card-title">Add Team</h3> 
        </div>
        <div class="card-body">
            <!--<p>Use <code class="highlighter-rouge">.table-striped</code>to add zebra-striping to any table row within the <code class="highlighter-rouge">.tbody</code>.</p>-->
            
                
                    <form action="/saveteam" method="POST">
                        @csrf
                        @method('POST')
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
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" name="name" id="name" placeholder="Name"  autocomplete="name">
                            </div>
                            <div class="form-group">
                                <label for="phone" class="form-label">Phone</label>
                                <input type="text" class="form-control" name="name" id="name" placeholder="Name"  autocomplete="name">
                            </div>
                            <div class="form-group">
                                <label for="phone" class="form-label">Email</label>
                                <input type="text" class="form-control" name="name" id="name" placeholder="Name"  autocomplete="name">
                            </div>
                            <div class="form-group">
                                <label for="phone" class="form-label">Organization Reg No</label>
                                <input type="text" class="form-control" name="name" id="name" placeholder="Name"  autocomplete="name">
                            </div>
                            <div class="form-group">
                                <label for="phone" class="form-label">Admin Name</label>
                                <input type="text" class="form-control" name="name" id="name" placeholder="Admin Name"  autocomplete="name">
                            </div>
                            <div class="form-group">
                                <label for="phone" class="form-label">Admin Phone</label>
                                <input type="text" class="form-control" name="name" id="name" placeholder="Admin Phone"  autocomplete="name">
                            </div>
                            <div class="form-group">
                                <label for="phone" class="form-label">Admin Email</label>
                                <input type="text" class="form-control" name="name" id="name" placeholder="Admin Email"  autocomplete="name">
                            </div>
                            <div class="form-group">
                                <label for="phone" class="form-label">Password</label>
                                <input type="passoword" class="form-control" name="name" id="name" placeholder="Password"  autocomplete="name">
                            </div>
                            <div class="form-group">
                                <label for="phone" class="form-label">Confirm Password</label>
                                <input type="password" class="form-control" name="name" id="name" placeholder="Confirm Password"  autocomplete="name">
                            </div>
                            
                            
                            
                        </div>
                        <button class="btn btn-primary mt-4 mb-0">Save</button>
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