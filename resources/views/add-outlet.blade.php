@extends('layout-form')

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
            
                
                    <form action="/saveoutlet" method="POST" enctype="multipart/form-data">
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
                                <label class="form-label"> Users</label>
                                <select class="form-control select2-show-search form-select" name="userId" id="userId" data-placeholder="Choose one">
                                        <option label="Choose one"></option>
                                        @foreach($users as $user)
                                        <option {{old('userId','')==$user['id']? 'selected':''}} value="{{$user['id']}}">{{$user['name']}}</option>
                                        @endforeach
                                        
                                    </select>
                            </div>
                            <div class="form-group">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" name="name" id="name" placeholder="Name" autocomplete="name" value="{{ old('name', '') }}">
                            </div>
                            <div class="form-group">
                                <label for="contactName" class="form-label">Contact Name</label>
                                <input type="text" class="form-control" name="contactName" id="contactName" placeholder="Contact Name" autocomplete="contactName" value="{{ old('contactName', '') }}">
                            </div>
                            <div class="form-group">
                                <label for="phone" class="form-label">Phone</label>
                                <input type="text" class="form-control" name="phone"  placeholder="Phone" autocomplete="phone" value="{{ old('phone', '') }}">
                            </div>
                            <div class="form-group">
                                <label for="lat" class="form-label">Lat</label>
                                <input type="text" class="form-control" name="lat" id="lat" placeholder="Lat" autocomplete="lat" value="{{ old('lat', '') }}">
                            </div>
                            <div class="form-group">
                                <label for="long" class="form-label">Long</label>
                                <input type="text" class="form-control" name="long" id="long" placeholder="Long" autocomplete="long" value="{{ old('long', '') }}">
                            </div>
                            <div class="form-group">
                                <label for="image" class="form-label">Image (Optional)</label>
                                <div class="col-lg-4 col-sm-12 mb-4 mb-lg-0">
                                    <input name="image" type="file" class="dropify" data-bs-height="180">
                                </div>
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