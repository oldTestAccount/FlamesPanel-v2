$(function() {

    var loading = function() {
    $('#activateBtn').attr('style', 'display: none;');
    $('#activateBtn2').attr('style', 'display: none;');
    $('#domainbox').attr('style', 'display: none;');
    $('#domainbox2').attr('style', 'display: none;');
    $("#domainBox2").hide();
    $("#domainBox").hide();
    $("#basic-addon2").hide();

        // add the overlay with loading image to the page
        var over = '<div id="overlay">' +
            '<img id="loading" src="http://bit.ly/pMtW1K">' +
            '</div>';
        $(over).appendTo('body');

    };

    // you won't need this button click
    // just call the loading function directly
    $('#activateBtn').click(loading);

});

$(function() {

    var loading2 = function() {
    $('#activateBtn').attr('style', 'display: none;');
    $('#activateBtn2').attr('style', 'display: none;');
    $('#domainbox').attr('style', 'display: none;');
    $('#domainbox2').attr('style', 'display: none;');
    $("#domainBox2").hide();
    $("#domainBox").hide();
    $("#basic-addon2").hide();

        // add the overlay with loading image to the page
        var over = '<div id="overlay">' +
            '<img id="loading" src="http://bit.ly/pMtW1K">' +
            '</div>';
        $(over).appendTo('body');

    };

    // you won't need this button click
    // just call the loading function directly
    $('#activateBtn2').click(loading2);

});

