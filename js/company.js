$(function() {
    //autocomplete
    $(".search").autocomplete({
        source: "php/searchcompany.php",
        minLength: 1
    });                

});

$(document).ready(function(){
    $('#search').on('keydown', function(e) {
        console.log(e.which);
        if (e.which == 13) {
            document.cookie='cname='+document.getElementById("search").value;
            location.reload();
        }
    });
}); 

$(document).ready(function(){
    $('#follow').click(function(){ 
        console.log(document.getElementById("cid").value);
        $.ajax({
            type: "POST",
            url: "php/follow.php",
            data: { 
                  cid: document.getElementById("cid").value, 
              },
            success: function(msg){          
                alert(msg); 
                location.reload();
            }
        })
    });
});