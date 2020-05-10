$(function () {
    $.nette.init();
    // $("select").chosen();

    $("#startButton").click(function(){
       $(this).find('.menu').css({"opacity":"1","width":"190px"});
    });

    $(".menu").mouseleave(function(){
        $(this).css({"opacity":"0","width":"0px"});
    });


    $.datepicker.regional['cs'] = {
        closeText: 'Zavřít',
        prevText: 'Předchozí',
        nextText: 'Další',
        currentText: 'Dnes',
        monthNames: ['Leden','Únor','Březen','Duben','Květen','Červen', 'Červenec','Srpen','Září','Říjen','Listopad','Prosinec'],
        monthNamesShort: ['Le','Ún','Bř','Du','Kv','Čn', 'Čc','Sr','Zá','Ří','Li','Pr'],
        dayNames: ['Neděle','Pondělí','Úterý','Středa','Čtvrtek','Pátek','Sobota'],
        dayNamesShort: ['Ne','Po','Út','St','Čt','Pá','So',],
        dayNamesMin: ['Ne','Po','Út','St','Čt','Pá','So'],
        weekHeader: 'Sm',
        dateFormat: 'dd.mm. yy',
        firstDay: 1,
        isRTL: false,
        showMonthAfterYear: false,
        yearSuffix: ''};

});

