function initMap() {
    const outboundmap = new google.maps.Map(document.getElementById("outboundmap"), {
      center: { lat: 6.2907, lng: -10.7605 }, // Set a default center (e.g., Liberia)
      zoom: 8,
    });

    // Try HTML5 geolocation
    if (navigator.geolocation) {
      navigator.geolocation.getCurrentPosition((position) => {
        const currentLocation = {
          lat: position.coords.latitude,
          lng: position.coords.longitude,
        };
        outboundmap.setCenter(currentLocation);

        // Add a marker for the current location
        const marker = new google.maps.Marker({
          position: currentLocation,
          map: outboundmap,
          title: "Your Location",
          draggable: true,
        });

        // Update the marker position and input fields when the marker is dragged
        marker.addListener('dragend', () => {
          const draggedLocation = marker.getPosition();
          document.getElementById('longitude_field').value = draggedLocation.lng();
          document.getElementById('latitude_field').value = draggedLocation.lat();

          const geocoder = new google.maps.Geocoder();
          geocoder.geocode({ 'location': draggedLocation }, (results, status) => {
            if (status === 'OK') {
              if (results[0]) {
                // Update the location field with the formatted address
                document.getElementById('location_field').value = results[0].formatted_address;
              } else {
                console.log('No results found');
              }
            } else {
              console.log('Geocoder failed due to: ' + status);
            }
          });
        });
      }, () => {
        // Handle geolocation error
        handleLocationError(true, outboundmap.getCenter());
      });
    } else {
      // Browser doesn't support Geolocation
      handleLocationError(false, outboundmap.getCenter());
    }

    // Update the input fields when the map is clicked
    outboundmap.addListener("click", (e) => {
    
    const longitude = document.getElementById('longitude_field');
    const latitude = document.getElementById('latitude_field');
    const location = document.getElementById('location_field');

      longitude.value = e.latLng.lng();
      latitude.value = e.latLng.lat();

      const geocoder = new google.maps.Geocoder();
      geocoder.geocode({ 'location': e.latLng }, (results, status) => {
        if (status === 'OK') {
          if (results[0]) {
            // Update the location field with the formatted address
            location.value = results[0].formatted_address;
          } else {
            console.log('No results found');
          }
        } else {
          console.log('Geocoder failed due to: ' + status);
        }
      });
      Livewire.emit('placeSelected', {
        address: location.value,
        latitude: latitude.value,
        longitude: longitude.value
    });


    });
  }

  function handleLocationError(browserHasGeolocation, pos) {
    // Handle geolocation error
    // You can customize this function to display an error message or take other actions
  }

  $(document).ready(function(){
    initMap();

  });


  


  
//Fetching Places from Google Maps For Customer Address
var locationInput = 'location_input';
var latitudeInput = 'latitude_input';
var longitudeInput = 'longitude_input';

$(document).ready(function() {
    var autocomplete;
    autocomplete = new google.maps.places.Autocomplete((document.getElementById(locationInput)), {
        types: ['geocode'],
    });

    google.maps.event.addListener(autocomplete, 'place_changed', function() {
        var place = autocomplete.getPlace();

        if (place.geometry && place.geometry.location) {
            var latitude = place.geometry.location.lat();
            var longitude = place.geometry.location.lng();

            // Update the latitude and longitude input fields
            document.getElementById(latitudeInput).value = latitude;
            document.getElementById(longitudeInput).value = longitude;

            // Emit the event with the selected place data
            Livewire.emit('placeSelected', {
                address: place.formatted_address,
                latitude: latitude,
                longitude: longitude
            });

        }
    });
});

//Fetching Places from Google Maps For Customer Address Ends

//Fetching Places from Google Maps For Meter Address
var searchInput = 'search_input';
var latitudeField = 'latitude_field';
var longitudeField = 'longitude_field';

$(document).ready(function() {
    var autocomplete;
    autocomplete = new google.maps.places.Autocomplete((document.getElementById(searchInput)), {
        types: ['geocode'],
    });

    google.maps.event.addListener(autocomplete, 'place_changed', function() {
        var place = autocomplete.getPlace();

        if (place.geometry && place.geometry.location) {
            var latitude = place.geometry.location.lat();
            var longitude = place.geometry.location.lng();

            // Update the latitude and longitude input fields
            document.getElementById(latitudeField).value = latitude;
            document.getElementById(longitudeField).value = longitude;

            // Emit the event with the selected place data
            Livewire.emit('addressSelected', {
                address: place.formatted_address,
                latitude: latitude,
                longitude: longitude
            });
        }
    });
});



/////////////////////////////////////////////
document.addEventListener('updateMarkers', event => {

    var customers = event.detail.customers;

    var map = new google.maps.Map(document.getElementById('map'), {
        center: {
            lat: 6.315607,
            lng: -10.807370
        },
        zoom: 16
    });

    customers.forEach(customer => {
        if (customer && customer.location) {
            // Access latitude and longitude from the "location" relationship
            var latitude = parseFloat(customer.location.latitude);
            var longitude = parseFloat(customer.location.longitude);

            if (!isNaN(latitude) && !isNaN(longitude)) {
                // Generate the URL for the avatar image
                // var avatarImageUrl = asset('storage/images/male_avatar.png'); // Adjust the path
                // Create a marker for each customer
                var marker = new google.maps.Marker({
                    position: {
                        lat: latitude,
                        lng: longitude
                    },
                    map: map,
                    title: customer.geo_community, // Replace with the field containing customer names
                    // icon: {
                    //     url: '{{ asset("public/users-avatar/avatar.png") }}',
                    //     scaledSize: new google.maps.Size(40, 40) // Adjust the size as needed
                    // }
                });

                // Create an InfoWindow with customer details
                var infoWindowContent = `
                    <div>
                        <p><strong>Name:</strong> ${customer.customer_name}</p>
                        <p><strong>Community:</strong> ${customer.geo_community}</p>
                        <p><strong>Geo Zone:</strong> ${customer.geo_zone}</p>
                        <p><strong>Contact:</strong> ${customer.customer_phone_one}</p>
                        <!-- Add more details as needed -->
                    </div>
                `;

                var infoWindow = new google.maps.InfoWindow({
                    content: infoWindowContent
                });

                // Add a click event listener to show the InfoWindow
                marker.addListener('click', function () {
                    infoWindow.open(map, marker);
                });
            }
        }
    });
});

document.addEventListener('customerLocation', event => {

    var customer = event.detail.location;

    var customermap = new google.maps.Map(document.getElementById('customermap'), {

        center: {
            lat:parseFloat(customer.latitude),
            lng: parseFloat(customer.longitude),
        },
        zoom: 16
    });

        if (customer) {
            // Access latitude and longitude from the "location" relationship
            var latitude = parseFloat(customer.latitude);
            var longitude = parseFloat(customer.longitude);

                var marker = new google.maps.Marker({
                    position: {
                        lat: latitude,
                        lng: longitude
                    },
                    map: customermap,
                    title: 'Customer Location', // Replace with the field containing customer names

                });

        }

});



function showCustomerLocation(latitude, longitude) {
    var map = new google.maps.Map(document.getElementById('map'), {
        center: {
            lat: latitude,
            lng: longitude
        },
        zoom: 13
    });

    // Create Marker 1 at the provided latitude and longitude
    var marker1 = new google.maps.Marker({
        position: {
            lat: latitude,
            lng: longitude
        },
        map: map,
        title: 'Customer',
        
    });


// Get the current user's location
// if (navigator.geolocation) {
//     navigator.geolocation.getCurrentPosition(function(position) {
//         var currentLat = position.coords.latitude;
//         var currentLng = position.coords.longitude;

//         // Create a Marker for the current location
//         var currentLocationMarker = new google.maps.Marker({
//             position: {
//                 lat: currentLat,
//                 lng: currentLng
//             },
//             map: map,
//             title: 'Current Location'
//         });

//         // Create a Route from Marker 1 to Marker 2
//         var directionsService = new google.maps.DirectionsService();
//         var directionsRenderer = new google.maps.DirectionsRenderer();
//         directionsRenderer.setMap(map);

//         var request = {
//             origin: {
//                 lat: currentLat,
//                 lng: currentLng
//             },
//             destination: {
//                 lat:latitude,
//                 lng: longitude
//             },
//             travelMode: 'DRIVING'
//         };

//         directionsService.route(request, function(result, status) {
//             if (status == 'OK') {
//                 directionsRenderer.setDirections(result);


//                 // Get the total distance and duration
//                 var route = result.routes[0];
//                 var distance = 0;
//                 var duration = 0;

//                 for (var i = 0; i < route.legs.length; i++) {
//                     distance += route.legs[i].distance.value;
//                     duration += route.legs[i].duration.value;
//                 }

//                 // Convert distance to kilometers and duration to minutes
//                 distance = (distance / 1000).toFixed(2);
//                 duration = Math.round(duration / 60);

//                 // Display the total distance and duration in a <p> tag
//                 document.getElementById('distance').textContent = 'Total Distance: ' +
//                     distance + ' km';
//                 document.getElementById('duration').textContent = 'Total Duration: ' +
//                     duration + ' minutes';

//             }
//         });
//     });
// }

}


function loadAllCustomersMap() {
    // Create a map centered at Marker 1
    var map = new google.maps.Map(document.getElementById('map'), {
        center: {
            lat: 6.315607,
            lng: -10.807370
        },
        zoom: 12
    });

    fetch('/ajax-get-customers') // Replace with your actual route
        .then((response) => response.json())
        .then((data) => {
            data.forEach((customer) => {
                if (customer.location) {
                    // Access latitude and longitude from the "location" relationship
                    var latitude = parseFloat(customer.location.latitude);
                    var longitude = parseFloat(customer.location.longitude);

                    if (!isNaN(latitude) && !isNaN(longitude)) {
                        // Generate the URL for the avatar image
                        // var avatarImageUrl = asset('storage/images/male_avatar.png'); // Adjust the path
                        // Create a marker for each customer
                        var marker = new google.maps.Marker({
                            position: {
                                lat: latitude,
                                lng: longitude
                            },
                            map: map,
                            title: customer.geo_community, // Replace with the field containing customer names
                            // icon: {
                            //     url: asset('storage/path/to/your/avatar-icon.png'),
                            //     scaledSize: new google.maps.Size(40, 40) // Adjust the size as needed
                            // }
                        });

                        // Create an InfoWindow with customer details
                        var infoWindowContent = `
                            <div>
                                <p><strong>Name:</strong> ${customer.customer_name}</p>
                                <p><strong>Community:</strong> ${customer.geo_community}</p>
                                <p><strong>Geo Zone:</strong> ${customer.geo_zone}</p>
                                <p><strong>Contact:</strong> ${customer.customer_phone_one}</p>
                                <!-- Add more details as needed -->
                            </div>
                        `;

                        var infoWindow = new google.maps.InfoWindow({
                            content: infoWindowContent
                        });

                        // Add a click event listener to show the InfoWindow
                        marker.addListener('click', function () {
                            infoWindow.open(map, marker);
                        });
                    }
                }
            });
        });



    // Get the current user's location
    // if (navigator.geolocation) {
    //     navigator.geolocation.getCurrentPosition(function(position) {
    //         var currentLat = position.coords.latitude;
    //         var currentLng = position.coords.longitude;

    //         // Create a Marker for the current location
    //         var currentLocationMarker = new google.maps.Marker({
    //             position: {
    //                 lat: currentLat,
    //                 lng: currentLng
    //             },
    //             map: map,
    //             title: 'Current Location'
    //         });

    //         directionsService.route(request, function(result, status) {
    //             if (status == 'OK') {
    //                 directionsRenderer.setDirections(result);


    //                 // Get the total distance and duration
    //                 var route = result.routes[0];
    //                 var distance = 0;
    //                 var duration = 0;

    //                 for (var i = 0; i < route.legs.length; i++) {
    //                     distance += route.legs[i].distance.value;
    //                     duration += route.legs[i].duration.value;
    //                 }

    //                 // Convert distance to kilometers and duration to minutes
    //                 distance = (distance / 1000).toFixed(2);
    //                 duration = Math.round(duration / 60);

    //                 // Display the total distance and duration in a <p> tag
    //                 document.getElementById('distance').textContent = 'Total Distance: ' +
    //                     distance + ' km';
    //                 document.getElementById('duration').textContent = 'Total Duration: ' +
    //                     duration + ' minutes';

    //             }
    //         });
    //     });
    // }
}