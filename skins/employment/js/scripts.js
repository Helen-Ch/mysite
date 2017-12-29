console.log('Скрипт подгрузился в данный модуль!');
function del(){
    return confirm('Вы действительно хотите удалить запись?');
}

window.onload = function () {
    $('#unpubModal').modal('show');
    $('[data-toggle="tooltip"]').tooltip();

}