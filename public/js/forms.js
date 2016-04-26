$(function() {
    $(document).on('submit', 'form', function(e) {
        $('button[type="submit"]').prop('disabled', true).addClass('disabled').text('Loading...');
    });

    $('[data-toggle="tooltip"]').tooltip();
});
