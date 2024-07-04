
@extends('layout-form')

<style>


/* style.css */
/* body {
    font-family: Arial, sans-serif;
} */
 
.sortable-list {
    margin: 0 auto 0 0;
}
 
.sortable {
    list-style-type: none;
    padding: 0;
}
 
.list-item {
    background-color: #f0f0f0;
    padding: 10px;
    margin: 5px;
    cursor: grab;
}

</style>


@section('content')



<div class="side-app">

    <!-- CONTAINER -->
    <div class="main-container container-fluid">

  <!-- PAGE-HEADER -->
  <div class="page-header">
    <h1 class="page-title">Create Route Plan Stage 2</h1>
    <div>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">RTMS</a></li>
            <li class="breadcrumb-item active" aria-current="page">Create Route Plan Stage 2</li>
        </ol>
    </div>
</div>
<!-- PAGE-HEADER END -->


<div class="col-xl-12 row">
    <div class="card col-md-8">
        <div class="card-header">
            <h3 class="card-title">Create Route Plan Stage 2</h3> 
        </div>
        <div class="card-body">
            <!--<p>Use <code class="highlighter-rouge">.table-striped</code>to add zebra-striping to any table row within the <code class="highlighter-rouge">.tbody</code>.</p>-->
            
                
                    <form action="/saverouteplan" method="POST">
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
                            <label for="name" class="form-label">Route Plan Name (Optional)</label>
                            <input type="name" class="form-control" name="name" id="name" placeholder="Name" value="{{old('name')}}" autocomplete="name">
                        </div>

                        <div class="sortable-list">
                            <label for="password" class="form-label">Order Outlets</label>
                            <ul id="sortable">
                                @foreach ($outletArray as $outlet)
                                <li class="list-item" draggable="true" data-id="{{$outlet['id']}}">{{$outlet['name']}}</li>
                                @endforeach
                                <!-- Add more list items as needed -->
                            </ul>
                        </div>


                            <div class="form-group">
                                <label for="password" class="form-label">Hidden</label>
                                {{-- <input  name="order" id="order"> --}}
                                <input type="text" class="form-control" name="outletIds" id="outletIds" placeholder="outletIds" autocomplete="outletIds" value="{{$outletString}}">
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

<script>
    document.addEventListener("DOMContentLoaded", function() {
        $(function() {
            $("#sortable").sortable({
                start: function(event, ui) {
                    console.log("Dragging started on item: ", ui.item.index());
                },
                stop: function(event, ui) {
                    // alert("Dragging stopped on item: ", ui.item.index());
                    var order = $("#sortable").sortable("toArray", { attribute: "data-id" });
                    //alert(order);
                    //alert(order.join(","));
                    //document.getElementById('order').value = order.join(',');
                    $("#outletIds").val(order.join(","));

                },
                sort: function(event, ui) {
                    console.log("Item is being dragged");
                }
        });
            $("#sortable").disableSelection();
            
            $("#sortableForm").on("submit", function(event) {
                var order = $("#sortable").sortable("toArray", { attribute: "data-id" });
                $("#outletIds").val(order.join(","));
            });
        });


const sortableList =
    document.getElementById("sortable");
let draggedItem = null;
 
sortableList.addEventListener(
    "dragstart",
    (e) => {
        draggedItem = e.target;
        setTimeout(() => {
            e.target.style.display =
                "none";
        }, 0);
        alert("start");
});
 
sortableList.addEventListener(
    "dragend",
    (e) => {
        setTimeout(() => {
            e.target.style.display = "";
            draggedItem = null;
        }, 0);
        alert("end");
});
 
sortableList.addEventListener(
    "dragover",
    (e) => {
        e.preventDefault();
        const afterElement =
            getDragAfterElement(
                sortableList,
                e.clientY);
        const currentElement =
            document.querySelector(
                ".dragging");
        if (afterElement == null) {
            sortableList.appendChild(
                draggedItem
            );} 
        else {
            sortableList.insertBefore(
                draggedItem,
                afterElement
            );}
            alert("over");
    });
 
const getDragAfterElement = (
    container, y
) => {
    const draggableElements = [
        ...container.querySelectorAll(
            "li:not(.dragging)"
        ),];
 
    return draggableElements.reduce(
        (closest, child) => {
            const box =
                child.getBoundingClientRect();
            const offset =
                y - box.top - box.height / 2;
            if (
                offset < 0 &&
                offset > closest.offset) {
                return {
                    offset: offset,
                    element: child,
                };} 
            else {
                return closest;
            }},
        {
            offset: Number.NEGATIVE_INFINITY,
        }
    ).element;
    alert("not sure");
};
    });
    </script>