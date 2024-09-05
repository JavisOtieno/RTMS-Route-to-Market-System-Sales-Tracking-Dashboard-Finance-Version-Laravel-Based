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
                                <label for="name" class="form-label">Product Name</label>
                                <input type="text" class="form-control" name="name" id="name" placeholder="Name" autocomplete="name" value="{{ old('name', '') }}">
                            </div>
                            <div class="form-group">
                                <label for="sku" class="form-label">SKU</label>
                                <input type="text" class="form-control" name="sku" id="sku" placeholder="SKU" autocomplete="sku" value="{{ old('sku', '') }}">
                            </div>
                            <div class="form-group">
                                <label for="price" class="form-label">Price</label>
                                <input type="number" class="form-control" name="price" id="price" placeholder="Price" autocomplete="price" value="{{ old('price', '') }}">
                            </div>
                            <div class="form-group">
                                <label for="stock" class="form-label">Stock</label>
                                <input type="number" class="form-control" name="stock" id="stock" placeholder="Stock" autocomplete="stock" value="{{ old('stock', '') }}">
                            </div>
                            <div class="form-group">
                                <label for="description" class="form-label">Description</label>
                                <textarea type="text" class="form-control" name="description" id="description" placeholder="Description" autocomplete="description" value="">{{ old('description', '') }}</textarea>
                            </div>
                            @if (auth()->user()->usertype == "admin")
                            <div class="form-group">
                                <label for="team_id" class="form-label">Team</label>
                                <select name="team_id" class="form-control form-select select2" data-bs-placeholder="Select Team">
                                    <option value="0">None</option>
                                    @foreach($teams as $team)
                                    {{-- <option value="{{ $team['id'] }}" {{ old('team_id', '') == $team['id'] ? 'selected' : '' }}>
                                        {{ $team['name'] }}
                                    </option> --}}
                                    <option {{(isset($product)?old('team_id',$product['team']['id']):old('team_id'))==$team['id']? 'selected':''}}
                                     value="{{$team['id']}}">{{$team['name']}}</option>
                            
                                    @endforeach
                                </select>
                            </div>
                            @endif
                            <div class="form-group">
                                <label for="image" class="form-label">Image (Optional)</label>
                                <div class="col-lg-12 col-sm-12 mb-12 mb-lg-0">
                                    <input name="image" type="file" class="dropify" data-bs-height="180">
                                </div>
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