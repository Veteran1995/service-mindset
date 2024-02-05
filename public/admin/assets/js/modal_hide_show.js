document.addEventListener('showForm', event => {
    $('#showForm').modal('show');
});

document.addEventListener('openUserItinerary', event => {
    $('#openUserItinerary').modal('show');
});

document.addEventListener('openItinerary', event => {
    $('#openItinerary').modal('show');
});

document.addEventListener('openComment', event => {
    $('#comment').modal('show');
});

document.addEventListener('openMeterComment', event => {
    $('#meterComment').modal('show');
});

document.addEventListener('openItinerary', event => {
    $('#openEditItinerary').modal('show');
});

document.addEventListener('closeItinerary', event => {
    $('#openEditItinerary').modal('hide');
});

document.addEventListener('openReassignMeter', event => {
    $('#reassignMeter').modal('show');
});

document.addEventListener('closeReassignMeter', event => {
    $('#reassignMeter').modal('hide');
});

document.addEventListener('showRegisterModal', event => {
    $('#registerModal').modal('show');
});
document.addEventListener('closeRegisterModal', event => {
    $('#registerModal').modal('hide');
});

document.addEventListener('openReassignItinerary', event => {
    $('#reassignItinerary').modal('show');
});

document.addEventListener('closeReassignItinerary', event => {
    $('#reassignItinerary').modal('hide');
});

document.addEventListener('openUnassignItinerary', event => {
    $('#unassignItinerary').modal('show');
});

document.addEventListener('closeUnassignItinerary', event => {
    $('#unassignItinerary').modal('hide');
});

document.addEventListener('opensearchMeter', event => {
    $('#searchMeter').modal('show');
});
document.addEventListener('closesearchMeter', event => {
    $('#searchMeter').modal('hide');
});

document.addEventListener('openMeterSearchResult', event => {
    $('#meterSearchResults').modal('show');
});
document.addEventListener('closeMeterSearchResult', event => {
    $('#meterSearchResults').modal('hide');
});

document.addEventListener('addComment', event => {
    $('#addComment').modal('show');
});

document.addEventListener('closeAddComment', event => {
    $('#addComment').modal('hide');
});

document.addEventListener('addMeterComment', event => {
    $('#addMeterComment').modal('show');
});

document.addEventListener('addMeterDeclineComment', event => {
    $('#addMeterDeclineComment').modal('show');
});

document.addEventListener('closeAddMeterComment', event => {
    $('#addMeterComment').modal('hide');
});
document.addEventListener('closeAddMeterDeclineComment', event => {
    $('#addMeterDeclineComment').modal('hide');
});

document.addEventListener('viewCustomerModal', event => {
    $('#viewCustomer').modal('show');
});

document.addEventListener('addCommentModal', event => {
    $('#addCommentModal').modal('show');
});

document.addEventListener('closeCommentModal', event => {
    $('#addCommentModal').modal('hide');
});

document.addEventListener('closeAddMeterDeclineComment', event => {
    $('#addMeterDeclineComment').modal('hide');
});
