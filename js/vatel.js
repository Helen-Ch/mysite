$(document).ready(function(){jQuery(function($){$(".phone").mask("+7(999) 999-9999");});$("[data-fancybox]").fancybox({});$('form[name=order1], form[name="order2"]').on("submit",function(){var form=$(this).serializeArray();$("#myModal").modal("show");$.ajax({url:"/addon/vatel.php",type:"POST",cache:false,data:form,success:function(msg){$(".form-control").val("");}});return false;});$("form[name=order3]").on("submit",function(){var form=$(this).serializeArray();$.ajax({url:"/addon/vatel.php",type:"POST",cache:false,data:form,success:function(msg){$("form[name=order3]").remove();$("#myModalForm h4").text("спасибо за заявку!").css("padding-top","30px").css("text-transform","uppercase");$(".modal-body").text("Наш менеджер перезвонит Вам в ближайшее время.").css("padding-bottom","30px");}});return false;});$("#myModalForm").on("shown.bs.modal",function(){$("#InputLogin").focus();});var end1=Date.parse("01/01/2020 00:00:00");var end2=new Date(2019,12,1);function remainTime(end){var today=Date.now();if(end>today){var remain=Math.floor(end-today)/1000;var sec=Math.floor(remain%60);if(sec<10){sec="0"+sec;}var min=Math.floor((remain/60)%60);if(min<10){min="0"+min;}var hours=Math.floor((remain/(60*60))%24);if(hours<10){hours="0"+hours;}var days=Math.floor(remain/(60*60*24));if(days<10){days="0"+days;}}else{days="00";hours="00";min="00";sec="00";}return{total:remain,days:days,hours:hours,minutes:min,seconds:sec};}function showTimer(id,end){var clock=document.getElementById(id);function startTimer(){var t=remainTime(end);clock.innerHTML="<div>"+t.days+'</div><div class="divider">:</div><div>'+t.hours+'</div><div class="divider">:</div><div>'+t.minutes+'</div><div class="divider">:</div><div>'+t.seconds+"</div>";if(t.total<=0){clearInterval(repeat);}}startTimer();var repeat=setInterval(startTimer,1000);}showTimer("timer1",end1);showTimer("timer2",end2);var equal_height=0;$(".discount .col-sm-4").each(function(){if($(this).height()>equal_height){equal_height=$(this).height();}});$(".discount .col-sm-8").height(equal_height);});