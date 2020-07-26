@extends('base_layouts.master_layout')
@section('title' , __('map.titleMap'))

@section('style')
    <style>
        #map{
           height: 65vh; 
           width: 100%;
        }
    </style>
@endsection

@section('content')
       
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title"><strong> <i class="fa fa-map"></i> {{__('map.Map')}}</strong></h3>
        </div>
        <div class="panel-body"> 
            <form action="{{route('mapLocation.store')}}" method="POST">
                @csrf
                <div class="form-group col col-md-4" >
                    <label for="lat">LAT : </label>
                    <input required class="@error('lat') is-invalid @enderror" type="text" name='lat' id="lat" placeholder="Lat" style="width: 90%">
                    @error('lat')
                        <div class="invalid-feedback alert-danger text-center" role="alert">
                            <strong>{{ $message }}</strong>
                        </div>
                    @enderror
                </div>
                <div class="form-group col col-md-4" >
                    <label for="lat">LNG : </label>
                    <input required class="@error('lng') is-invalid @enderror" type="text" name='lng' id="lng" placeholder="Lng" style="width: 90%">
                    @error('lng')
                        <div class="invalid-feedback alert-danger text-center" role="alert">
                            <strong>{{ $message }}</strong>
                        </div>
                    @enderror
                </div>
                <div class="form-group col col-md-4" >
                   <button name="submit" type="submit">Save</button>
                </div>
            </form>
            <br>
            <div id="map"></div>
        </div>
    </div>
    
@endsection

@section('script')
    <script>
        var map;
// ------------------main---function-----------------------
        function initMap() {
            map = new google.maps.Map(document.getElementById("map"), {
                center: { lat: -34.397, lng: 150.644 },
                zoom: 4
            });
            // setByInput(-34.397,150.644);
           
            var marker = new google.maps.Marker({
                map: map,
                draggable: true,
                animation: google.maps.Animation.DROP,
                position: { lat: -34.397, lng: 150.644 },
            });
 
        //-------1-----------
            setMarkers(map);
        //---------2-------------
            //  // This event listener calls addMarker() when the map is clicked.
            // google.maps.event.addListener(map, 'click', function(event) {
            //     addMarker(event.latLng, map);
            // });
            // // Add a marker at the center of the map.
            // addMarker(bangalore, map);
        //-----------3------------
            google.maps.event.addListener(map, 'click', function(event) {
                var newLocation = event.latLng;
                $('#lat').val(newLocation.lat());
                $('#lng').val(newLocation.lng());
                changeLocationTo(newLocation,map,marker);
                // console.log('lat: ' + newLocation.lat());
                // console.log('Lng: ' + newLocation.lng());
            }); 
        }
      
//-----------new----function-1-------use--dec.--google-map----------new----function-1--------------------------

// Data for the markers consisting of a name, a LatLng and a zIndex for the
// order in which these markers should display on top of each other.
    var beaches = [
        ['Bondi Beach', -36.890542, 154.274856, 4],
        ['Coogee Beach', -31.923036, 153.259052, 5],
        ['Cronulla Beach', -22.028249, 151.157507, 3],
        ['Manly Beach', -25.80010128657071, 152.28747820854187, 2],
        ['Maroubra Beach', -40.950198, 150.259302, 1]
    ];
    function setMarkers(map) {
        // Adds markers to the map.
        // Marker sizes are expressed as a Size of X,Y where the origin of the image
        // (0,0) is located in the top left of the image.
        // Origins, anchor positions and coordinates of the marker increase in the X
        // direction to the right and in the Y direction down.
        var image = {
            url: 'https://developers.google.com/maps/documentation/javascript/examples/full/images/beachflag.png',
            // This marker is 20 pixels wide by 32 pixels high.
            size: new google.maps.Size(20, 32),
            // The origin for this image is (0, 0).
            origin: new google.maps.Point(0, 0),
            // The anchor for this image is the base of the flagpole at (0, 32).
            anchor: new google.maps.Point(0, 32)
        };
        // Shapes define the clickable region of the icon. The type defines an HTML
        // <area> element 'poly' which traces out a polygon as a series of X,Y points.
        // The final coordinate closes the poly by connecting to the first coordinate.
        var shape = {
            coords: [1, 1, 1, 20, 18, 20, 18, 1],
            type: 'poly'
        };
        for (var i = 0; i < beaches.length; i++) {
            var beach = beaches[i];
            var marker = new google.maps.Marker({
                position: {lat: beach[1], lng: beach[2]},
                map: map,
                icon: image,
                shape: shape,
                title: beach[0],
                zIndex: beach[3],
                animation: google.maps.Animation.DROP,
                title: 'test marker by A7med Qeshta',
                draggable : true , // to be move by mose
            });
        }
    }
    //---------------------------------END-function-1--------------------------------------------- 

//-----------new----function-2-------use--dec.--google-map----------new----function-2--------------------------
var labels = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
var labelIndex = 0;
 // Adds a marker to the map.
 function addMarker(location, map) {
            // Add the marker at the clicked location, and add the next-available label
            // from the array of alphabetical characters.
            var marker = new google.maps.Marker({
                position: location,
                label: labels[labelIndex++ % labels.length],
                map: map
            });
}
    // google.maps.event.addDomListener(window, 'load', initMap);
           
//---------------------------------END-function-2---------------------------------------------                     

//-----------new----function-3-------use--dec.--google-map----------new----function-3--------------------------
function changeLocationTo(location,map,marker) {
    marker.setPosition(location);
    map.setCenter(location);
}
//---------------------------------END-function-3---------------------------------------------                     

function setByInput(latInput,lngInput) {
    // var marker = new google.maps.Marker({
    //             map: map,
    //             draggable: false,
    //             position: { lat: latInput, lng: lngInput },
    // });
    marker = new google.maps.Marker({
                map: map,
                draggable: true,
                animation: google.maps.Animation.DROP,
                position: { lat: latInput, lng: lngInput },
            });
}
        
    </script>

<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDbgTY04pDcC0bDAOxrICYt_8uqydIYX0s&callback=initMap"></script>    
@endsection




