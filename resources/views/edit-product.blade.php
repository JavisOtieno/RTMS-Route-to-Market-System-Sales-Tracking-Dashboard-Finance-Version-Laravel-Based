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
    <div class="card col-md-8">
        <div class="card-header">
            <h3 class="card-title">Edit Product</h3> 
        </div>
        <div class="card-body">
            <!--<p>Use <code class="highlighter-rouge">.table-striped</code>to add zebra-striping to any table row within the <code class="highlighter-rouge">.tbody</code>.</p>-->
            
                
                    <form action="/saveeditproduct/{{$product['id']}}" method="POST">
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
                                <label for="name" class="form-label">Product Name</label>
                                <input type="text" class="form-control" name="name" id="name" placeholder="Name" value="{{$product['name']}}" autocomplete="name">
                            </div>
                            <div class="form-group">
                                <label for="price" class="form-label">Price</label>
                                <input type="text" class="form-control" name="price" id="price" placeholder="Price" value="{{$product['price']}}" autocomplete="phone">
                            </div>
                            <div class="form-group">
                                <label for="sku" class="form-label">SKU</label>
                                <input type="text" class="form-control" name="sku" id="sku" placeholder="Sku" value="{{$product['sku']}}" autocomplete="lat">
                            </div>
                            <div class="form-group">
                                <label for="description" class="form-label">Description</label>
                                <textarea type="text" rows="6" class="form-control" name="description" id="description" placeholder="description" autocomplete="long">{{$product['description']}}</textarea>
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