console.log('Скрипт подгрузился в данный модуль!');
window.onbeforeunload = function () {
    return confirm('');
}

$(document).mouseleave(function () {
    //$('#myModal').modal('show');
   // return confirm('Вы действительно хотите закрыть страницу? Несохраненные данные будут потеряны');
});

