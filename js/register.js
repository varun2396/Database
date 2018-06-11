document.getElementById("cancelbtn").onclick = function () {
    history.back();
};

document.getElementById("select").onchange = function () {
    if(document.getElementById("select").value=="Company"){
        document.getElementById("company").style.display = 'block'; 
        document.getElementById("student").style.display = 'none';         
    }
    else{
        document.getElementById("student").style.display = 'block'; 
        document.getElementById("company").style.display = 'none';
    }        
};

$(document).ready(function(){
    $("form").submit(function(e){
        e.preventDefault();
        var type=document.getElementById("select").value;
        console.log(type);
        if(type=="Company"){
            if(document.getElementById("uname").value=="" ||
               document.getElementById("pass").value=="" ||
               document.getElementById("pass2").value=="" ||
               document.getElementById("cname").value=="" ||
               document.getElementById("industry").value=="" ||
               document.getElementById("location").value==""){
                alert("Please fill all values for company");
                return false;
            }
        }
        else{
            if(document.getElementById("uname").value=="" ||
               document.getElementById("pass").value=="" ||
               document.getElementById("pass2").value=="" ||
               document.getElementById("sname").value=="" ||
               document.getElementById("major").value=="" ||
               document.getElementById("gpa").value=="" ||
               document.getElementById("interests").value=="" ||
               document.getElementById("resume").value==""){
                alert("Please fill all values for the student");
                return false;
            }
        }
        
        if(document.getElementById("pass").value!=document.getElementById("pass2").value){
            alert("Passwords do not match");
            return false;
        }
        if(type=="Company"){
            $.ajax({
                type: "POST",
                url: "php/registercompany.php",
                data: { 
                      username: document.getElementById("uname").value, 
                      pass: document.getElementById("pass").value,
                      cname : document.getElementById("cname").value,
                      industry : document.getElementById("industry").value,
                      location : document.getElementById("location").value
                  },
                success: function(msg){          
                    console.log(msg);                      
                    if (msg === 'Registered') {
                        alert('Company Registered....Proceed to login');
                        window.location = './login.php';
                    }
                    else{
                        alert('Username already exists');
                    }
                }
            })
        }
        else{
            $.ajax({
                type: "POST",
                url: "php/registerstudent.php",
                data: { 
                      uname: document.getElementById("uname").value, 
                      pass: document.getElementById("pass").value,
                      sname : document.getElementById("sname").value,
                      uid : document.getElementById("university").value,
                      major : document.getElementById("major").value,
                      gpa : document.getElementById("gpa").value,
                      interests : document.getElementById("interests").value,
                      resume : document.getElementById("resume").value
                  },
                success: function(msg){          
                    console.log(msg);                      
                    if (msg === 'Registered') {
                        alert('Student Registered....Proceed to login');
                        window.location = './login.php';
                    }
                    else{
                        alert('Username already exists');
                    }
                }
            })
        }
    });
});