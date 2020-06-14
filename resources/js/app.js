require('./bootstrap');
require('./waves');
require('./dashboard');

$(function () {
    $('.ajax-form').on('submit', function (event) {
        event.preventDefault();
        let _this = $(this);
        let serverResponse = _this.find('.server-response');

        $.ajax({
            url: _this.attr('action'),
            type: _this.attr('method'),
            data: _this.serialize(),
            success: function (data) {
                serverResponse.html(data.status).fadeIn();
            },
            error: function (data) {
                serverResponse.html('Ошибка при сохранении.').fadeIn();
            }
        });
    });
});


