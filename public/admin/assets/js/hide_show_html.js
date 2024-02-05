// Get the select element
var energySourceSelect = document.querySelector('select.otherenergy');
var anomalyRegistered = document.querySelector('select.anomaly_registered');
var contactRegistered = document.querySelector('select.contact_registered');
var anomaly_reported = document.querySelector('select.anomaly_reported');
// Get the input element
var stateSourceInput = document.querySelector('.source');
var registeredType = document.querySelector('.registered_type');
var anomaly_report = document.querySelector('.anomaly_report');

stateSourceInput.style.display = 'none';
registeredType.style.display = 'none';
anomaly_report.style.display = 'none';

anomaly_reported.disabled=true;
anomaly_report.disabled=true;

// Add an event listener to the select element
energySourceSelect.addEventListener('change', function() {
  // Check if the selected value is "Yes"
  if (energySourceSelect.value === 'Yes') {
    // If "Yes" is selected, display the input field
    stateSourceInput.style.display = 'block';
    document.querySelector('.sourcefocus').focus();
  } else {
    // If "No" is selected, hide the input field
    stateSourceInput.style.display = 'none';
    document.querySelector('.sourcefocus').value = '';

  }
});

anomalyRegistered.addEventListener('change', function() {
    // Check if the selected value is "Yes"
    if (anomalyRegistered.value === 'Yes') {
        document.querySelector('.registeredfocus').focus();
      // If "Yes" is selected, display the input field
      registeredType.style.display = 'block';
    
    } else {
      // If "No" is selected, hide the input field
      registeredType.style.display = 'none';
      document.querySelector('.registeredfocus').value = '';

    }
  });

  contactRegistered.addEventListener('change', function() {
    // Check if the selected value is "Yes"
    if (contactRegistered.value === 'Yes') {
      // If "Yes" is selected, display the input field
      anomaly_reported.disabled=false;

    } else {
      // If "No" is selected, hide the input field
      anomaly_reported.disabled=true;
    }
  });

  anomaly_reported.addEventListener('change', function() {
    // Check if the selected value is "Yes"
    if (anomaly_reported.value === 'Yes') {
      // If "Yes" is selected, display the input field
      anomaly_report.style.display = 'block';
      anomaly_report.disabled=false;
      document.querySelector('.reportedfocus').focus();
    } else {
      // If "No" is selected, hide the input field
      anomaly_report.style.display = 'none';
      anomaly_report.disabled=true;
      document.querySelector('.reportedfocus').value = '';

      
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