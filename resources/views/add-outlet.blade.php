@extends('layout')

@section('content')

<div class="side-app">

    <!-- CONTAINER -->
    <div class="main-container container-fluid">

  <!-- PAGE-HEADER -->
  <div class="page-header">
    <h1 class="page-title">Outlets</h1>
    <div>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">RTMS</a></li>
            <li class="breadcrumb-item active" aria-current="page">Outlets</li>
        </ol>
    </div>
</div>
<!-- PAGE-HEADER END -->


<div class="col-xl-12 row">
    <div class="card col-md-8 ">
        <div class="card-header">
            <h3 class="card-title">Add Outlet</h3> 
        </div>
        <div class="card-body">
            <!--<p>Use <code class="highlighter-rouge">.table-striped</code>to add zebra-striping to any table row within the <code class="highlighter-rouge">.tbody</code>.</p>-->
            
                
                    <form action="/saveoutlet" method="POST">
                        @csrf
                        @method('POST')
                        <div class="">
                            
                            <div class="form-group">
                                <label for="userId" class="form-label">User Id</label>
                                <input type="text" class="form-control" name="userId" id="userId" placeholder="User Id" autocomplete="userId">
                            </div>
                            <div class="form-group">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" name="name" id="name" placeholder="Name" autocomplete="name">
                            </div>
                            <div class="form-group">
                                <label for="contactName" class="form-label">Contact Name</label>
                                <input type="text" class="form-control" name="contactName" id="contactName" placeholder="Contact Name" autocomplete="contactName">
                            </div>
                            <div class="form-group">
                                <label for="phone" class="form-label">Phone</label>
                                <input type="text" class="form-control" name="phone" id="phone" placeholder="Phone" autocomplete="phone">
                            </div>
                            <div class="form-group">
                                <label for="lat" class="form-label">Lat</label>
                                <input type="text" class="form-control" name="lat" id="lat" placeholder="Lat" autocomplete="lat">
                            </div>
                            <div class="form-group">
                                <label for="long" class="form-label">Long</label>
                                <input type="text" class="form-control" name="long" id="long" placeholder="Long" autocomplete="long">
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
            <p class="card-text">This is the quick tips section. Expect highlights on how best to use the system.</p>
          </div>
        </div>
        
            </div>
    </div>
</div>

    </div>
</div>

@endsection