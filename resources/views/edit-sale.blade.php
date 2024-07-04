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
    <div class="card col-md-8">
        <div class="card-header">
            <h3 class="card-title">View Sale</h3> 
        </div>
        <div class="card-body">
            <!--<p>Use <code class="highlighter-rouge">.table-striped</code>to add zebra-striping to any table row within the <code class="highlighter-rouge">.tbody</code>.</p>-->
            
                
                    <form action="/saveeditsale/{{$sale['id']}}" method="POST">
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
                                {{-- value="{{$sale['user']['name']}}"  --}}
                                value="{{ $sale['user'] ? $sale['user']['name']  . ($sale['user']->trashed() ? ' (Deleted User)' : '') : 'Deleted User'}}" 
                                autocomplete="sellerName">
                            </div>
                            <div class="form-group">
                                
                                <label for="outletName" class="form-label">Outlet Name</label>
                                <input readonly type="text" class="form-control" name="outletName" id="outleName" placeholder="Outlet Name" value="{{$sale['outlet']['name']}}" autocomplete="outletname">
                            </div>
              
                            <div class="form-group">
                                <label for="pieces" class="form-label">Pieces</label>
                                <input readonly type="text" class="form-control" name="pieces" id="pieces" placeholder="Pieces" value="{{$sale['pieces']}}" autocomplete="pieces">
                            </div>
                            <div class="form-group">
                                <label for="value" class="form-label">Total Value</label>
                                <input readonly type="text" class="form-control" name="value" id="value" placeholder="Value" value="{{"KSh ".number_format($sale['value'])}}" autocomplete="value">
                            </div>
                            <div class="form-group">
                                <label for="dateTime" class="form-label">Date and Time</label>
                                <input readonly type="text" class="form-control" name="dateTime" id="dateTime" placeholder="DateTime" value="{{date('d-M-Y H:i', strtotime($sale['created_at']))}}" autocomplete="dateTime">
                            </div>

                            <div class="form-group">
                                <label style="font-weight:bold;margin-bottom: 1.5rem;" for="productNames" class="form-label">Products</label>
                                <div class="row mb-4">
                                    <label style="font-weight:bold;" for="productName" class="col-md-4 form-label">Product Name</label>
                                    <label style="font-weight:bold;" for="productValue" class="col-md-3 form-label">Product Price</label>
                                    <label style="font-weight:bold;" for="productPieces" class="col-md-2 form-label">Pieces</label>
                                    <label style="font-weight:bold;" for="productPieces" class="col-md-3 form-label">Value</label>
                                    
                                </div>
                                <!--<input readonly type="text" class="form-control" name="productNames" id="productNames" placeholder="Products" value="{{$sale['products']}}" autocomplete="products">-->
                                @foreach($sale['saleitems'] as $saleitem)
                                <div class=" row mb-4">
                                    <label style="font-weight:400;" for="productPieces" class="col-md-4 form-label">
                                        {{-- {{$saleitem['product']['name']}} --}}
                                        {{ $saleitem['product'] ? $saleitem['product']['name']  . ($saleitem['product']->trashed() ? ' (Deleted Product)' : '') : 'Deleted Product'}}

                                    </label>
                                    <div class="col-md-3">
                                        <input readonly type="text" class="form-control" id="productPieces" placeholder="productPieces" autocomplete="productpieces" value="{{'KSh. '.number_format($saleitem['price'])}}">
                                    </div>
                                    <div class="col-md-2">
                                        <input readonly type="text" class="form-control" id="productPieces" placeholder="productPieces" autocomplete="productpieces" value="{{$saleitem['pieces']}}">
                                    </div>
                                    
                                    <div class="col-md-3">
                                        <input readonly type="text" class="form-control" id="productValue" placeholder="productValue" autocomplete="productvalue" value="{{'KSh. '.number_format($saleitem['value'])}}">
                                    </div>
                                </div>
                                @endforeach

                                <div class=" row mb-4">
                                    <label style="font-weight:bold;" for="productValue" class="col-md-4 form-label">Total</label>

                                    
                                    <div class="col-md-3">
                                    </div>
                                    <div class="col-md-2">
                                        <input style="font-weight:bold;" readonly type="text" class="form-control" id="productPieces" placeholder="salePieces" autocomplete="salepieces" value="{{$sale['pieces']}}">
                                    </div>

                                    <div class="col-md-3">
                                        <input style="font-weight:bold;" readonly type="text" class="form-control" id="productValue" placeholder="productValue" autocomplete="productvalue" value="{{'KSh. '.number_format($sale['value'])}}">
                                    </div>
                                </div>

                            </div>
                            
                        </div>
                        {{-- <button class="btn btn-primary mt-4 mb-0">Save</button> --}}
                    </form>
                
            </div>

        </div>
    
    <div class="col-md-3">

        <div class="card" style="width: 18rem;height:95%;background-color:#F7F7F9">
      <div class="card-body">
        <h5 class="card-title">Quick Tips</h5>
        <ol class="card-text">
        <li style="margin-bottom: 10px;"><strong>Seller Name</strong> :This field displays the name of the seller associated with the sale.</li>
        <li style="margin-bottom: 10px;"><strong>Outlet Name</strong> : This field displays the name of the outlet where the sale took place.</li>
        <li style="margin-bottom: 10px;"><strong>Pieces</strong> : This field displays the total number of pieces sold in the transaction.</li>
        <li style="margin-bottom: 10px;"><strong>Total Value</strong> : This field displays the total value of the sale.</li>
        <li style="margin-bottom: 10px;"><strong>Date and Time</strong> : This field displays the date and time when the sale occurred.</li>
        <li style="margin-bottom: 10px;"><strong>Products</strong> : This section displays details about the products sold in the transaction, including their names, prices, pieces sold, and total value. Each product entry is displayed in a separate row and is disabled, showing only the information relevant to the product. The total pieces and total value of all products are also displayed at the end of the section.</li>
        </ol>
      </div>
    </div>
    
        </div>
</div>
</div>

    </div>
</div>

@endsection