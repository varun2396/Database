$(function() {
    //autocomplete
    $(".search").autocomplete({
        source: "php/searchstudent.php",
        minLength: 1
    });                

});

$(document).ready(function(){
    $('#search').on('keydown', function(e) {
        console.log(e.which);
        if (e.which == 13) {
            document.cookie='username='+document.getElementById("search").value;
            location.reload();
        }
    });
}); 

$(document).ready(function(){
    $('#send').click(function(){ 
        $.ajax({
            type: "POST",
            url: "php/friend.php",
            data: { 
                  uname: document.getElementById("uname").value, 
              },
            success: function(msg){          
                alert(msg); 
                location.reload();
            }
        })
    });
});