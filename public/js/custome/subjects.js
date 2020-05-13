$(document).ready(function () {

});
$(document).on('click', '#submit_subject_form', function () {
    $('#submit_subject_form').prop('disable', true);
    $.ajax({headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        method: 'POST',
        url: APP_URL + '/subjects',
        data: $('#subject_form').serializeArray(),
        success: function (result) {
            console.log(result);
            toastr.success(result.massage);
            setTimeout(function () {
                window.location.href = APP_URL + '/subjects';
            }, 1000);
        }, error: function (jqXHR, exception) {
            toastr.error(jqXHR.responseJSON.massage);
            $('#submit_subject_form').prop('disable', false);
        }
    });
});