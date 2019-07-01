
$(document).ready(function(){
  $(".reply").click(function(){

        var to_user = $(this).attr('data-user');
        var message = $('.reply-message').val();
        if (message != '') {
           $.ajax({ 
        	    type: "POST",
                url: 'chat.php',
                data: { to_user_id: to_user, from_user_id: current_user, message: message },
                success: chat_response,
                dataType: 'json'       
            });
        }else{
        	alert('Please enter message');
        }

        function chat_response(data) {
           if(data.sent == 'yes') {
           	  $('.reply-message').val('');
           }
           if(data.sent == 'no') {
           	alert('Sorry message not sent');
           }
        }
  });
});

$(".chat_with").click(function(e) {
	    
	    $('.chat_with').removeClass('active');
	    $(this).addClass('active');

        $('#chat_with_name').html($(this).text());
        $('.reply').attr('data-user', $(this).attr('data-id'));

		$('#message-body').hide();
		$("#message-body-new").show();
		$('.preloader-chat').show();
		$('#message-body-new').children('.message').remove();
		
		var to_user = $(this).attr('data-id');

		$.ajax({ 
        	    type: "POST",
                url: 'chat_ajax_new.php',
                data: { to_user_id: current_user, from_user_id: to_user },
                success: chat_response,
                dataType: 'json'       
            });
        
        function chat_response(data) {
          //alert(data.res);
          $('.preloader-chat').hide();
         if(data.res == 'success'){
         	$.each( data.data, function( key, value ) {
        		if(value.from_user_id == current_user) {
        			$('#message-body-new').append('<div class="message right">'+value.message+'<br><span class="time_m" title="'+ value.time +'Z"></span></div>');
        		}else{
        			$('#message-body-new').append('<div class="message left">'+value.message+'<br><span class="time_m" title="'+ value.time +'Z"></span></div>');
        		}
        		$(".time_m").timeago();
        		$('.message').parent().scrollTop(100000);
           }); 
         }else{
         	$('#message-body-new').append('<div class="message nomessage" style="margin-top: 10%;">No message</div>');
         }
      }
});

setInterval(function(){ 

        var to_user = $('.reply').attr('data-user');

           $.ajax({ 
        	    type: "POST",
                url: 'chat_ajax.php',
                data: { to_user_id: to_user, from_user_id: current_user, last_message_id: last_message_id },
                success: chat_response,
                dataType: 'json'       
            });
        
        function chat_response(data) {
        	if(data.length > 0) {
        	$.each( data, function( key, value ) {
        		if(value.from_user_id == current_user) {
        			var block_msg = '<div class="message right">'+value.message+'<br><span class="time_m" title="'+ value.time +'Z"></span></div>';
        			$('.message').last().after(block_msg);
        		}else{
        			var block_msg = '<div class="message left">'+value.message+'<br><span class="time_m" title="'+ value.time +'Z"></span></div>';
        			$('.message').last().after(block_msg);
        			//sound
                    var x = document.getElementById("myAudio"); 
                    x.play(); 
        		}
        		    $(".time_m").timeago();
        			$('.message').parent().scrollTop(100000);
           });
            
           $('.nomessage').hide(); 
           var lastindex = data.length - 1;
           last_message_id = data[lastindex].id;
           //alert(last_message_id)
        	}
        }

 }, 2000);

        



