$(document).ready(function() {
    
    $("#monimage").fadeOut();
    $("#monimage").fadeIn(10000);
    
    $('#contact-form').submit(function(e){
        
        e.preventDefault();
       
        $('.comments').empty();
        
        var postData=$('#contact-form').serialize();
        
        $.ajax({
           
            type: 'POST',
            url: 'php/contact.php',
            data:postData,
            dataType: 'json',
            success: function(result){
                
                if(result.issuccess){
                    $('#contact-form').append("<p class='thank-you'>Votre message a ete bien envoye :) </p>");
                    $('#contact-form')[0].reset();
                    
                }else{
                    $("#firstname + .comments").html(result.firstnameError);
                    $("#name + .comments").html(result.nameError);
                    $("#email + .comments").html(result.emailError);
                    $("#phone + .comments").html(result.phoneError);
                    $("#message + .comments").html(result.messageError);
                }
            }
        });
        
    });  



});