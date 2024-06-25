@include('components/header')
@include('components/header-extension-main')

    @yield('content')

    @include('components/footer-main')

    <script>
        function myMap() {
        var mapProp= {
          center:new google.maps.LatLng(51.508742,-0.120850),
          zoom:5,
        };
        var map = new google.maps.Map(document.getElementById("googleMap"),mapProp);
        }
        myMap();
        </script>
        <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY&callback=myMap"></script>

<script>
  
  //var table = $('#responsive-datatable').DataTable();
// $('#nameInput').on('keyup', function() {
//         table.column(1).search(this.value).draw(); // Column index 0 for 'Name'
//     });

//     $('#phoneInput').on('keyup', function() {
//         table.column(2).search(this.value).draw(); // Column index 1 for 'Position'
//     });
</script>