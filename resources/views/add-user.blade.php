@extends('layout-form')

@section('content')

<div class="side-app">

    <!-- CONTAINER -->
    <div class="main-container container-fluid">

  <!-- PAGE-HEADER -->
  <div class="page-header">
    <h1 class="page-title">Users</h1>
    <div>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">RTMS</a></li>
            <li class="breadcrumb-item active" aria-current="page">Sales</li>
        </ol>
    </div>
</div>
<!-- PAGE-HEADER END -->


<div class="col-xl-12 row">
    <div class="card col-md-8 ">
        <div class="card-header">
            <h3 class="card-title">Add User</h3> 
        </div>
        <div class="card-body">
            <!--<p>Use <code class="highlighter-rouge">.table-striped</code>to add zebra-striping to any table row within the <code class="highlighter-rouge">.tbody</code>.</p>-->
            
                
                    <form action="/saveuser" method="POST">
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
                                <input type="name" class="form-control" value="{{ old('name', '') }}" name="name" id="name" placeholder="Name" autocomplete="name">
                            </div>
                            <div class="form-group">
                                <label for="phone" class="form-label">Phone</label>
                                <input type="text" class="form-control" value="{{ old('phone', '') }}" name="phone"  placeholder="Phone" autocomplete="phone">
                            </div>
                            <div class="form-group">
                                <label for="email" class="form-label">Email</label>
                                <input type="text" class="form-control" name="email" value="{{ old('email', '') }}" id="email" placeholder="Email" autocomplete="email">
                            </div>
                            <div class="form-group">
                                <label for="admin" class="form-label">User Type</label>
                                <select name="usertype" class="form-control form-select select2" data-bs-placeholder="Select User Type">
                                                    <option {{old('usertype','')=="admin"? 'selected':''}} value="admin">Admin</option>
                                                    <option {{old('usertype','')=="sales"? 'selected':''}} value="sales">Sales</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="target_group_id" class="form-label">Target Group</label>
                                <select name="target_group_id" class="form-control form-select select2" data-bs-placeholder="Select Target Group">
                                    <option value="0">None</option>
                                        @foreach($targetgroups as $targetgroup)
                                        <option {{old('target_group_id','')==$targetgroup['id']? 'selected':''}} value="{{$targetgroup['id']}}">{{$targetgroup['name']." - KSh ".number_format($targetgroup['amount'])}}</option>
                                        @endforeach
                </select></div>
                            <div class="form-group">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" name="password" id="password" placeholder="Password" autocomplete="password">
                            </div>
                            <div class="form-group">
                                <label for="password_confirmation" class="form-label">Confirm Password</label>
                                <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" placeholder="Confirm Password"  autocomplete="password_confirmation">
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