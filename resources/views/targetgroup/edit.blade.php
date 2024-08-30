@extends('layout-form')

@section('content')

<div class="side-app">

    <!-- CONTAINER -->
    <div class="main-container container-fluid">

  <!-- PAGE-HEADER -->
  <div class="page-header">
    <h1 class="page-title">Users</h1>
    <div>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">RTMS</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit User</li>
        </ol>
    </div>
</div>
<!-- PAGE-HEADER END -->


<div class="col-xl-12 row">
    <div class="card col-md-8">
        <div class="card-header">
            <h3 class="card-title">Edit Target Group</h3> 
        </div>
        <div class="card-body">
            <!--<p>Use <code class="highlighter-rouge">.table-striped</code>to add zebra-striping to any table row within the <code class="highlighter-rouge">.tbody</code>.</p>-->
            
                
                    <form action="/saveedittargetgroup/{{$targetgroup['id']}}" method="POST">
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
                                <label for="name" class="form-label">Name</label>
                                <input type="name" class="form-control" name="name" id="name" placeholder="Name" value="{{old('name',$targetgroup['name'])}}"  autocomplete="name">
                            </div>
                            <div class="form-group">
                                <label for="amount" class="form-label">Target Amount</label>
                                <input type="number" class="form-control" name="amount"  placeholder="Amount" value="{{old('amount',$targetgroup['amount'])}}"  autocomplete="amount">
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
                                    <option {{(isset($targetgroup)?old('team_id',$targetgroup['team']['id']):old('team_id'))==$team['id']? 'selected':''}}
                                     value="{{$team['id']}}">{{$team['name']}}</option>
                            
                                    @endforeach
                                </select>
                            </div>
                            @endif

                            <div class="form-group">
                                <label for="dateTime" class="form-label">Date and Time</label>
                                <input readonly type="text" class="form-control" name="dateTime" id="dateTime" placeholder="DateTime" value="{{date('d-M-Y H:i', strtotime($targetgroup['created_at']))}}" autocomplete="dateTime">
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
        <li style="margin-bottom: 10px;"><strong>Name</strong>: This field displays the name of the target group. It is editable and pre-filled with the existing value.</li>
        <li style="margin-bottom: 10px;"><strong>Target Amount</strong>: This field displays the target amount associated with the target group. It is editable and pre-filled with the existing value.</li>
        <li style="margin-bottom: 10px;"><strong>Date and Time</strong>: This field displays the date and time when the target group was created. It is disabled and cannot be modified.</li>
        </ol>
      </div>
    </div>
    
        </div>
</div>
</div>

    </div>
</div>

@endsection