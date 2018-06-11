$(document).ready(function(){
    $('#post').click(function(){   
        console.log(document.getElementById("location").value);
        console.log(document.getElementById("title").value);
        console.log(document.getElementById("salary").value);
        console.log(document.getElementById("requirement").value);
        console.log(document.getElementById("desc").value);
        $.ajax({
            type: "POST",
            url: "php/post.php",
            data: { 
                  location: document.getElementById("location").value, 
                  title: document.getElementById("title").value, 
                  salary: document.getElementById("salary").value,
                  requirement : document.getElementById("requirement").value,
                  desc : document.getElementById("desc").value
              },
            success: function(msg){          
                alert(msg); 
                location.reload();
            }
        })
    });
});