$(document).ready(function () {

});
$(document).on('click', '#update_options_form', function () {
    $('#update_options_form').prop('disable', true);
    $.ajax({headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        method: 'POST',
        url: APP_URL + '/questions-options',
        data: $('#options_form').serializeArray(),
        success: function (result) {
            toastr.success(result.massage);
            setTimeout(function () {
                window.location.href = APP_URL + '/questions-options';
            }, 1000);
        }, error: function (jqXHR, exception) {
            toastr.error(jqXHR.responseJSON.massage);
            $('#update_options_form').prop('disable', false);
        }
    });
});
