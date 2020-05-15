$(document).ready(function () {

});
$(document).on('click', '#submit_test_form', function () {
    $('#submit_test_form').prop('disable', true);
    $.ajax({headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        method: 'POST',
        url: APP_URL + '/tests',
        data: $('#test_ans_form').serializeArray(),
        success: function (result) {
            setTimeout(function () {
                window.location.href = APP_URL + '/results/' + result.data.id;
            }, 1000);
        }, error: function (jqXHR, exception) {
            toastr.error(jqXHR.responseJSON.massage);
            $('#submit_test_form').prop('disable', false);
        }
    });
});