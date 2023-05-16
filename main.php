<?php
// We need to use sessions, so you should always start sessions using the below code.
session_start();

if (!isset($_SESSION['loggedin'])) {
	header('Location: index.html');
	exit;
}
// If the user is not logged in redirect to the login page...
// if (!isset($_SESSION['loggedin'])) {
// 	header('Location: login.php');
// 	exit;
// }

?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
		<title>Home Page</title>
        <!--Icons-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/uicons-regular-rounded/css/uicons-regular-rounded.css'>
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/uicons-solid-straight/css/uicons-solid-straight.css'>
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/uicons-regular-straight/css/uicons-regular-straight.css'>
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/uicons-bold-rounded/css/uicons-bold-rounded.css'>
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/uicons-bold-straight/css/uicons-bold-straight.css'>
        <!--Bootstrap-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
		<link href="css\mainPageStyle.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer">
	</head>
	<body>
    <nav class="navbar navbar-expand-lg">
                <div class="container-fluid">
                    <!--Navbar Logo-->
                  <a class="navbar-logo" href="#">
                    <img src="assets\Logo.png" alt="Logo" width="85" height="85">
                  </a>
                    <!--Navbar Name-->
                  <a class="navbar-brand" href="#" style = "color: #D4D4D4;">Main Gallery</a>

                  <!--Home-->
                  <span class="hovertext" data-hover="Home">
                    <a href="main.php"><button class="btnNow"><i class="fi fi-ss-house-chimney"></i></button></a>
                    </span>
                    <!--Online Workshops-->
                    <span class="hovertext" data-hover="Online Workshops">
                  <button class="btn"><i class="fi fi-rs-ballot"></i></button>
                  </span>
                    <!--Resource Library-->
                    <span class="hovertext" data-hover="Resource Library">
                    <a href="resource.php"><button class="btn"><i class="fi fi-rr-books"></i></button></a>
                  </span>
                    <!--Art Marketplace-->
                    <span class="hovertext" data-hover="Art Marketplace">
                  <button class="btn"><i class="fi fi-rs-shop"></i></button>
                  </span>
                    <!--Virtual Exhibit-->
                    <span class="hovertext" data-hover="Virtual Exhibit">
                  <button class="btn"><i class="fi fi-br-eye"></i></button>
                  </span>
                  <!--Profile-->
                  <span class="hovertext" data-hover="Profile">
                  <a href="profile.php"><button class="btn">
                    <i class="fi fi-br-user" href="profile.php"></i></button></a>
                    </span>
                  <!--Logout-->
                    <span class="hovertext" data-hover="Logout">
                  <a href="includes\logout.inc.php"><button class="btn">
                    <i class="fi fi-bs-sign-out-alt"></i></button></a>
                  </div>
                </div>
              </nav>
              <a href="uploadGallery.php" class="btn btn-success"><i class="fa fa-plus"></i> Upload a Post</a>
		<div class="content">
      
      

    <section class = "gallery-links">
        
        <div class = "gallery-container">
        <?php
        include_once 'includes\dbh.inc.php';

        $sql = "SELECT * FROM gallery ORDER BY orderGallery DESC;";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt,$sql))
        {
          echo "SQL stament failed! HAHAHAHAH";
        }
        else
        {
          mysqli_stmt_execute($stmt);
          $result = mysqli_stmt_get_result($stmt);

          while($row = mysqli_fetch_assoc($result))
          {
            
            echo'
            
            <a href ="#">
            <hr>
            <div style = "background-image: url(uploads/gallery/'.$row["imgFullNameGallery"].'); "></div>
            <h3>'.$row["titleGallery"].'</h3>
            <p>'.$row["descGallery"].'</p>
            
            </a>
            <p>Posted by: <a href="visitProfile.php?userid=' . $row["userid"] . '&useruid=' . $row["useruid"] . '">' . $row["useruid"] . '</a></p>
            <p>Uploaded On '.$row["created_at"].'</p>
            ';
            
          }
        }
        ?>

</div>
  </section>
  </div>
  
		
	</body>
</html>
