 <!DOCTYPE html>
 <html lang="en">


 <!-- index.html  21 Nov 2019 03:44:50 GMT -->

 <head>
     <meta charset="UTF-8">
     <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
     <title>LEC - Liberia Electricity Corporations</title>
     <!-- General CSS Files -->
     <link rel="stylesheet" href="{{ asset('admin/assets/css/app.min.css') }}">
     <!-- Template CSS -->
     <link rel="stylesheet" href="{{ asset('admin/assets/bundles/datatables/datatables.min.css') }}">
     <link rel="stylesheet"
         href="{{ asset('admin/assets/bundles/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css') }}">

     <link rel="stylesheet" href="{{ asset('admin/assets/css/style.css') }}">
     <link rel="stylesheet" href="{{ asset('admin/assets/css/components.css') }}">
     <!-- Custom style CSS -->
     <link rel='shortcut icon' type='image/x-icon' href='{{ asset('admin/assets/img/lec.jpg') }}' />

     <link rel="stylesheet" href="{{ asset('admin/assets/bundles/bootstrap-daterangepicker/daterangepicker.css') }}">
     <link rel="stylesheet"
         href="{{ asset('admin/assets/bundles/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css') }}">
     <link rel="stylesheet" href="{{ asset('admin/assets/bundles/select2/dist/css/select2.min.css') }}">
     <link rel="stylesheet" href="{{ asset('admin/assets/bundles/jquery-selectric/selectric.css') }}">
     <link rel="stylesheet"
         href="{{ asset('admin/assets/bundles/bootstrap-tagsinput/dist/bootstrap-tagsinput.css') }}">
     <link rel="stylesheet"
         href="{{ asset('admin/assets/bundles/bootstrap-timepicker/css/bootstrap-timepicker.min.css') }}">
     <link rel="stylesheet"
         href="{{ asset('admin/assets/bundles/bootstrap-tagsinput/dist/bootstrap-tagsinput.css') }}">
     <link rel="stylesheet" href="{{ asset('admin/assets/bundles/izitoast/css/iziToast.min.css') }}">
     <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Raleway:wght@100;200;300;400&display=swap" rel="stylesheet">
     <script async defer
         src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDIu_L90jAzvZDeY5ummZSeSdXuejshURQ&callback=initMap"></script>

     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
     <!-- Include jQuery library -->
     <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
     <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
     <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.min.js" defer></script>
     @vite(['resources/css/app.css', 'resources/js/app.js'])
     <style>
         /* CSS for the floating section indicator */
         .floating-indicator {
             position: fixed;
             bottom: 20px;
             right: 20px;
             background-color: #007bff;
             color: #fff;
             border-radius: 4px;
             padding: 10px 20px;
             opacity: 0;
             transition: opacity 0.5s;
             z-index: 999;
         }

         .disabled-text {
             background-color: #f8f9fa;
             padding: 0.375rem 0.75rem;
             border: 1px solid #ced4da;
             border-radius: 0.25rem;
             pointer-events: none;
             /* This prevents interaction with the text */
             opacity: 0.65;
             /* You can adjust the opacity to make it visually appear disabled */
         }

         /* Show the indicator when wire:loading is true */
         .floating-indicator.active {
             opacity: 1;
         }
     </style>

     @livewireStyles
 </head>

 <body style="font-family: 'Raleway', sans-serif;">
     <div class="loader"></div>
     <div id="app">
         <div class="main-wrapper main-wrapper-1">
             <div class="navbar-bg"></div>
             <livewire:admin.navbar.navbar />

             @include('layouts.inc.admin.sidebar')

             <!-- Main Content -->
             <div class="main-content">
                 @yield('content')
             </div>

             <div class="settingSidebar">
                 <a href="javascript:void(0)" class="settingPanelToggle"> <i class="fa fa-spin fa-cog"></i>
                 </a>
                 <div class="settingSidebar-body ps-container ps-theme-default" tabindex="2"
                     style="overflow: hidden; outline: none;">
                     <div class=" fade show active">
                         <div class="setting-panel-header">Setting Panel
                         </div>
                         <div class="p-15 border-bottom">
                             <h6 class="font-medium m-b-10">Select Layout</h6>
                             <div class="selectgroup layout-color w-50">
                                 <label class="selectgroup-item">
                                     <input type="radio" name="value" value="1"
                                         class="selectgroup-input-radio select-layout" checked="">
                                     <span class="selectgroup-button">Light</span>
                                 </label>
                                 <label class="selectgroup-item">
                                     <input type="radio" name="value" value="2"
                                         class="selectgroup-input-radio select-layout">
                                     <span class="selectgroup-button">Dark</span>
                                 </label>
                             </div>
                         </div>
                         <div class="p-15 border-bottom">
                             <h6 class="font-medium m-b-10">Sidebar Color</h6>
                             <div class="selectgroup selectgroup-pills sidebar-color">
                                 <label class="selectgroup-item">
                                     <input type="radio" name="icon-input" value="1"
                                         class="selectgroup-input select-sidebar">
                                     <span class="selectgroup-button selectgroup-button-icon" data-toggle="tooltip"
                                         data-original-title="Light Sidebar"><i class="fas fa-sun"></i></span>
                                 </label>
                                 <label class="selectgroup-item">
                                     <input type="radio" name="icon-input" value="2"
                                         class="selectgroup-input select-sidebar" checked="">
                                     <span class="selectgroup-button selectgroup-button-icon" data-toggle="tooltip"
                                         data-original-title="Dark Sidebar"><i class="fas fa-moon"></i></span>
                                 </label>
                             </div>
                         </div>
                         <div class="p-15 border-bottom">
                             <h6 class="font-medium m-b-10">Color Theme</h6>
                             <div class="theme-setting-options">
                                 <ul class="choose-theme list-unstyled mb-0">
                                     <li title="white" class="active">
                                         <div class="white"></div>
                                     </li>
                                     <li title="cyan">
                                         <div class="cyan"></div>
                                     </li>
                                     <li title="black">
                                         <div class="black"></div>
                                     </li>
                                     <li title="purple">
                                         <div class="purple"></div>
                                     </li>
                                     <li title="orange">
                                         <div class="orange"></div>
                                     </li>
                                     <li title="green">
                                         <div class="green"></div>
                                     </li>
                                     <li title="red">
                                         <div class="red"></div>
                                     </li>
                                 </ul>
                             </div>
                         </div>
                         <div class="p-15 border-bottom">
                             <div class="theme-setting-options">
                                 <label class="m-b-0">
                                     <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input"
                                         id="mini_sidebar_setting">
                                     <span class="custom-switch-indicator"></span>
                                     <span class="control-label p-l-10">Mini Sidebar</span>
                                 </label>
                             </div>
                         </div>
                         <div class="p-15 border-bottom">
                             <div class="theme-setting-options">
                                 <label class="m-b-0">
                                     <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input"
                                         id="sticky_header_setting">
                                     <span class="custom-switch-indicator"></span>
                                     <span class="control-label p-l-10">Sticky Header</span>
                                 </label>
                             </div>
                         </div>
                         <div class="mt-4 mb-4 p-3 align-center rt-sidebar-last-ele">
                             <a href="#" class="btn btn-icon icon-left btn-primary btn-restore-theme">
                                 <i class="fas fa-undo"></i> Restore Default
                             </a>
                         </div>
                     </div>
                 </div>
                 <div id="ascrail2001" class="nicescroll-rails nicescroll-rails-vr"
                     style="width: 8px; z-index: 999; cursor: default; position: absolute; top: 0px; left: 272px; height: 961px; display: none;">
                     <div class="nicescroll-cursors"
                         style="position: relative; top: 0px; float: right; width: 6px; height: 0px; background-color: rgb(66, 66, 66); border: 1px solid rgb(255, 255, 255); background-clip: padding-box; border-radius: 5px;">
                     </div>
                 </div>
                 <div id="ascrail2001-hr" class="nicescroll-rails nicescroll-rails-hr"
                     style="height: 8px; z-index: 999; top: 953px; left: 0px; position: absolute; cursor: default; display: none;">
                     <div class="nicescroll-cursors"
                         style="position: absolute; top: 0px; height: 6px; width: 0px; background-color: rgb(66, 66, 66); border: 1px solid rgb(255, 255, 255); background-clip: padding-box; border-radius: 5px;">
                     </div>
                 </div>
             </div>

             @include('layouts.inc.admin.footer')

         </div>
     </div>
     <!-- General JS Scripts -->
     <script src="{{ asset('admin/assets/js/app.min.js') }}"></script>
     <!-- Page Specific JS File -->
     <script src="{{ asset('admin/assets/bundles/datatables/datatables.min.js') }}"></script>
     <script src="{{ asset('admin/assets/bundles/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js') }}">
     </script>
     <script src="{{ asset('admin/assets/bundles/datatables/export-tables/dataTables.buttons.min.js') }}"></script>
     <script src="{{ asset('admin/assets/bundles/datatables/export-tables/buttons.flash.min.js') }}"></script>
     <script src="{{ asset('admin/assets/bundles/datatables/export-tables/jszip.min.js') }}"></script>
     <script src="{{ asset('admin/assets/bundles/datatables/export-tables/pdfmake.min.js') }}"></script>
     <script src="{{ asset('admin/assets/bundles/datatables/export-tables/vfs_fonts.js') }}"></script>
     <script src="{{ asset('admin/assets/bundles/datatables/export-tables/buttons.print.min.js') }}"></script>
     <script src="{{ asset('admin/assets/js/page/datatables.js') }}"></script>
     <!-- JS Libraies -->

     <script src="{{ asset('admin/assets/bundles/cleave-js/dist/cleave.min.js') }}"></script>
     <script src="{{ asset('admin/assets/bundles/cleave-js/dist/addons/cleave-phone.us.js') }}"></script>
     <script src="{{ asset('admin/assets/bundles/jquery-pwstrength/jquery.pwstrength.min.js') }}"></script>
     <script src="{{ asset('admin/assets/bundles/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
     <script src="{{ asset('admin/assets/bundles/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js') }}"></script>
     <script src="{{ asset('admin/assets/bundles/bootstrap-timepicker/js/bootstrap-timepicker.min.js') }}"></script>
     <script src="{{ asset('admin/assets/bundles/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js') }}"></script>
     <script src="{{ asset('admin/assets/bundles/select2/dist/js/select2.full.min.js') }}"></script>
     <script src="{{ asset('admin/assets/bundles/jquery-selectric/jquery.selectric.min.js') }}"></script>

     <script src="{{ asset('admin/assets/bundles/apexcharts/apexcharts.min.js') }}"></script>
     <!-- Page Specific JS File -->
     <script src="{{ asset('admin/assets/js/page/index.js') }}"></script>
     <!-- Template JS File -->
     <script src="{{ asset('admin/assets/js/scripts.js') }}"></script>
     <!-- Custom JS File -->
     <script src="{{ asset('admin/assets/js/custom.js') }}"></script>
     <script src="{{ asset('admin/assets/js/maps.js') }}"></script>
     <script src="{{ asset('admin/assets/js/success_error_messages.js') }}"></script>
     <script src="{{ asset('admin/assets/js/modal_hide_show.js') }}"></script>
     <script src="{{ asset('admin/assets/js/hide_show_html.js') }}"></script>
     <script src="{{ asset('admin/assets/js/import.js') }}"></script>
     <script src="{{ asset('admin/assets/js/importConsumption.js') }}"></script>
     <script src="{{ asset('admin/assets/js/charts.js') }}"></script>
     <script src="{{ asset('admin/assets/bundles/jquery-validation/dist/jquery.validate.min.js') }}"></script>
     <!-- JS Libraies -->
     <script src="{{ asset('admin/assets/bundles/jquery-steps/jquery.steps.min.js') }}"></script>
     <!-- Page Specific JS File -->
     <script src="{{ asset('admin/assets/js/page/form-wizard.js') }}"></script>

     <script src="{{ asset('admin/assets/bundles/sweetalert/sweetalert.min.js') }}"></script>
     <!-- Page Specific JS File -->
     <script src="{{ asset('admin/assets/js/page/sweetalert.js') }}"></script>

     <script src="{{ asset('admin/assets/bundles/izitoast/js/iziToast.min.js') }}"></script>
     <!-- Page Specific JS File -->
     <script src="{{ asset('admin/assets/js/page/toastr.js') }}"></script>
     <script src="{{ asset('admin/assets/js/page/forms-advanced-forms.js') }}"></script>
     {{-- <script src="{{ asset('admin/assets/bundles/gmaps.js') }}"></script> --}}
     <!-- Page Specific JS File -->
     {{-- <script src="{{ asset('admin/assets/js/page/gmaps-marker.js') }}"></script>
    <script src="{{ asset('admin/assets/js/page/gmaps-geolocation.js') }}"></script> --}}
     {{-- <script src="{{ asset('admin/assets/bundles/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('admin/assets/js/page/ckeditor.js') }}"></script> --}}
     <script
         src="https://maps.googleapis.com/maps/api/js?v=3.exp&libraries=places&key=AIzaSyDIu_L90jAzvZDeY5ummZSeSdXuejshURQ&amp;sensor=true">
     </script>
     <link rel="stylesheet" href="{{ asset('admin/assets/css/custom.css') }}">
     <script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/proj4js/2.9.0/proj4.js"
         integrity="sha512-lO8f7sIViqr9x5VE6Q72PS6f4FoZcuh5W9YzeSyfNRJ9z/qL3bkweiwG6keGzWS0BQzNDqAWXdBhYzFD6KffIw=="
         crossorigin="anonymous" referrerpolicy="no-referrer"></script>
     <script>
         CKEDITOR.replace('body');
         CKEDITOR.instances.body.on('change', function() {
             var content = CKEDITOR.instances.body.getData();
             Livewire.emit('ckeditorContentUpdated', content);
         });
     </script>

     <script>
         $(document).ready(function() {

             $('#email_address').keyup(function() {
                 var query = $(this).val();
                 if (query != '') {
                     var _token = $('input[name="_token"]').val();
                     $.ajax({
                         url: "{{ route('autocomplete.fetch') }}",
                         method: "POST",
                         data: {
                             query: query,
                             _token: _token
                         },
                         success: function(data) {
                             $('#email_list').fadeIn();
                             $('#email_list').html(data);
                         }
                     });
                 }
             });

             $(document).on('click', 'li', function() {
                 $('#email_address').val($(this).text());
                 $('#email_list').fadeOut();

                 Livewire.emit('emailSelected', $('#email_address').val());


             });

         });
     </script>
     <script>
         document.addEventListener("livewire:load", function() {
             const autocompleteInput = document.getElementById('email_address');

             autocompleteInput.addEventListener('input', function() {
                 Livewire.component('livewire.admin.email.compose').set('receiver_email', this.value);
             });
         });
     </script>

     <script>
         setInterval(function() {
             Livewire.emit('refreshComponent');
         }, 5000); // 5 minutes in milliseconds
     </script>
     <script>
         // Define a function to convert UTM to Lat/Long
         function convertUTMToLatLong(utmX, utmY) {
             // Define the source and target coordinate systems
             proj4.defs("EPSG:32629", "+proj=utm +zone=29 +datum=WGS84 +units=m +no_defs");
             proj4.defs("EPSG:4326", "+proj=longlat +datum=WGS84 +no_defs");

             // Perform the coordinate conversion
             var convertedCoordinates = proj4("EPSG:32629", "EPSG:4326", [utmX, utmY]);

             return {
                 latitude: convertedCoordinates[1],
                 longitude: convertedCoordinates[0]
             };
         }

         // Read the CSRF token from the <meta> tag
         var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

         // Your JavaScript code here

         // Fetch customer data from your database (replace with your API endpoint)
         // fetch('http://127.0.0.1:8000/api/customers') // Replace with your API endpoint for fetching customer data
         .then(response => response.json())
             .then(data => {
                 // Process each customer's UTM coordinates and convert to Lat/Long
                 data.forEach(customer => {
                     var convertedCoords = convertUTMToLatLong(customer.gis_x_coordinates, customer
                         .gis_y_coordinates);

                     // Send the converted coordinates to your Laravel route
                     fetch('http://127.0.0.1:8000/api/update-customer-location', {
                             method: 'POST',
                             headers: {
                                 'Content-Type': 'application/json',
                                 'X-CSRF-TOKEN': csrfToken, // Include CSRF token if needed
                             },
                             body: JSON.stringify({
                                 customer_id: customer.cnumber,
                                 latitude: convertedCoords.latitude,
                                 longitude: convertedCoords.longitude
                             })
                         })
                         .then(response => response.json())
                         .then(result => {
                             console.log(result);
                         })
                         .catch(error => {
                             console.error(error);
                         });
                 });
             })
             .catch(error => {
                 console.error(error);
             });
     </script>
     {{-- <script>
        function getCurrentLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(successCallback, errorCallback);
            } else {
                console.log("Geolocation is not supported by this browser.");
            }
        }

        function successCallback(position) {
            const latitude = position.coords.latitude;
            const longitude = position.coords.longitude;

            Livewire.emit('locationUpdated', {
                latitude,
                longitude
            });
        }

        function errorCallback(error) {
            console.log("Error getting location: " + error.message);
        }

        getCurrentLocation();
    </script> --}}
     <!-- Include SheetJS from CDN -->
     <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
     <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.5/xlsx.full.min.js"></script>

     <script>
         loadAllCustomersMap();
     </script>



     @livewireScripts
 </body>


 <!-- index.html  21 Nov 2019 03:47:04 GMT -->

 </html>
