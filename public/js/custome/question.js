$(document).ready(function () {

});
$(document).on('click', '#submit_questions_form', function () {
    $('#submit_questions_form').prop('disable', true);
    $.ajax({headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        method: 'POST',
        url: APP_URL + '/questions',
        data: $('#questions_form').serializeArray(),
        success: function (result) {
            toastr.success(result.massage);
            setTimeout(function () {
                window.location.href = APP_URL + '/questions';
            }, 1000);
        }, error: function (jqXHR, exception) {
            toastr.error(jqXHR.responseJSON.massage);
            $('#submit_questions_form').prop('disable', false);
        }
    });
});
$(document).on('click', '#update_questions_form', function () {
    $('#update_questions_form').prop('disable', true);
    $.ajax({headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        method: 'PUT',
        url: APP_URL + '/questions/' + $('#id').val(),
        data: $('#questions_form').serializeArray(),
        success: function (result) {
            toastr.success(result.massage);
            setTimeout(function () {
                window.location.href = APP_URL + '/questions';
            }, 1000);
        }, error: function (jqXHR, exception) {
            toastr.error(jqXHR.responseJSON.massage);
            $('#update_questions_form').prop('disable', false);
        }
    });
});