<?php
// We need to use sessions, so you should always start sessions using the below code.
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
	header('Location: index.html');
	exit;
}
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'guildarts';
$conn = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if (mysqli_connect_errno()) {
	exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}
// We don't have the password or email info stored in sessions, so instead, we can get the results from the database.
$stmt = $conn->prepare('SELECT usersId,usersPwd, usersEmail, pfp, bio FROM users WHERE usersId = ?');
// In this case we can use the account ID to get the account info.
$stmt->bind_param('i', $_SESSION['usersId']);
$stmt->execute();
$stmt->bind_result($usersId,$usersPwd, $usersEmail, $pfp, $bio,);
$stmt->fetch();
$stmt->close();
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Profile Page</title>
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
		<link href="css\profStyle.css" rel="stylesheet" type="text/css">
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
                    <a href="resource.php"><button class="btn"><i class="fi fi-rr-books"></i></button></a>
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
                    <i class="fi fi-br-user" href="profile.php" style = "color: #A65A28;"></i></button></a>
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

<div class="outer">
<div class="innerleft">

<?php
    // Retrieve the profile picture and bio based on the session userid
    $stmt = $conn->prepare('SELECT pfp, bio FROM users WHERE usersId = ?');
    $stmt->bind_param('i', $_SESSION['userid']);
    $stmt->execute();
    $stmt->bind_result($pfp, $bio);
    $stmt->fetch();
    $stmt->close();

    // Check if the profile picture exists
    if ($pfp !== null && !empty($pfp)) {
      echo '<img src="uploads/pfp/' . $pfp . '" alt="Profile Picture">';
  } else {
      echo '<img src="uploads/pfp/default-pfp.jpg" alt="Profile Picture">';
  }
    ?>
</div>
	<div class="innerright">
		<div>
            <!-- <h3><?=$_SESSION['userid']?><h3> -->
            <h2 style="font-size: 50px;"><?=$_SESSION['useruid']?><h2>
            <!-- <h3><?=$_SESSION['email']?><h3>  -->
            <h4>- <?=$bio?></h4>
            <?php echo '<a href="includes\profileupdate.inc.php?usersId=' . $_SESSION['userid'] . '" title="Update Post" data-toggle="tooltip"><button class="buttonEdit">Edit Profile</button></span></a>';
                ?>
        </div>
    </div>
</div> 

<?php
include_once 'includes/dbh.inc.php';

// Assuming you have a session started with a 'userid' variable
if (isset($_SESSION['userid'])) {
  $sessionUserId = $_SESSION['userid'];

  $sql = "SELECT * FROM gallery WHERE userid = ? ORDER BY orderGallery DESC;";
  $stmt = mysqli_stmt_init($conn);

  if (!mysqli_stmt_prepare($stmt, $sql)) {
    echo "SQL statement failed! HAHAHAHAH";
  } else {
    mysqli_stmt_bind_param($stmt, "s", $sessionUserId);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    echo '<div class="gallery-container">'; // Start the container

    $counter = 0; // Counter to keep track of the number of images displayed

    while ($row = mysqli_fetch_assoc($result)) {
      // Add the image container for each image
      
      echo '<div class="image-item">';
    echo '<a href="includes/galleryreadP.inc.php?id=' . $row['id'] . '">';
    echo '<div class="image-wrapper" style="background-image: url(uploads/gallery/'.$row["imgFullNameGallery"].');"></div>';
    echo '</a>';
    echo '</div>';

      $counter++;

      // Check if the row has reached 3 images
      if ($counter % 3 === 0) {
        echo '<div class="clearfix"></div>'; // Add a clearfix to start a new row
      }
    }

    echo '</div>'; // End the container
  }
}
?>



  


	</body>
</html>

