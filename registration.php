<?php
require_once('config.php');
?>
<html>
    <head>
        <title>GuildArts Registration</title>
        <!--Bootstrap-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
        <!--JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
        <!--CSS-->
        <link href="css\regAndLogStyle.css" rel="stylesheet">

    </head>

    <body>
        <!--Navbar-->
        <nav class="navbar navbar-expand-lg">
                <div class="container-fluid">
                    <!--Navbar Logo-->
                  <a class="navbar-brand" href="#">
                    <img src="\GuildArts\assets\Logo.png" alt="Logo" width="55" height="55">
                  </a>
                    <!--Navbar Name-->
                  <a class="navbar-brand" href="#" style = "color: #D4D4D4;">GuildArts</a>
                  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                  </button>
                  <!--Responsive Collapsing Navbar-->
                  <div class="collapse navbar-collapse" id="navbarScroll">
                    <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">
                      <li class="nav-item">
                        <!--Active Link-->
                        <a class="nav-link" aria-current="page" href="index.html" style = "color: #D4D4D4;">Home</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="#" style = "color: #D4D4D4;">About</a>
                      </li>
                      <!--Dropdown Link for Features-->
                      <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" style = "color: #D4D4D4;">
                          Features
                        </a>
                        <ul class="dropdown-menu">
                          <li><a class="dropdown-item" href="#">Action</a></li>
                          <li><a class="dropdown-item" href="#">Another action</a></li>
                          <li><hr class="dropdown-divider"></li>
                          <li><a class="dropdown-item" href="#">Something else here</a></li>
                        </ul>
                      </li>
                    </ul>
                    
                      <a class="nav-link" aria-current="page" href="login.html" style ="color:#D4D4D4">Already Have an Account? </a>
                      
                  </div>
                </div>
              </nav>
              <div class ="center">
        <div class = "calculator">
            <form action ="registration.php" method ="post"> 
                <div class = "container">
                    <div class = "row">
                        <div class ="col-sm">
               <center> <h1>GET INTO AN <span style="color:#A65A28;">ART</span>FUL <span style="color:#A65A28;">GUILD</span></h1> </center>
               <hr class = "mb-3">
                 <center><h1>Registration</h1></center>
                
                <label for ="firstname"><b>First Name</b></label>
                <input class ="form-control" type = "text" id ="firstname" name ="firstname" required>

                <label for ="lastname"><b>Last Name</b></label>
                <input input class ="form-control" type = "text" id ="lastname" name ="lastname" required>

                <label for ="emailaddress"><b>Email Address</b></label>
                <input input class ="form-control" type = "text" id ="email" name ="email" required>

                <label for ="contactnumber"><b>Contact Number</b></label>
                <input input class ="form-control" type = "text" id ="contactnumber" name ="contactnumber" required>

                <label for ="password"><b>Password</b></label>
                <input input class ="form-control" type = "text" id ="password" name ="password" required>
                <hr class = "mb-3">
                <center><input class ="btn orange-btn"  type = "submit" name = "create" id ="register" value = "Sign Up"></center>

                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script type ="text/javascript">
            $(function(){
                $('#register').click(function(e){

                    var valid = this.form.checkValidity();

                    if(valid)
                    {
                        var firstname   = $('#firstname').val();
			            var lastname	= $('#lastname').val();
			            var email 		= $('#email').val();
			            var contactnumber = $('#contactnumber').val();
			            var password 	= $('#password').val();
                        
                        e.preventDefault();

                        $.ajax({
					type: 'POST',
					url: 'process.php',
					data: {firstname: firstname,lastname: lastname,email: email,contactnumber: contactnumber,password: password},
					success: function(data){
					Swal.fire({
								'title': 'Successful',
								'text': data,
								'type': 'success'
								})
							
					},
					error: function(data){
						Swal.fire({
								'title': 'Errors',
								'text': 'There were errors while saving the data.',
								'type': 'error'
								})
					}
				});
                    }
                    

                    

                })

               
               
            })
        </script>
    </body>
</html>