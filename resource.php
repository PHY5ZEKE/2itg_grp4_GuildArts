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

require_once 'includes\dbh.inc.php';

?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Resource Library</title>
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
		<link href="css\resourceStyle.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer">
	</head>
	<body>
    <nav class="navbar navbar-expand-lg">
                <div class="container-fluid">
                    <!--Navbar Logo-->
                  <a class="navbar-brand" href="#">
                    <img src="assets\Logo.png" alt="Logo" width="55" height="55">
                  </a>
                    <!--Navbar Name-->
                  <a class="navbar-brand" href="#" style = "color: #D4D4D4; opacity:.75">GuildArts</a>

                  <!--Home-->
                  <span class="hovertext" data-hover="Home">
                    <a href="main.php"><button class="btn"><i class="fi fi-ss-house-chimney"></i></button></a>
                    </span>
                    <!--Online Workshops-->
                    <span class="hovertext" data-hover="Online Workshops">
                    <a href="workshop.html"> <button class="btn"><i class="fi fi-rs-ballot"></i></button></a>
                  </span>
                    <!--Resource Library-->
                    <span class="hovertext" data-hover="Resource Library">
                    <a href="workshop.html"> <button class="btn"><i class="fi fi-rs-ballot" style = "color: #A65A28;"></i></button></a>
                  </span>
                    <!--Art Marketplace-->
                    <span class="hovertext" data-hover="Art Marketplace">
                    <a href="artmarketplace.php"><button class="btn"><i class="fi fi-rs-shop"></i></button></a>
                  </span>
                    <!--Virtual Exhibit-->
                    <span class="hovertext" data-hover="Virtual Exhibit">
                    <a href="virtualExhibit.html"><button class="btn"><i class="fi fi-br-eye"></i></button></a>
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
                  <script>
                      window.addEventListener('scroll', function() {
                  var navbar = document.getElementById('navbar');
                  if (window.pageYOffset > 0) {
                    navbar.classList.add('scrolled');
                  } else {
                    navbar.classList.remove('scrolled');
                  }
                });
                    </script>
                </div>
              </nav>
              <center><p class="title">Resource Library</p>
              <p class="subtext"> Scan through media that artists have to offer!</p>
              </center>
              <center><a href="uploadResource.php">
                
              <button class="cssbuttons-io-button" style="background-color: none;">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path fill="none" d="M0 0h24v24H0z"></path><path fill="currentColor" d="M11 11V5h2v6h6v2h-6v6h-2v-6H5v-2z"></path></svg>
                <span>Upload Resource</span>
              </button>
                </a>
              </center>
              <br>

              <section class="resource-links">
  <div class="resource-container">
  <?php
include_once 'includes/dbh.inc.php';

$sql = "SELECT * FROM resources ORDER BY orderResource DESC;";
$stmt = mysqli_stmt_init($conn);
if (!mysqli_stmt_prepare($stmt, $sql)) {
    echo "SQL statement failed!";
} else {
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    while ($row = mysqli_fetch_assoc($result)) {
        $fileName = $row["resourceFile"]; // Set the file name here
        $filePath = 'uploads/resources/' . $fileName; // Set the file path here

        echo '
        <div class="card">
                <div class="card-header">
                    <h2>' . $row["typeFile"] . '</h2>
                </div>
                <div class="card-body">
                    <h5 class="card-title">
                        <a href="' . $filePath . '" download="' . $fileName . '">
                            <h3>' . $row["resourceTitle"] . '</h3>
                        </a>
                    </h5>
                    <p class="card-text">' . $row["resourceDesc"] . '</p>
                    <h5><a href="visitProfile.php?userid=' . $row["userid"] . '&useruid=' . $row["useruid"] . '">' . $row["useruid"] . '</a></h5>
                    <p class="card-text">Uploaded on: ' . $row["uploadDate"] . '</p>
                   <a href="readResource.php?id=' . $row['idResource'] . '" class="mr-3" title="View Resource" data-toggle="tooltip"><span class="fa fa-eye"></span></a>'
                    ;

        // Check if the logged-in user is the uploader
        if (isset($_SESSION['userid']) && $_SESSION['useruid'] === $row['useruid']) {
            echo '
                  <a href="includes/resourcedelete.inc.php?id=' . $row['idResource'] . '" title="Delete Record" data-toggle="tooltip"><span class="fa fa-trash"></span></a>';
        }

        echo '</div>
            </div>';
    }
}
?>


</div>

</div>


  </div>
</section>


            
  
		
	</body>
</html>
