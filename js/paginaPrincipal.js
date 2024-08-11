$(document).ready(function() {
    $('#menu-toggle').on('click', function() {
        $('#sidebar').toggleClass('open');
        $('#page-content-wrapper').toggleClass('open');
    });
});
