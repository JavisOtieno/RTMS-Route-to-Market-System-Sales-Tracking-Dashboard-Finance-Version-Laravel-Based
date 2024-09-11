@extends('layout-form')

@section('content')

<div class="side-app">

    <!-- CONTAINER -->
    <div class="main-container container-fluid">

  <!-- PAGE-HEADER -->
  <div class="page-header">
    <h1 class="page-title">Organizations</h1>
    <div>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">RTMS</a></li>
            <li class="breadcrumb-item active" aria-current="page">Add Organization</li>
        </ol>
    </div>
</div>
<!-- PAGE-HEADER END -->


<div class="col-xl-12 row">
    <div class="card col-md-8">
        <div class="card-header">
            <h3 class="card-title">Edit Organization</h3> 
        </div>
        <div class="card-body">
            <!--<p>Use <code class="highlighter-rouge">.table-striped</code>to add zebra-striping to any table row within the <code class="highlighter-rouge">.tbody</code>.</p>-->
            
                
                    <form action="/saveeditorganization/{{$organization['id']}}" method="POST">
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
                                <label for="name" class="form-label">Organization Name</label>
                                <input type="text" class="form-control" name="organizationName" value="{{old('organizationName',$organization['name'])}}" id="organizationName" placeholder="Organization Name"  autocomplete="organizationName">
                            </div>
                            <div class="form-group">
                                <label for="phone" class="form-label">Organization Phone</label>
                                <input type="text" class="form-control" name="organizationPhone" value="{{old('organizationPhone',$organization['phone'])}}" id="organizationPhone" placeholder="Organization Phone"  autocomplete="organizationPhone">
                            </div>
                            <div class="form-group">
                                <label for="phone" class="form-label">Organization Email</label>
                                <input type="text" class="form-control" name="organizationEmail" value="{{old('organizationEmail',$organization['email'])}}" id="organizationEmail" placeholder="Organization Email"  autocomplete="organizationEmail">
                            </div>
                            <div class="form-group">
                                <label for="phone" class="form-label">Organization Reg No</label>
                                <input type="text" class="form-control" name="organizationRegNo" value="{{old('organizationRegNo',$organization['registration_number'])}}" id="organizationRegNo" placeholder="Organization Reg No"  autocomplete="organizationRegNo">
                            </div>
                            <div class="form-group">
                                <label for="phone" class="form-label">Organization KRA Pin</label>
                                <input type="text" class="form-control" name="organizationKRAPin" value="{{old('organizationKRAPin',$organization['kra_pin'])}}" id="organizationKRAPin" placeholder="Organization KRA Pin"  autocomplete="OrganizationKRAPin">
                            </div>

                            <div class="form-group">
                                <label for="organizationStatus" class="form-label">Organization Status</label>
                                <select name="organizationStatus" class="form-control form-select select2" data-bs-placeholder="Select Status">
                                    <option value="active" {{$organization["status"]=='active'?'selected':'' }}>Active</option>
                                    <option value="inactive" {{$organization["status"]=='inactive'?'selected':'' }}>Inactive</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="password" class="form-label">Admin</label>
                                <a href="/editadmin/{{$organization->admin['id']}}" class="col-12 btn btn-info mb-0">Edit Admin</a>                            
                            </div>

                            <div class="form-group">
                                <label for="password" class="form-label">Admin</label>     
                                <a href="/admins/{{$organization['id']}}/organization" class="btn btn-info col-md-12 mt-0 mb-2">View Organization Admins</a>
                                <a href="/teamleads/{{$organization['id']}}/organization" class="btn btn-info col-md-12 mt-0 mb-2">View Organization Team Leads</a>   
                                <a href="/sellers/{{$organization['id']}}/organization" class="btn btn-info col-md-12 mt-0 mb-2">View Organization Sellers</a>
                                                    
                      
                     
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
        <li style="margin-bottom: 10px;"><strong>Organization Details</strong>: Displays the organization details</li>
        <li style="margin-bottom: 10px;"><strong>Admin Details</strong>: Displays the admin details</li>
        </ol>
      </div>
    </div>
    
        </div>
</div>
</div>

    </div>
</div>

@endsection