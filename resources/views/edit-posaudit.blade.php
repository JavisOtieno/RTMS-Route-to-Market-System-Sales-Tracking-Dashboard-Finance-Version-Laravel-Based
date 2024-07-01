@extends('layout-form')

@section('content')

<div class="side-app">

    <!-- CONTAINER -->
    <div class="main-container container-fluid">

  <!-- PAGE-HEADER -->
  <div class="page-header">
    <h1 class="page-title">POS Audits</h1>
    <div>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">RTMS</a></li>
            <li class="breadcrumb-item active" aria-current="page">POS Audits</li>
        </ol>
    </div>
</div>
<!-- PAGE-HEADER END -->


<div class="col-xl-12 row">
    <div class="card col-md-8">
        <div class="card-header">
            <h3 class="card-title">View POS Audit</h3> 
        </div>
        <div class="card-body">
            <!--<p>Use <code class="highlighter-rouge">.table-striped</code>to add zebra-striping to any table row within the <code class="highlighter-rouge">.tbody</code>.</p>-->
            
                
                    <form action="/saveeditsale/{{$posaudit['id']}}" method="POST">
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
                                value="{{ $posaudit['user'] ? $posaudit['user']['name']  . ($posaudit['user']->trashed() ? ' (Deleted User)' : '') : 'Deleted User'}}" 
                                autocomplete="sellerName">
                            </div>
                            <div class="form-group">
                                
                                <label for="outletName" class="form-label">Outlet Name</label>
                                <input readonly type="text" class="form-control" name="outletName" id="outleName" placeholder="Outlet Name" value="{{$posaudit['outlet']['name']}}" autocomplete="outletname">
                            </div>
              
                            <div class="form-group">
                                <label for="dateTime" class="form-label">Date and Time</label>
                                <input readonly type="text" class="form-control" name="dateTime" id="dateTime" placeholder="DateTime" value="{{date('d-M-Y H:i', strtotime($posaudit['created_at']))}}" autocomplete="dateTime">
                            </div>

                            <div class="form-group">
                                <label for="productNames" style="font-weight:bold;margin-bottom: 1.5rem;"  class="form-label">Products</label>
                                <!--<input readonly type="text" class="form-control" name="productNames" id="productNames" placeholder="Products"  autocomplete="products">-->
                                <div class="row mb-4">
                                    <label style="font-weight:bold;" for="productName" class="col-md-6 form-label">Product Name</label>
                                    <label style="font-weight:bold;" for="productPieces" class="col-md-6 form-label">Pieces</label>                                    
                                </div>
                                @foreach($posaudit['posaudititems'] as $posaudititem)
                                <div class=" row mb-4">
                                    <label style="font-weight:400;" for="productPieces" class="col-md-6 form-label">{{$posaudititem['product']['name']}}</label>
                                    <div class="col-md-6">
                                        <input readonly type="text" class="form-control" id="productPieces" placeholder="productPieces" autocomplete="productpieces" value="{{$posaudititem['pieces']}}">
                                    </div>
                                </div>
                                @endforeach

                            </div>

                            <div class="form-group">

                                <label for="image" class="form-label">Image</label>

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
                                            @if($posaudit['image'])
                                            <a href="{{url('showimage/'.$posaudit['image'])}}">
                                            <img style="width: 100%;" src="{{url('storage/'.$posaudit['image'])}}" alt="img">
                                            </a>
                                            @else
                                            <img style="width: 100%;" src="{{asset('assets/images/new-images/no-image-available.jpg')}}" alt="img">
                                            @endif
                                        </a>

                                        <div class="card-footer">
                                            <div class="d-flex">
                                                <div class="" style="margin: auto">
                                                    <h5 style="text-align: center" class="mb-0 fw-semibold text-break">{{$posaudit['outlet']['name']}}</h5>
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
                        <!--<button class="btn btn-primary mt-4 mb-0">Save</button>-->
                    </form>
                
            </div>

        </div>
    
    <div class="col-md-3">

        <div class="card" style="width: 18rem;height:95%;background-color:#F7F7F9">
      <div class="card-body">
        <h5 class="card-title">Quick Tips</h5>
        <ol class="card-text">
        <li style="margin-bottom: 10px;"><strong>Seller Name</strong> : This field displays the name of the seller. </li>
        <li style="margin-bottom: 10px;"><strong>Outlet Name</strong> : This field displays the name of the outlet. </li>
        <li style="margin-bottom: 10px;"><strong>Date and Time</strong> : This field displays the date and time of the POS audit. </li>
        <li style="margin-bottom: 10px;"><strong>Products</strong> : This section displays a list of products audited along with the number of pieces for each product.
        <ul>
        <li><strong>Product Name</strong>: This column displays the name of each product audited.</li>
        <li><strong>Pieces</strong> : This column displays the number of pieces audited for each product.</li>
        </ul>
        </li>
        <li style="margin-bottom: 10px;"><strong>Image </strong>: This section displays an image related to the POS audit. If an image is available, it is shown; otherwise, a placeholder image is displayed.</li>
        </ol>
        </div>
    </div>
    
        </div>
</div>
</div>

    </div>
</div>

@endsection