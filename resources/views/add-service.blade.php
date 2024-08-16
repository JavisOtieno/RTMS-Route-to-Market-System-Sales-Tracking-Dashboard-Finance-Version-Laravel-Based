@extends('layout-form')

@section('content')

<div class="side-app">

    <!-- CONTAINER -->
    <div class="main-container container-fluid">

  <!-- PAGE-HEADER -->
  <div class="page-header">
    <h1 class="page-title">Products</h1>
    <div>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">RTMS</a></li>
            <li class="breadcrumb-item active" aria-current="page">Products</li>
        </ol>
    </div>
</div>
<!-- PAGE-HEADER END -->


<div class="col-xl-12 row">
    <div class="card col-md-8 ">
        <div class="card-header">
            <h3 class="card-title">Add Product</h3> 
        </div>
        <div class="card-body">
            <!--<p>Use <code class="highlighter-rouge">.table-striped</code>to add zebra-striping to any table row within the <code class="highlighter-rouge">.tbody</code>.</p>-->
            
                
                    <form action="/saveproduct" method="POST" enctype="multipart/form-data">
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
                                <label for="name" class="form-label">Service Name</label>
                                <input type="text" class="form-control" name="name" id="name" placeholder="Name" autocomplete="name" value="{{ old('name', '') }}">
                            </div>
                            <div class="form-group">
                                <label for="description" class="form-label">Description</label>
                                <textarea type="text" class="form-control" name="description" id="description" placeholder="Description" autocomplete="description" value="">{{ old('description', '') }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="image" class="form-label">Image (Optional)</label>
                                <div class="col-lg-12 col-sm-12 mb-12 mb-lg-0">
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
            <ol class="card-text">
              
                <li style="margin-bottom: 10px;"><strong>Product Name</strong> : Please enter a descriptive yet concise name for your product.</li>
                <li style="margin-bottom: 10px;"><strong>Description</strong> : Describe your product in detail, highlighting its features, benefits, and unique selling points.</li>
            </ol>
          </div>
        </div>
        
            </div>
    </div>
</div>

    </div>
</div>

@endsection