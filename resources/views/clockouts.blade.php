@extends('layout')

@section('content')

<div class="side-app">

    <!-- CONTAINER -->
    <div class="main-container container-fluid">

  <!-- PAGE-HEADER -->
  <div class="page-header">
    <h1 class="page-title">Clock Outs</h1>
    <div>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">RTMS</a></li>
            <li class="breadcrumb-item active" aria-current="page">Clock Outs</li>
        </ol>
    </div>
</div>
<!-- PAGE-HEADER END -->


<div class="col-xl-12">

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Clock Outs</h3>
        </div>
        <div class="row" style="margin: 0 10px;">
            <input type="hidden" id="tableLoaded" value="clockouts"/>
            <h3 class="card-title" style="margin-top:20px;margin-block-end: 0rem;">Search by :</h3>
            <div class="col-md-3 mb-3">
                <label for="name" class="form-label">Seller Name</label>
                <input type="text" class="form-control" id="nameInput" placeholder="Name">
            </div>
            {{-- <div class="col-md-3 mb-3">
                <label for="date" class="form-label">Date</label>
                <input type="date" class="form-control" id="dateInput" placeholder="Date">
            </div>
            <div class="col-md-3 mb-3">
                <label for="time" class="form-label">Clockin After</label>
                <input type="time" class="form-control" id="timeInput" placeholder="Time">
            </div> --}}
            {{-- <div class="col-md-3 mb-3">
                <label for="targets" class="form-label">Targets</label>
                <select class="form-select form-select select2" id="targetsInput">
                    <option value="None">None</option>
                    @foreach($targetgroups as $targetgroup)
                    <option value="{{number_format($targetgroup['amount'])}}">{{$targetgroup['name']." - KSh ".number_format($targetgroup['amount'])}}</option>
                    @endforeach
                </select>

            </div> --}}
            
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="responsive-datatable" class="table table-bordered text-nowrap border-bottom">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Date</th>
                            <th>Time</th>
                            <th>Lat</th>
                            <th>Long</th>
                            <th id="view-column">View</th>
                            <th id="map-column">Map</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                            @if(count($clockouts)>0)
                            @foreach($clockouts as $clockout)
                            <tr>
                            <td>{{$clockout['id']}}</td>
                            <td>{{ $clockout['user'] ? $clockout['user']['name']  . ($clockout['user']->trashed() ? ' (Deleted User)' : '') : 'Deleted User'}}
                            </td>
                            <td>{{date('d-M-Y', strtotime($clockout['created_at']))}}</td>
                            <td>{{date('H:i', strtotime($clockout['created_at']))}}</td>
                            <td>{{$clockout['lat']}}</td>
                            <td>{{$clockout['long']}}</td>
                            <td><a type="button" href="/clockout/{{$clockout['id']}}" class="btn btn-info" style="margin-left: auto;color:white;">View</a>
                            </td>
                            {{-- <td>
                                <form method="POST" action="{{ route('editclockout') }}">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $clockout->id }}">
                                    <!-- Other form fields -->
                                    <button type="submit" class="btn btn-info">View</button>
                                </form>
                            </td> --}}
                            <td><a type="button" onclick="embedMap('{{$clockout['lat']}}','{{$clockout['long']}}')"
                                class="btn btn-success" style="margin-left: auto;color:white;" data-bs-toggle="modal" href="#largemodal">Map</a>
                          </td>
                            <!--<a class="modal-effect btn btn-primary-light d-grid mb-3" data-bs-effect="effect-scale" >Scale</a>-->
                            </tr>
                            
                            @endforeach
                            @else
                            <!--let datatables display no data available-->
                            @endif
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

    </div>
</div>

    <!-- MODAL EFFECTS -->
    <div class="modal fade" id="modalDelete">
        <div class="modal-dialog modal-dialog-centered text-center" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title">Delete</h6><button aria-label="Close" class="btn-close" data-bs-dismiss="modal"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <h6>Are you sure you want to delete?</h6>
                    <strong id="itemDetails">Details</strong>
                </div>
                <div class="modal-footer">
                    <a id="confirmDelete" class="btn btn-danger" style="color: white">Delete</a> <button class="btn btn-light" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="largemodal">
        <div class="modal-dialog modal-lg " role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Map</h5>
                    <button class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                </div>
                <div class="modal-body">
                    <iframe id="mapEmbededForNow" style="width:100%;height:400px;" src = "https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d4084493.7307095355!2d36.50569875426991!3d-1.3175850003645804!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2ske!4v1715327211380!5m2!1sen!2ske"></iframe>
                    <!--<div id="googleMap" style="width:100%;height:400px;"></div>-->
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button class="btn btn-primary">Save changes</button>
                </div>
            </div>
            
        </div>
    </div>

@endsection

<script>
    function embedMap(lat,long){
        //alert(id);
        var mapEmbedFrame = document.getElementById("mapEmbededForNow");
        mapEmbedFrame.src = "https://maps.google.com/maps?q="+lat+","+long+"&hl=es;z=14&amp&output=embed";
        //var confirmDeleteLink = document.getElementById('confirmDelete'); //or grab it by tagname etc
        //confirmDeleteLink.href = "/deletesale/"+id;
    }
  </script>

