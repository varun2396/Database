$(document).ready(function(){
    $('#Apply').click(function(){                
        $.ajax({
            type: "POST",
            url: "php/apply.php",
            data: { 
                  jid: document.getElementById("jid").value
              },
            success: function(msg){                     
                alert(msg);   
                location.reload();                
            }
        })
    });
});

$(document).ready(function(){
    $('#fwd').click(function(){    
        console.log(document.getElementById("jid2").value);
        console.log(document.getElementById("select").value);
        $.ajax({
            type: "POST",
            url: "php/forward.php",
            data: { 
                  jid: document.getElementById("jid2").value,
                  fid: document.getElementById("select").value
              },
            success: function(msg){                     
                alert(msg);                      
            }
        })
    });
});

$(document).ready(function(){
    $('#accept').click(function(){    
        $.ajax({
            type: "POST",
            url: "php/friendrequest.php",
            data: { 
                  friend: document.getElementById("friend").value,
                  value : "yes"
              },
            success: function(msg){                     
                console.log(msg);   
                location.reload();                
            }
        })
    });
});

$(document).ready(function(){
    $('#reject').click(function(){    
        $.ajax({
            type: "POST",
            url: "php/friendrequest.php",
            data: { 
                  friend: document.getElementById("friend").value,
                  value : "no"
              },
            success: function(msg){                     
                console.log(msg);     
                location.reload();
            }
        })
    });
});

$(document).ready(function(){
    $('#block').click(function(){    
        $.ajax({
            type: "POST",
            url: "php/friendrequest.php",
            data: { 
                  friend: document.getElementById("friend").value,
                  value : "blocked"
              },
            success: function(msg){                     
                console.log(msg);  
                location.reload();                
            }
        })
    });
});