$(document).ready(function() {
    $('.menu-item').hover(function() {
        var itemId = $(this).data('id');
        $('#' + itemId).toggle();
    });
});