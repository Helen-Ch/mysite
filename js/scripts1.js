/**
 * Created by Home on 15.06.2017.
 */

$(document).ready(function () {
    $('input[name="total"]').click(function () {
        if (!$('input[name="total"]').is(":checked"))
            $('input[name="ids[]"]').removeAttr("checked");
        else
            $('input[name="ids[]"]').attr("checked", "checked");
    });
});

$(function () {
    $.datepicker.setDefaults($.datepicker.regional['uk']);
    $('.datepicker').datepicker({
        showOn: "both",
        buttonImage: "/images/calendar.png",
        buttonImageOnly: true,
        changeMonth: true,
        changeYear: true,
        yearRange: "2012:2020",
        showOtherMonths: true
    });

});