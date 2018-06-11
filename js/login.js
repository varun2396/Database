document.getElementById("signup").onclick = function () {
    location.href = "register.php";
};

$(document).ready(function(){
    $('#login').click(function(){ 
        console.log(document.getElementById("uname").value);  
        console.log(document.getElementById("pass").value);  
        var type= document.getElementById("select").value;                 
        $.ajax({
            type: "POST",
            url: "php/login.php",
            data: { 
                  username: document.getElementById("uname").value, 
                  pass: document.getElementById("pass").value,
                  utype : document.getElementById("select").value
              },
            success: function(msg){          
                console.log(msg);                      
                if (msg === 'Login') {
                    if(type==='Student')
                        window.location = './shome.php';
                    else
                        window.location = './chome.php';
                }
                else{
                    if(!alert('Invalid Credentials')){;
                        location.reload();
                    }
                }
            }
        })
    });
});