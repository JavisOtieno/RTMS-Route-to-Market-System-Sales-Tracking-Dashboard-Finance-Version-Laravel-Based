@extends('layout-form')

@section('content')

<div class="side-app">

    <!-- CONTAINER -->
    <div class="main-container container-fluid">

  <!-- PAGE-HEADER -->
  <div class="page-header">
    <h1 class="page-title">Edit Team</h1>
    <div>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">RTMS</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit Team</li>
        </ol>
    </div>
</div>
<!-- PAGE-HEADER END -->


<div class="col-xl-12 row">
    <div class="card col-md-8">
        <div class="card-header">
            <h3 class="card-title">Edit Team</h3> 
        </div>
        <div class="card-body">
            <!--<p>Use <code class="highlighter-rouge">.table-striped</code>to add zebra-striping to any table row within the <code class="highlighter-rouge">.tbody</code>.</p>-->
            
                
                    <form action="/saveeditteam/{{$team['id']}}" method="POST">
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
                                <input type="name" class="form-control" name="name" id="name" placeholder="Name" value="{{old('name',$team['name'])}}"  autocomplete="name">
                            </div>
                            <div class="form-group">
                                <label for="description" class="form-label">Description</label>
                                <textarea type="text" class="form-control" name="description" id="description" placeholder="Description" autocomplete="description" >{{ old('description', $team['description']) }}</textarea>
                            </div>

                            <div class="form-group">
                                <label for="dateTime" class="form-label">Date and Time</label>
                                <input readonly type="text" class="form-control" name="dateTime" id="dateTime" placeholder="DateTime" value="{{date('d-M-Y H:i', strtotime($team['created_at']))}}" autocomplete="dateTime">
                            </div>

                            <div class="form-group">
                                <label for="password" class="form-label">Add Sellers to Team</label>
                                    {{-- <td>
                                            <form method="POST" action="{{ route('editproduct') }}">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $product->id }}">
                                                <!-- Other form fields -->
                                                <button type="submit" class="btn btn-info">View/Edit</button>
                                            </form>
                                        </td> --}}
                                <a href="/addsellerstoteam/{{$team['id']}}" class="col-12 btn btn-info mb-0">Add Sellers</a>                            
                            </div>

                            <div class="form-group">
                                <label for="teamlead_id" class="form-label">Team Lead</label>
                                
                                <select name="teamlead_id" id="teamlead_id" class="form-control form-select select2" data-bs-placeholder="Select Team Lead">
                                    <option 
                                    {{
                                        isset($selectedteamlead)?
                                        (old('teamlead_id',$selectedteamlead['id'])==null? 'selected':''):
                                         (old('teamlead_id')==null? 'selected':'')
                                        }} 
                                        value="0">None</option>
                                    @foreach($teamleads as $teamlead)
                                        <option 
                                        {{
                                        isset($selectedteamlead)?
                                        (old('teamlead_id',$selectedteamlead['id'])==$teamlead['id']? 'selected':''):
                                        (old('teamlead_id'==$teamlead['id'])? 'selected':'')
                                        }} 
                                        value="{{$teamlead['id']}}">{{$teamlead['name']}}</option>

                                        @endforeach
                                </select>
                                            </div>
                                           

                            <div class="form-group">
                                <label for="teamSellers" style="font-weight:bold;"  class="form-label">Sellers on team</label>
                                @if(count($teamsellers)>0)
                                <ol>
                                @foreach($teamsellers as $seller)
                                <div class="row mb-4">
                                    {{-- <label style="font-weight:400;" for="planOutlet" class="col-md-1 form-label">
                                        {{$posaudititem['product']['name']}}
                                    </label> --}}
                                    <div class="col-md-12">
                                        <li>
                                            
                                        <input readonly type="text" class="form-control" id="sellerName" placeholder="Seller Name" autocomplete="sellername" 
                                        value="{{$seller ? $seller['name']  . ($seller->trashed() ? ' (Deleted Seller)' : '') : 'Deleted Seller'}}"
                                        >
                                        </li>
                                    </div>
                                </div>
                                @endforeach
                                </ol>
                                @else
                                <div class="row mb-4">
                                    <div class="col-md-12">
            
                                        <input readonly type="text" class="form-control" id="sellers" placeholder="Seller Name" autocomplete="sellername" 
                                        value="No sellers at the moment"
                                        >
                                
                                    </div>
                                </div>
                                @endif
                                </ol>
    
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
        <li style="margin-bottom: 10px;"><strong>Name</strong>: This field displays the name of the team. It is editable and pre-filled with the existing value.</li>
        <li style="margin-bottom: 10px;"><strong>Description</strong>: This field displays the team description. It is editable and pre-filled with the existing value.</li>
        <li style="margin-bottom: 10px;"><strong>Date and Time</strong>: This field displays the date and time when the team was created. It is disabled and cannot be modified.</li>
        </ol>
      </div>
    </div>
    
        </div>
</div>
</div>

    </div>
</div>

@endsection