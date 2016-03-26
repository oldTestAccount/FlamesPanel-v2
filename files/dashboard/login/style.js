$(function() {

    var loading = function() {
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
