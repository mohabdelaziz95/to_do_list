/**
 * Created by mohamed on 7/12/17.
 */

/**$(document).ready(function(){
        $('.log-btn').click(function(){
            $('.log-status').addClass('wrong-entry');
            $('.alert').fadeIn(50);
            setTimeout( "$('.alert').fadeOut(60000);",60000 );
        });
        $('.form-control').keypress(function(){
            $('.log-status').removeClass('wrong-entry');
        });

    });**/

$('.message a').click(function(){
    $('form').animate({height: "toggle", opacity: "toggle"}, "slow");
});