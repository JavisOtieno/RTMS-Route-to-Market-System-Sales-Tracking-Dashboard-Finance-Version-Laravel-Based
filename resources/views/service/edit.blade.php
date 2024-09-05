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
            
                
                    <form action="/saveeditservice/{{$product['id']}}" method="POST" enctype="multipart/form-data">
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
                                <label for="name" class="form-label">Service Name</label>
                                <input type="text" class="form-control" name="name" id="name" placeholder="Name" value="{{old('name',$product['name'])}}" autocomplete="name">
                            </div>
                            <div class="form-group">
                                <label for="admin" class="form-label">Target Type</label>
                                <select name="targettype" class="form-control form-select select2" data-bs-placeholder="Select User Type">
                                                    <option {{old('targettype',$product['targettype'])=="amount"? 'selected':''}} value="amount">Amount</option>
                                                    <option {{old('targettype',$product['targettype'])=="quantity"? 'selected':''}} value="quantity">Quantity</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="target" class="form-label">Target</label>
                                <input type="number" class="form-control" name="target" id="target" placeholder="Target" value="{{old('target',$product['target'])}}" autocomplete="target">
                            </div>
                            @if (auth()->user()->usertype == "admin")
                            <div class="form-group">
                                <label for="team_id" class="form-label">Team</label>
                                <select name="team_id" class="form-control form-select select2" data-bs-placeholder="Select Team">
                                    <option value="0">None</option>
                                    @foreach($teams as $team)
                                    <option {{(isset($product)?old('team_id',$product['team']['id']):old('team_id'))==$team['id']? 'selected':''}}
                                     value="{{$team['id']}}">{{$team['name']}}</option>
                            
                                    @endforeach
                                </select>
                            </div>
                            @endif

                            <div class="form-group">
                                <label for="description" class="form-label">Description</label>
                                <textarea type="text" rows="6" class="form-control" name="description" id="description" placeholder="Description" autocomplete="long">{{old('description',$product['description'])}}</textarea>
                            </div>
                            
                            <div class="form-group">
                                <label for="image" class="form-label">Image (Optional)</label>
                                {{-- {{url('storage/'.old('image',$product['image']))}} --}}
                                <div class="col-lg-12 col-sm-12 mb-4 mb-lg-0">
                                    <input type="file" class="dropify" name="image" data-default-file="{{$product['image']==''?'':url('storage/'.$product['image'])}}" data-bs-height="180">
                                    <input type="hidden" name="default_file_removed" id="default_file_removed" value="0">
                                    <input type="hidden" name="existing_file" value="{{$product['image']==''?'':url('storage/'.$product['image'])}}">
       
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="dateTime" class="form-label">Date and Time Added</label>
                                <input readonly type="text" class="form-control" name="dateTime" id="dateTime" placeholder="DateTime" value="{{date('d-M-Y H:i', strtotime($product['created_at']))}}" autocomplete="dateTime">
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
              
                <li style="margin-bottom: 10px;"><strong>Service Name</strong> : Please enter a descriptive yet concise name for your service.</li>
                <li style="margin-bottom: 10px;"><strong>Description</strong> : Describe your service in detail, highlighting its features, benefits, and unique selling points.</li>
          </ol>
        </div>
      </div>
    
    
        </div>
</div>
</div>

    </div>
</div>

@endsection

<!-- JQUERY JS -->
<script src="{{asset('assets/js/jquery.min.js')}}"></script>

