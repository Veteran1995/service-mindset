   


  //Sucess Messages SweetJS
  document.addEventListener('success', event => {
    swal('Success', event.detail.message, 'success');
});
//Sucess Messages SweetJS Ends

   
//Sucess Messages SweetJS
   document.addEventListener('warning', event => {
    swal('Warning', event.detail.message, 'warning');
});

document.addEventListener('danger', event => {
    swal('Danger', event.detail.message, 'danger');
});

document.addEventListener('NotificationEvent', event => {
    console.log('User registered event received:', event.detail.user);
    // Handle the event data
});


    //Info Messages SweetJS
    document.addEventListener('info', event => {
        swal('Information', event.detail.message, 'info');
    });
//Sucess Messages SweetJS Ends

//Sucess Messages Toast
document.addEventListener('toastSuccess', event => {  
iziToast.success({
    title: 'Success!',
    message: event.detail.message,
    position: 'bottomRight'
});
playNotificationSound();
});
//Sucess Messages Toast Ends

function playNotificationSound() {
var audio = new Audio(window.location.origin + '/storage/attachments/notification.mp3');
audio.play();
}


//////////////////////////////

//Sucess Messages Toast
document.addEventListener('toastWarning', event => {  
iziToast.warning({
    title: 'Warning!',
    message: event.detail.message,
    position: 'topRight'
});
});
//Sucess Messages Toast Ends
