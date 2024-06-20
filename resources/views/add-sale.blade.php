@extends('layout-form')

@section('content')

<div class="side-app">

    <!-- CONTAINER -->
    <div class="main-container container-fluid">

  <!-- PAGE-HEADER -->
  <div class="page-header">
    <h1 class="page-title">Sales</h1>
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
            <h3 class="card-title">Add Sale</h3> 
        </div>
        <div class="card-body">
            <!--<p>Use <code class="highlighter-rouge">.table-striped</code>to add zebra-striping to any table row within the <code class="highlighter-rouge">.tbody</code>.</p>-->
            
                
                    <form action="/savesale" method="POST">
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
                                        <option value="{{$user['id']}}">{{$user['name']}}</option>
                                        @endforeach
                                        
                                    </select>
                            </div>
                           
                            <div class="form-group">
                                <label class="form-label"> Outlets</label>
                                <select class="form-control select2-show-search form-select" name="outletId" id="outletId" data-placeholder="Choose one">
                                        <option label="Choose one"></option>
                                        @foreach($outlets as $outlet)
                                        <option value="{{$outlet['id']}}">{{$outlet['name']}}</option>
                                        @endforeach
                                        
                                    </select>
                            </div>
                            
                            <div class="form-group">
                                <label class="form-label"> Products</label>
                                <select class="form-control select2-show-search form-select" name="productId" id="productId" data-placeholder="Choose one">
                                        <option label="Choose one"></option>
                                        @foreach($products as $product)
                                        <option value="{{$product['id']}}">{{$product['name']}}</option>
                                        @endforeach
                                        
                                    </select>
                            </div>
                            <div class="form-group">
                                <label for="pieces" class="form-label">Pieces</label>
                                <input type="text" class="form-control" name="pieces" id="pieces" placeholder="Pieces" autocomplete="pieces" value="{{old('pieces')}}">
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
                  <ol class="card-text">
                    
                      <li style="margin-bottom: 10px;"><strong>Product Name</strong> : Please enter a descriptive yet concise name for your product.</li>
                      <li style="margin-bottom: 10px;"><strong>SKU</strong> : Provide a unique SKU (Stock Keeping Unit) for your product to help with inventory management.</li>
                      <li style="margin-bottom: 10px;"><strong>Price</strong> : Enter the price of your product, ensuring it reflects its value and is competitive in the market.</li>
                      <li style="margin-bottom: 10px;"><strong>Stock</strong> : Specify the available quantity of your product to prevent overselling.</li>
                      <li style="margin-bottom: 10px;"><strong>Description</strong> : Describe your product in detail, highlighting its features, benefits, and unique selling points.</li>
                      <li style="margin-bottom: 10px;"><strong>Image</strong> : Upload high-quality images of your product to showcase it from various angles and contexts.</li>
                  </ol>
                </div>
              </div>
        
            </div>
    </div>
</div>

    </div>
</div>

@endsection


