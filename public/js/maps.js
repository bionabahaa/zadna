var blat = document.getElementById('location[lat]').value;
var blng = document.getElementById('location[lng]').value;
var markers;

function initMap() {

    var marker;
    map = new google.maps.Map(document.getElementById("map"), {
        center: { lat: blat, lng: blng },
        zoom: 15
    });
    infoWindow = new google.maps.InfoWindow;

    // Try HTML5 geolocation.
    if (!blat && !blng) {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
                var pos = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude
                };
                map.setCenter(pos);
                var latlng = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
                infoWindow.setContent("<p class='text-center pull-left' style = 'height:30px;width:200px'>Your Location</p>");
                geocoder.geocode({ 'location': latlng }, function(results, status) {
                    if (status === 'OK') {
                        if (results[0]) {
                            map.setZoom(15);
                            placeMarker(latlng);
                            infowindow.setContent(results[0].formatted_address);
                            console.log(results[0]);
                            infowindow.open(map, marker);
                        } else {
                            window.alert('No results found');
                        }

                    } else {
                        window.alert('Geocoder failed due to: ' + status);
                    }
                });


            });
        }
    } else {
        var geocoder = new google.maps.Geocoder();
        map.setCenter(new google.maps.LatLng(blat, blng));
        var latlng = new google.maps.LatLng(blat, blng);
        geocoder.geocode({ 'location': latlng }, function(results, status) {
            if (status === 'OK') {
                if (results[0]) {
                    map.setZoom(15);
                    placeMarker(latlng);
                    //   infoWindow.setContent("<p class='text-center pull-left' style = 'height:30px;width:200px'>Branch Location</p>");
                    //   infowindow.setContent(results[0].formatted_address);
                    //   infowindow.open(map, marker);
                } else {
                    window.alert('No results found');
                }
            } else {
                window.alert('Geocoder failed due to: ' + status);
            }
        });

    }



    google.maps.event.addListener(map, 'click', function(event) {
        marker.setMap(null);
        placeMarker(event.latLng);
        document.getElementById('location[lat]').value = event.latLng.lat();
        document.getElementById('location[lng]').value = event.latLng.lng();
    });

    function placeMarker(location) {

        marker = new google.maps.Marker({
            position: location,
            map: map
        });

    }


    var input = document.getElementById('pac-input');

    var autocomplete = new google.maps.places.Autocomplete(
        input);
    autocomplete.bindTo('bounds', map);

    map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

    var infowindow = new google.maps.InfoWindow();
    var infowindowContent = document.getElementById('infowindow-content');
    // infowindow.setContent(infowindowContent);
    var geocoder = new google.maps.Geocoder;
    var marker = new google.maps.Marker({
        map: map
    });

    marker.addListener('click', function() {
        infowindow.open(map, marker);
    });

    autocomplete.addListener('place_changed', function() {
        var place = autocomplete.getPlace();
        //   console.log(place);
        //   placeMarker(place.geometry.location);
        document.getElementById('location[lat]').value = place.geometry.location.lat();
        document.getElementById('location[lng]').value = place.geometry.location.lng();
        //   if (!place.place_id) {
        //       return;
        //   }
        geocoder.geocode({ 'placeId': place.place_id }, function(results, status) {

            if (status !== 'OK') {
                window.alert('Geocoder failed due to: ' + status);
                return;
            }
            map.setZoom(11);
            map.setCenter(results[0].geometry.location);
            // Set the position of the marker using the place ID and location.
            marker.setPlace({
                placeId: place.place_id,
                location: results[0].geometry.location
            });
            marker.setVisible(true);

            infowindowContent.children['place-name'].textContent = place.name;
            infowindowContent.children['place-id'].textContent = place.place_id;
            infowindowContent.children['place-address'].textContent = results[0].formatted_address;
            infowindow.open(map, marker);
        });
    });
}