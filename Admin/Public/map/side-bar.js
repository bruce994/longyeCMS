$(function () {
    $("#aFloatTools_Show1").click(function () {
        $('#sideBarContents').animate({ width: 'show', opacity: 'show' }, 1000, function () { $('#sideBarContents').show(); });
        $('#aFloatTools_Show1').hide();
        $('#aFloatTools_Hide1').show();
    });
    $("#aFloatTools_Hide1").click(function () {
        $('#sideBarContents').animate({ width: 'hide', opacity: 'hide' }, 1000, function () { $('#sideBarContents').hide(); });
        $('#aFloatTools_Show1').show();
        $('#aFloatTools_Hide1').hide();
    });
    $("#aFloatTools_Show").click(function () {
        $('#con_one_1').animate({ width: 'show', opacity: 'show' }, 1000, function () { $('#con_one_1').show(); });
        $('#aFloatTools_Show').hide();
        $('#aFloatTools_Hide').show();
    });
    $("#aFloatTools_Hide").click(function () {
        $('#con_one_1').animate({ width: 'hide', opacity: 'hide' }, 1000, function () { $('#con_one_1').hide(); });
        $('#aFloatTools_Show').show();
        $('#aFloatTools_Hide').hide();
    });
    $("#a1").click(function () {
        $('#con_one_2').animate({ width: 'show', opacity: 'show' }, 1000, function () { $('#con_one_2').show(); });
        $('#a1').hide();
        $('#a2').show();
    });
    $("#a2").click(function () {
        $('#con_one_2').animate({ width: 'hide', opacity: 'hide' }, 1000, function () { $('#con_one_2').hide(); });
        $('#a1').show();
        $('#a2').hide();
    });
    $("#a3").click(function () {
        $('#con_one_3').animate({ width: 'show', opacity: 'show' }, 1000, function () { $('#con_one_3').show(); });
        $('#a3').hide();
        $('#a4').show();
    });
    $("#a4").click(function () {
        $('#con_one_3').animate({ width: 'hide', opacity: 'hide' }, 1000, function () { $('#con_one_3').hide(); });
        $('#a3').show();
        $('#a4').hide();
    });
    $("#a5").click(function () {
        $('#con_one_4').animate({ width: 'show', opacity: 'show' }, 1000, function () { $('#con_one_3').show(); });
        $('#a5').hide();
        $('#a6').show();
    });
    $("#a6").click(function () {
        $('#con_one_4').animate({ width: 'hide', opacity: 'hide' }, 1000, function () { $('#con_one_3').hide(); });
        $('#a5').show();
        $('#a6').hide();
    });
});