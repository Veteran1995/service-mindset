/**
 *
 * You can write your JS code here, DO NOT touch the default style file
 * because it will make it harder for you to update.
 * 
 */

"use strict";


// Get the select element
var energySourceSelect = document.querySelector('select.otherenergy');
var anomalyRegistered = document.querySelector('select.anomaly_registered');
// Get the input element
var stateSourceInput = document.querySelector('.source');
var registeredType = document.querySelector('.registered_type');

stateSourceInput.style.display = 'none';
registeredType.style.display = 'none';

// Add an event listener to the select element
energySourceSelect.addEventListener('change', function() {
  // Check if the selected value is "Yes"
  if (energySourceSelect.value === 'Yes') {
    // If "Yes" is selected, display the input field
    stateSourceInput.style.display = 'block';
  } else {
    // If "No" is selected, hide the input field
    stateSourceInput.style.display = 'none';
  }
});

anomalyRegistered.addEventListener('change', function() {
    // Check if the selected value is "Yes"
    if (anomalyRegistered.value === 'Yes') {
      // If "Yes" is selected, display the input field
      registeredType.style.display = 'block';
    } else {
      // If "No" is selected, hide the input field
      registeredType.style.display = 'none';
    }
  });

$(document).ready(function() {
    // Initial state
    $("#history").hide();

    // Toggle visibility when the icon is clicked
    $("#toggleIcon").click(function() {
        $("#history").toggle();

        // Change column class based on visibility
    if ($("#history").is(":visible")) {
        $("#itinerary").removeClass("col-lg-12").addClass("col-lg-9");
    } else {
        $("#itinerary").removeClass("col-lg-9").addClass("col-lg-12");
    }
    });

});

$("#history").hide();
$("#itinerary").removeClass("col-lg-9").addClass("col-lg-12");

  function toggleList() {
    var grid = document.getElementById('grid');
    var list = document.getElementById('list');
    
    if (list.classList.contains('hide')) {
      // Element is currently hidden, so unhide it
      list.classList.remove('hide');
      list.classList.add('show');

      grid.classList.remove('show');
      grid.classList.add('hide');

    } 
  }
 

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
//Fetching Places from Google Maps For Meter Address Ends
/////////////////////////////
function openTaskModal() {
    var modal = document.getElementById('customerModal');
    var myModal = new bootstrap.Modal(modal);
    myModal.show();
  }
//////////////////////
  function openUserModal() {
    var modal = document.getElementById('userModal');
    var myModal = new bootstrap.Modal(modal);
    myModal.show();
  }
////////////////////////////////
  function openReportModal() {
    var modal = document.getElementById('reportModal');
    var myModal = new bootstrap.Modal(modal);
    myModal.show();
  }
////////////////////////////////////////
  function openMeterModal() {
    var modal = document.getElementById('meterModal');
    var myModal = new bootstrap.Modal(modal);
    myModal.show();
  }
//////////////////////
  function openCrewModal() {
    var modal = document.getElementById('crewModal');
    var myModal = new bootstrap.Modal(modal);
    myModal.show();
  }

//////////////////////////////////////////////
  document.addEventListener('viewMemberModal', event => {
    $('#viewMemberModal').modal('show');
});
////////////////////////////////
document.addEventListener('addMemberModal', event => {
    $('#addMemberModal').modal('show');
});

/////////////////////////////////////////////
document.addEventListener('openCrewModal', event => {
    $('#addUserToCrewModal').modal('show');
});






/////////////////////////////////////////////
document.addEventListener('closeCrewModal', event => {
    $('#addUserToCrewModal').modal('hide');
});
/////////////////////////////////////////////
document.addEventListener('openEditTaskModal', event => {
    $('#editTaskModal').modal('show');
});
/////////////////////////////////////////
document.addEventListener('openTaskCommentModal', event => {
  $('#taskCommentModal').modal('show');
});
/////////////////////////////////////////
document.addEventListener('openReadingTaskModal', event => {
  $('#meterReadingModal').modal('show');
});
/////////////////////////////////////////
document.addEventListener('closeReadingTaskModal', event => {
  $('#meterReadingModal').modal('hide');
});
/////////////////////////////////////////
document.addEventListener('closeTaskCommentModal', event => {
  $('#taskCommentModal').modal('hide');
});
/////////////////////////////////////////
const prioritySelect = document.getElementById('prioritySelect');
const prioritySelectUser = document.getElementById('user');
const prioritySelectCrew = document.getElementById('crew');
const individual = document.getElementById('individual');
const group = document.getElementById('group');

prioritySelect.addEventListener('change', function() {
    if (prioritySelect.value === 'Crew') {
        group.style.display = 'block';
        individual.style.display = 'none';
        prioritySelectUser.value==="";
    }else if(prioritySelect.value === 'Individual')
    {
        individual.style.display = 'block';
        group.style.display = 'none';
        prioritySelectCrew.value==="";
    } else {
        
        group.style.display = 'none';
        individual.style.display = 'none';
        prioritySelectCrew.value==="";
        prioritySelectUser.value==="";
}});
//////////////////////////////////////////

// function fetchLongLat(latitude, longitude) {
//     // Access the latitude and longitude parameters and perform your desired actions
//     console.log("Latitude:", latitude);
//     console.log("Longitude:", longitude);
    
//     // Create a map centered at the given latitude and longitude
//     var map = new google.maps.Map(document.getElementById('map'), {
//       center: { lat: latitude, lng: longitude },
//       zoom: 10
//     });
    
//     // Create a marker at the given latitude and longitude
//     var marker = new google.maps.Marker({
//       position: { lat: latitude, lng: longitude },
//       map: map,
//       title: 'Location'
//     });
    
//     // Create a DirectionsService object
//     var directionsService = new google.maps.DirectionsService();
    
//     // Create a DirectionsRenderer object to display the route
//     var directionsRenderer = new google.maps.DirectionsRenderer();
//     directionsRenderer.setMap(map);
    
//     // Set the origin and destination for the route
//     var origin = new google.maps.LatLng(latitude, longitude);
//     var destination = new google.maps.LatLng(DESTINATION_LATITUDE, DESTINATION_LONGITUDE);
    
//     // Create a request object for the DirectionsService
//     var request = {
//       origin: origin,
//       destination: destination,
//       travelMode: 'DRIVING' // You can change the travel mode as needed (e.g., 'WALKING', 'TRANSIT')
//     };
    
//     // Call the DirectionsService to get the route
//     directionsService.route(request, function(result, status) {
//       if (status === 'OK') {
//         // Display the route on the map
//         directionsRenderer.setDirections(result);
//       } else {
//         console.error('Error:', status);
//       }
//     });
//   }

//////////////////////////////////////////////
// function getCurrentLocation() {
//   if (navigator.geolocation) {
//     navigator.geolocation.getCurrentPosition(successCallback, errorCallback);
//   } else {
//     console.log("Geolocation is not supported by this browser.");
//   }
// }

// function successCallback(position) {
//   const latitude = position.coords.latitude;
//   const longitude = position.coords.longitude;

//   Livewire.emit('locationUpdated', { latitude, longitude });
// }

// function errorCallback(error) {
//   console.log("Error getting location: " + error.message);
// }

// getCurrentLocation();

var mapper;

function initMap() {
    

    // fetch('/get-customers') // Replace with your actual route
    //     .then((response) => response.json())
    //     .then((data) => {
    //         data.forEach((customer) => {
    //             if (customer.location) {
    //                 console.log(customer.location)
    //                 // Access latitude and longitude from the "location" relationship
    //                 var latitude = parseFloat(customer.location.latitude);
    //                 var longitude = parseFloat(customer.location.longitude);

    //                 if (!isNaN(latitude) && !isNaN(longitude)) {
    //                     // Create a marker for each customer
    //                     var marker = new google.maps.Marker({
    //                         position: {
    //                             lat: latitude,
    //                             lng: longitude
    //                         },
    //                         map: map,
    //                         title: customer
    //                             .name, // Replace with the field containing customer names
    //                     });
    //                 }
    //             }
    //         });
    //     });
}




function highlightCustomer(element) {
  // Change the CSS style for the element on hover
  element.style.backgroundColor = 'darkgray'; // Change background color
  element.style.borderRadius='25px',
  element.style.color = 'white'; // Change text color
}

function unhighlightCustomer(element) {
  // Reset the CSS style when the mouse leaves
  element.style.backgroundColor = ''; // Reset background color
  element.style.color = ''; // Reset text color
}











  
  








  
  
  


