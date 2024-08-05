@extends('layout-form')

@section('content')

<div class="side-app">

    <!-- CONTAINER -->
    <div class="main-container container-fluid">

  <!-- PAGE-HEADER -->
  <div class="page-header">
    <h1 class="page-title">Territories</h1>
    <div>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">RTMS</a></li>
            <li class="breadcrumb-item active" aria-current="page">Territories</li>
        </ol>
    </div>
</div>
<!-- PAGE-HEADER END -->


<div class="col-xl-12 row">
    <div class="card col-md-8 ">
        <div class="card-header">
            <h3 class="card-title">Add Territory</h3> 
        </div>
        <div class="card-body">
            <!--<p>Use <code class="highlighter-rouge">.table-striped</code>to add zebra-striping to any table row within the <code class="highlighter-rouge">.tbody</code>.</p>-->
            
                
                    <form action="/saveterritory" method="POST">
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
                            <label class="form-label"> Region</label>
                            <select class="form-control select2-show-search form-select" name="regionId" id="regionId" data-placeholder="Choose one">
                                    <option label="Choose one"></option>
                                    @foreach($regions as $region)
                                    <option {{old('regionId','')==$region['id']? 'selected':''}} value="{{$region['id']}}">{{$region['name']}}</option>
                                    @endforeach
                                    
                                </select>
                        </div>

                            <div class="form-group">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" name="name" id="name" placeholder="Name" value="{{ old('name', '') }}" autocomplete="name">
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
            <li style="margin-bottom: 10px;"><strong>Select Region </strong>: Select the region of the territory </li>
                <li style="margin-bottom: 10px;"><strong>Name </strong>: Enter the name of the territory. </li>
            </ol>
          </div>
        </div>
        
            </div>
    </div>
</div>

    </div>
</div>

@endsection