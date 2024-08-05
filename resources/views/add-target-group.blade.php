@extends('layout-form')

@section('content')

<div class="side-app">

    <!-- CONTAINER -->
    <div class="main-container container-fluid">

  <!-- PAGE-HEADER -->
  <div class="page-header">
    <h1 class="page-title">Target Groups</h1>
    <div>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">RTMS</a></li>
            <li class="breadcrumb-item active" aria-current="page">Target Groups</li>
        </ol>
    </div>
</div>
<!-- PAGE-HEADER END -->


<div class="col-xl-12 row">
    <div class="card col-md-8 ">
        <div class="card-header">
            <h3 class="card-title">Add Target Group</h3> 
        </div>
        <div class="card-body">
            <!--<p>Use <code class="highlighter-rouge">.table-striped</code>to add zebra-striping to any table row within the <code class="highlighter-rouge">.tbody</code>.</p>-->
            
                
                    <form action="/savetargetgroup" method="POST">
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
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" name="name" id="name" placeholder="Name" value="{{ old('name', '') }}" autocomplete="name">
                            </div>
                            <div class="form-group">
                                <label for="amount" class="form-label">Target Amount</label>
                                <input type="number" class="form-control" name="amount"  placeholder="Amount" value="{{ old('amount', '') }}" autocomplete="amount">
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
                <li style="margin-bottom: 10px;"><strong>Name </strong>: Enter the name of the target group. For instance, based on location, Ruaraka Group </li>
                <li style="margin-bottom: 10px;"><strong>Target Amount </strong>: Enter the target amount for this entry. Numbers only.</li>    
            </ol>
          </div>
        </div>
        
            </div>
    </div>
</div>

    </div>
</div>

@endsection