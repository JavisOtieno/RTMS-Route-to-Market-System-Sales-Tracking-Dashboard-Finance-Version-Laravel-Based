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
    <div class="card col-md-8">
        <div class="card-header">
            <h3 class="card-title">Edit Outlet</h3> 
        </div>
        <div class="card-body">
            <!--<p>Use <code class="highlighter-rouge">.table-striped</code>to add zebra-striping to any table row within the <code class="highlighter-rouge">.tbody</code>.</p>-->
            
                
                    <form action="/saveeditoutlet/{{$outlet['id']}}" method="POST">
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
                                <input type="userName" readonly class="form-control" name="userName" id="userName" placeholder="User Name" value="{{$outlet['user']['name']}}" autocomplete="username">
                                <input type="hidden" readonly class="form-control" name="userId" id="userId" placeholder="User Id" value="{{$outlet['user']['id']}}" autocomplete="userid">
                            </div>
                            <div class="form-group">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" name="name" id="name" placeholder="Name" value="{{old('name',$outlet['name'])}}" autocomplete="name">
                            </div>
                            <div class="form-group">
                                <label for="contactPersonName" class="form-label">Contact Person Name</label>
                                <input type="text" class="form-control" name="contactPersonName" id="contactPersonName" placeholder="Contact Person Name" value="{{old('contact_person_name',$outlet['contact_person_name'])}}"  autocomplete="contactPersonNmae">
                            </div>
                            <div class="form-group">
                                <label for="phone" class="form-label">Phone</label>
                                <input type="text" class="form-control" name="phone" placeholder="Phone" value="{{old('phone',$outlet['phone'])}}"  autocomplete="phone">
                            </div>
                            <div class="form-group">
                                <label for="lat" class="form-label">Lat</label>
                                <input type="text" readonly class="form-control" name="lat" id="lat" placeholder="Lat" value="{{old('lat',$outlet['lat'])}}"  autocomplete="lat">
                            </div>
                            <div class="form-group">
                                <label for="long" class="form-label">Long</label>
                                <input type="text" readonly class="form-control" name="long" id="long" placeholder="long" value="{{old('long',$outlet['long'])}}"  autocomplete="long">
                            </div>

                            <div class="form-group">
                                <label for="dateTime" class="form-label">Date and Time Added</label>
                                <input readonly type="text" class="form-control" name="dateTime" id="dateTime" placeholder="DateTime" value="{{date('d-M-Y H:i', strtotime($outlet['created_at']))}}" autocomplete="dateTime">
                            </div>

                            <div class="form-group">

                                <label for="image" class="form-label">Image (Optional)</label>

                                {{-- <div style="margin: auto;" class="col-xl-6 col-lg-3 col-md-4 col-sm-4 col-xxl-2">
                                    <div class="card overflow-hidden">
                                        <a href="#"><img style="width: 100%;" src="{{url('storage/'.$outlet['image'])}}" alt="img" class="file-manager-list w-100"></a>
                                        <div class="card-footer">
                                            <div class="d-flex">
                                                <div class="">
                                                    <h5 class="mb-0 fw-semibold text-break">{{$outlet['name']}}</h5>
                                                </div>
                                                <div class="ms-auto my-auto">
                                                    <!--<span class="text-muted mb-0">66 KB</span>-->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div> --}}

                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xxl-12">
                                    <div class="card overflow-hidden" style="background: #fce9ec;">
                                        <a class="col-xl-7" style="margin: 20px auto">
                                            @if($outlet['image'])
                                            <a href="{{url('showimage/'.$outlet['image'])}}">
                                            <img style="width: 100%;" src="{{url('storage/'.$outlet['image'])}}" alt="img">
                                            </a>
                                            @else
                                            <img style="width: 100%;" src="{{asset('assets/images/new-images/no-image-available.jpg')}}" alt="img">
                                            
                                            @endif
                                        </a>

                                        <div class="card-footer">
                                            <div class="d-flex">
                                                <div class="" style="margin: auto">
                                                    <h5 style="text-align: center" class="mb-0 fw-semibold text-break">{{$outlet['name']}}</h5>
                                                </div>
                                                {{-- <div class="ms-auto my-auto">
                                                    <span class="text-muted mb-0">67 KB</span>
                                                </div> --}}
                                            </div>
                                        </div>
                                    </div>
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
        <ol class="card-text">
            {{-- It is readonly and cannot be modified. --}}
            <li style="margin-bottom: 10px;"><strong>Seller Name</strong>: This field displays the name of the seller</li>
            <li style="margin-bottom: 10px;"><strong>Name</strong>: This field displays the name of the outlet. It can be edited to update the outlet's name.</li>
            <li style="margin-bottom: 10px;"><strong>Contact Person Name</strong>: This field displays the name of the contact person at the outlet. It can be edited to update the contact person's name.</li>
            <li style="margin-bottom: 10px;"><strong>Phone</strong>: This field displays the phone number of the outlet. It can be edited to update the phone number.</li>
            <li style="margin-bottom: 10px;"><strong>Lat</strong>: This field displays the latitude of the outlet's location.</li>
            <li style="margin-bottom: 10px;"><strong>Long</strong>: This field displays the longitude of the outlet's location.</li>
            <li style="margin-bottom: 10px;"><strong>Date and Time Added</strong>: This field displays the date and time when the outlet was added.</li>
            <li style="margin-bottom: 10px;"><strong>Image (Optional)</strong>: This field displays an image of the outlet. </li>
        </ol>
      </div>
    </div>
    
        </div>
</div>
</div>

    </div>
</div>

@endsection