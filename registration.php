<html>
    <head>
        <title>GuildArts Registration</title>
        <!--Bootstrap-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
        <!--JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
        <!--CSS-->
        <link href="css\registrationStyle.css" rel="stylesheet">
        <!-- Online fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro&display=swap" rel="stylesheet">

    </head>

    <body>
        <!--Navbar-->
        <nav class="navbar navbar-expand-lg">
                <div class="container-fluid">
                    <!--Navbar Logo-->
                    <a class="navbar-brand" href="#">
                    <img src="assets\Logo.png" alt="Logo" width="100" height="80" style="padding-left: 20px;">
                  </a>
                    <!--Navbar Name-->
                    <a class="navbar-brand" href="#" style = "color: #D4D4D4;font-family: 'Source Sans Pro', sans-serif; font-size: 20px; opacity: 60%; padding-right: 25px;">GuildArts</a>
                  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                  </button>
                  <!--Responsive Collapsing Navbar-->
                  <div class="collapse navbar-collapse" id="navbarScroll">
                    <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">
                      <li class="nav-item">
                        <!--Active Link-->
                        <a class="nav-link" aria-current="page" href="index.html" style = "color: #D4D4D4;font-family: 'Source Sans Pro', sans-serif; font-size: 20px; padding-right: 15px;">Home</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="#" style = "color: #D4D4D4;font-family: 'Source Sans Pro', sans-serif; font-size: 20px; padding-right: 15px;">About</a>
                      </li>
                      <!--Dropdown Link for Features-->

                    </ul>
                    
                     
                      
                  </div>
                </div>
              </nav>
              <div class ="center">
        <div class = "calculator">
            <form action ="includes\signup.inc.php" method ="post"> 
                <div class = "container">
                    <div class = "row">
                        <div class ="col-sm">
               <center> <h1>GET INTO AN <span style="color:#A65A28;">ART</span>FUL <span style="color:#A65A28;">GUILD</span></h1> </center>
               <hr class = "mb-3">
                 <center><h1>Registration</h1></center>
                
                <label for ="firstname"><b>Full Name</b></label>
                <input class ="form-control" type = "text" name ="name" required>

                <label for ="emailaddress"><b>Email Address</b></label>
                <input input class ="form-control" type = "text" name ="email" required>

                <label for ="username"><b>Username</b></label>
                <input input class ="form-control" type = "text" name ="uid" required>

                <label for ="password"><b>Password</b></label>
                <input input class ="form-control" type = "password" name ="pwd" required>
              
                <label for ="password"><b>Confirm Password</b></label>
                <input input class ="form-control" type = "password" name ="confirmPwd" required>
                <hr class = "mb-3">

                <center>
                <a class="nav-link" aria-current="page" href="login.php" style="color:#525252;font-size: 19px;">Already Have an Account? Click me</br></br>
                <input class ="btn orange-btn"  type = "submit" name = "submit"></center>
                <?php
    if(isset($_GET["error"]))
    {
      if($_GET["error"]=="emptyinput")
      {
        echo "<p>Fill in all Fields!</p>";
      }
      else if($_GET["error"]=="invalidUid")
      {
        echo "<p>Choose a proper username!</p>";
      }
      else if($_GET["error"]=="invalidEmail")
      {
        echo "<p>Choose a proper email</p>";
      }
      else if($_GET["error"]=="passwordsdontmatch")
      {
        echo "<p>Passwords do not match!</p>";
      }
      else if($_GET["error"]=="stmtfailed")
      {
        echo "<p>Something went wrong!</p>";
      }
      else if($_GET["error"]=="usernametaken")
      {
        echo "<p>Username or Email Already Taken!</p>";
      }
      else if($_GET["error"]=="none")
      {
        echo "<p>You have succesfully registered!</p>";
      }

    }
    ?>

                        </div>
                    </div>
                </div>
            </form>
        </div>
        
    </div>
    
    </body>
</html>