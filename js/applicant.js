$(document).ready(function(){
    $('#fetch').click(function(){
        document.cookie='jid='+document.getElementById("jid").value;
        location.reload();
    });
});