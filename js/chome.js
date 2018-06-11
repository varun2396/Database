//forward jobs
$(document).ready(function(){
    $('#filter').click(function(){   
        console.log(document.getElementById("select").value);
        var modal = document.getElementById('modal');
        $.ajax({
            type: "POST",
            url: "php/chomefilter.php",
            data: { 
                  jid: document.getElementById("jid").value, 
                  uid: document.getElementById("select").value, 
                  major: document.getElementById("major").value,
                  gpa : document.getElementById("gpa").value,
                  resume : document.getElementById("resume").value
              },
            success: function(msg){          
                alert("Forwarded");   
            }
        })
        modal.style.display = "none";                
    });
});

//delete job
$(document).ready(function(){
    $('#delete').click(function(){   
        console.log(document.getElementById("aid").value);
        $.ajax({
            type: "POST",
            url: "php/delete.php",
            data: { 
                  jid: document.getElementById("aid").value
              },
            success: function(msg){          
                alert(msg); 
                location.reload();
            }
        })
    });
});

//To click in column aid to show count
jQuery('.a').on('click', function() {
    var $row = jQuery(this).closest('tr');
    var $columns = $row.find('td');
    var $id=$columns[0].textContent;
    $.ajax({
        type: "POST",
        url: "php/chomecount.php",
        data: { 
              id: $id
          },
        success: function(msg){          
            alert("total applications: "+msg);                      
        }
    })
});

//show modal
$(document).ready(function(){
    $('#forward').click(function(){
        console.log("clicked");
        var modal = document.getElementById('modal');
        modal.style.display = "block";
    });
});

//Close on clicking X
var span = document.getElementsByClassName("close")[0];
span.onclick = function() {
    modal.style.display = "none";
}

// Close modal if clicked anywhere else
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}