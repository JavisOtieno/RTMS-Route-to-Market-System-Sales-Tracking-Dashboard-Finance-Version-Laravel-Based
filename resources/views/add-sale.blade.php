@extends('layout')

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
                            <div class="form-group">
                                <label for="userId" class="form-label">User Id</label>
                                <input type="userId" class="form-control" name="userId" id="userId" placeholder="User Id" autocomplete="userid" value="{{old('userId')}}">
                                
                            </div>
                            <div class="form-group">
                                <label class="form-label">Basic</label>
                                <select class="form-control select2 form-select" data-placeholder="Choose one">
                                        <option label="Choose one">
                                        </option>
                                        <option value="1">Chuck Testa</option>
                                        <option value="2">Sage Cattabriga-Alosa</option>
                                        <option value="3">Nikola Tesla</option>
                                        <option value="4">Cattabriga-Alosa</option>
                                        <option value="5">Nikola Alosa</option>
                                    </select>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Basic Select2</label>
                                <select class="form-control select2" data-placeholder="Choose one (with optgroup)">
                                        <optgroup label="Mountain Time Zone">
                                            <option value="AZ">Arizona</option>
                                            <option value="CO">Colorado</option>
                                            <option value="ID">Idaho</option>
                                            <option value="MT">Montana</option><option value="NE">Nebraska</option>
                                            <option value="NM">New Mexico</option>
                                            <option value="ND">North Dakota</option>
                                            <option value="UT">Utah</option>
                                            <option value="WY">Wyoming</option>
                                        </optgroup>
                                        <optgroup label="Central Time Zone">
                                            <option value="AL">Alabama</option>
                                            <option value="AR">Arkansas</option>
                                            <option value="IL">Illinois</option>
                                            <option value="IA">Iowa</option>
                                            <option value="KS">Kansas</option>
                                            <option value="KY">Kentucky</option>
                                            <option value="LA">Louisiana</option>
                                            <option value="MN">Minnesota</option>
                                            <option value="MS">Mississippi</option>
                                            <option value="MO">Missouri</option>
                                            <option value="OK">Oklahoma</option>
                                            <option value="SD">South Dakota</option>
                                            <option value="TX">Texas</option>
                                            <option value="TN">Tennessee</option>
                                            <option value="WI">Wisconsin</option>
                                        </optgroup>
                                    </select>
                            </div>
                            <div class="form-group">
                                <label class="form-label"> Select2 with search box</label>
                                <select class="form-control select2-show-search form-select" data-placeholder="Choose one">
                                        <option label="Choose one"></option>
                                        <option value="AZ">Arizona</option>
                                        <option value="CO">Colorado</option>
                                        <option value="ID">Idaho</option>
                                        <option value="MT">Montana</option>
                                        <option value="NE">Nebraska</option>
                                        <option value="NM">New Mexico</option>
                                        <option value="ND">North Dakota</option>
                                        <option value="UT">Utah</option>
                                        <option value="WY">Wyoming</option>
                                        <option value="AL">Alabama</option>
                                        <option value="AR">Arkansas</option>
                                        <option value="IL">Illinois</option>
                                        <option value="IA">Iowa</option>
                                        <option value="KS">Kansas</option>
                                        <option value="KY">Kentucky</option>
                                        <option value="LA">Louisiana</option>
                                        <option value="MN">Minnesota</option>
                                        <option value="MS">Mississippi</option>
                                        <option value="MO">Missouri</option>
                                        <option value="OK">Oklahoma</option>
                                        <option value="SD">South Dakota</option>
                                        <option value="TX">Texas</option>
                                        <option value="TN">Tennessee</option>
                                        <option value="WI">Wisconsin</option>
                                    </select>
                            </div>
                            <div class="form-group">
                                <label class="form-label"> Select2 with search box</label>
                                <select class="form-control select2-show-search form-select" data-placeholder="Choose one">
                                        <option label="Choose one"></option>
                                        <option value="AZ">Arizona</option>
                                        <option value="CO">Colorado</option>
                                        <option value="ID">Idaho</option>
                                        <option value="MT">Montana</option>
                                        <option value="NE">Nebraska</option>
                                        <option value="NM">New Mexico</option>
                                        <option value="ND">North Dakota</option>
                                        <option value="UT">Utah</option>
                                        <option value="WY">Wyoming</option>
                                        <option value="AL">Alabama</option>
                                        <option value="AR">Arkansas</option>
                                        <option value="IL">Illinois</option>
                                        <option value="IA">Iowa</option>
                                        <option value="KS">Kansas</option>
                                        <option value="KY">Kentucky</option>
                                        <option value="LA">Louisiana</option>
                                        <option value="MN">Minnesota</option>
                                        <option value="MS">Mississippi</option>
                                        <option value="MO">Missouri</option>
                                        <option value="OK">Oklahoma</option>
                                        <option value="SD">South Dakota</option>
                                        <option value="TX">Texas</option>
                                        <option value="TN">Tennessee</option>
                                        <option value="WI">Wisconsin</option>
                                    </select>
                            </div>
                            <div class="form-group">
                                <label for="outletId" class="form-label">Outlet Id</label>
                                <input type="text" class="form-control" name="outletId" id="outletId" placeholder="Outlet Id" autocomplete="outletid" value="{{old('outletId')}}">
                            </div>
                            <div class="form-group">
                                <label for="productId" class="form-label">Product Id</label>
                                <input type="text" class="form-control" name="productId" id="productId" placeholder="Product Id" autocomplete="productid" value="{{old('productId')}}">
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
          </div>
        </div>
        
            </div>
    </div>
</div>

    </div>
</div>

@endsection


