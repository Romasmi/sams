require('./bootstrap');
require('./waves');
require('./dashboard');

$(function () {
    $('.ajax-form').on('submit', function (event) {
        event.preventDefault();
        let _this = $(this);
        _this.find('button[type=submit]').attr('disabled', 'true');
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

    const pageRowSelector = $('.table-row');
    $(pageRowSelector).on('click', '.delete-button', function () {
        $(this).closest(pageRowSelector).hide();
    });

    $('.update-button').on('click', function () {
        $(this).find('.fa').addClass('fa-spinner');
        $(this).addClass('loading');
    })
});

function showAlert(message) {
    $.jGrowl(message);
}



