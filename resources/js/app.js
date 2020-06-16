require('./bootstrap');
require('./waves');
require('./dashboard');

$(function () {
    $('.ajax-form').on('submit', function (event) {
        event.preventDefault();
        let _this = $(this);
        $.ajax({
            url: _this.attr('action'),
            type: _this.attr('method'),
            data: _this.serialize(),
            success: function (data) {
                showAlert(data.status)
            },
            error: function (data) {
                showAlert('Ошибка при сохранении');
            }
        });
    });

    const pageRowSelector = $('.page-row');
    $(pageRowSelector).on('click', '.delete-button', function () {
        $(this).closest(pageRowSelector).hide();
    });
});

function showAlert(message) {
    $.jGrowl(message);
}



