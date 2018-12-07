console.log('Скрипт подгрузился в данный модуль!');

//TEST API
function apiAjax(n) {
    var form = $("form[name=" + n + "]").serialize();
    $.ajax({
        url: '/api/test',
        type: "POST",
        cache: false,
        data: form,
        dataType: 'text',
        success: function (msg) {
            if (msg !== undefined) {
                $('#response').text(msg);
                $("html, body").animate({ scrollTop: 0 }, 500);
            }
        }
    });
    return false;
}