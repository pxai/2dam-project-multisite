/**
 * Created by PELLO_ALTADILL on 23/10/2016.
 */
$( document ).ready(function() {
    console.log('In the pipe, five by five...');

    $('#message').keypress(function (ev) {
        var keycode = (ev.keyCode ? ev.keyCode : ev.which);
        if (keycode == '13') {
            console.log('Sending: ' + $(this).val());
            var message = { message : {content: $(this).val(), 'group' : {'id': $(this).data('idgroup')}}};
            $.ajax({
                    url: $(this).data('url'),
                    type: 'POST',
                    data:  JSON.stringify(message),
                   // data:  JSON.stringify({'content': 'epa', 'group' : {'id': '1'}}),
                    contentType : 'application/json'
                })
                .done(function( data ) {
                    alert( "Data Loaded: " + data );
                    $(this).val('');
                });
        }
    });

    (function worker() {
        $.ajax({
            url: $('#chatdiv').data('url'),
            type: 'GET',
            contentType: 'json'})
            .done(function( data ) {
                console.log( "Data Loaded: ");
                console.log(data);
                setTimeout(worker, 5000);
            });
           /* success: function(data) {
                $('.result').html(data);
            },
            complete: function() {
                // Schedule the next request when the current one's complete

            }*/
    })();



});