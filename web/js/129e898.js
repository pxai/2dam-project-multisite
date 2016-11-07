/**
 * Created by PELLO_ALTADILL on 23/10/2016.
 */
$( document ).ready(function() {
    var lastMessageId = 0;
    var currentUser = $('#peoplediv').data('id');
    console.log('We\'re in the pipe, five by five...');
    $('#chatdiv').html('');

    $('#sendmessage').click(function (ev) {
            ev.preventDefault();
            var messageText = $('#message').val();
            $('#message').val('');
            console.log('Sending: ' + messageText);
          // nope:  var message = { message : {content: $(this).val(), 'group' : {  'ChatGroup' : {'id': $(this).data('idgroup')}}}};
              var message = { message : {content: messageText, 'user': currentUser,'group' :  $(this).data('idgroup')}};
            $.ajax({
                    url: $(this).data('url'),
                    type: 'POST',
                    data:  JSON.stringify(message),
                   // data:  JSON.stringify({'content': 'epa', 'group' : {'id': '1'}}),
                    contentType : 'application/json'
                })
                .done(function( data ) {
                    console.log( "Data sent. ");
                });
    });

    (function worker() {
        $.ajax({
            url: $('#chatdiv').data('url')+"/"+lastMessageId,
            type: 'GET',
            contentType: 'json'})
            .done(function( data ) {
                console.log( "Data Loaded: ");
                console.log(data); // Be careful with user mapping: it also grabs the password!!
                data.forEach(function (message) {
                    lastMessageId = message.id;
                    appendMessage(message);
                    $("html, body").animate({ scrollTop: $(document).height() }, "slow");
                    return false;
                });
                setTimeout(worker, 5000);
            });
           /* success: function(data) {
                $('.result').html(data);
            },
            complete: function() {
                // Schedule the next request when the current one's complete

            }*/
    })();

    /**
     * Appends new message to div.
     * @param message
     */
    function appendMessage(message) {
        divMessage =  '<div class="divmessage"  class="col-md-6" data-id="'+message.id+'" data-lat="'+message.latitude+'" data-lon="'+message.longitude+'" >';
        //divMessage += ' <div class="divavatar" data-id="'+message.user.id+'"><i class="fa fa-user">;)</i></div>';
        divMessage += '  <div class="divuser"  data-id="'+message.user.id+'">'+message.user.username+'</div>';
        divMessage += '  <div class="divcontent" >'+message.content+'</div>';
        divMessage += '  <div class="divdate" >'+message.message_date+'</div>';
        divMessage += '</div>';
        $('#chatdiv').append(divMessage);
    }

});