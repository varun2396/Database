$(document).ready(function(){
            $('#send').click(function(){                
                $.ajax({
                    type: "POST",
                    url: "php/msg.php",
                    data: { 
                          msg: document.getElementById("text").value, 
                          rid: document.getElementById("select").value
                      },
                    success: function(msg){                     
                        console.log(msg);                      
                    }
                })
                    location.reload();

            });
        });