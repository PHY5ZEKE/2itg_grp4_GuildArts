<?php
session_start();

if (!isset($_SESSION['loggedin'])) {
	header('Location: index.html');
	exit;
}
include_once 'includes/dbh.inc.php';

if (isset($_GET['userid']) && isset($_GET['useruid'])) {
    $selectedUserID = $_GET['userid'];
    $selectedUserUID = $_GET['useruid'];

    // Query the database to retrieve the selected user's information
    $sql = "SELECT * FROM users WHERE usersId = '$selectedUserID' AND usersUid = '$selectedUserUID'";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            // User found, display their information
            $row = mysqli_fetch_assoc($result);
            $name = $row['usersName'];
            $username = $row['usersUid'];
            $email = $row['usersEmail'];
            $bio = $row['bio'];
            $pfp = $row['pfp'];
            // ... Retrieve other relevant user information
        } else {
            // User not found, display an error message or handle the scenario when the user is not found
            echo "<h2>Error</h2>";
            echo "<p>User not found.</p>";
        }
    } else {
        // Handle the scenario when the database query fails
        echo "<h2>Error</h2>";
        echo "<p>Database query failed.</p>";
    }
} else {
    // Handle the scenario when the required parameters are not provided
    echo "<h2>Error</h2>";
    echo "<p>Invalid request.</p>";
}
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
		<link href="css\visitProfile.css" rel="stylesheet" type="text/css">
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
                    <a class="navbar-brand" href="#" style = "color: #D4D4D4;">Profile</a>
                  <a href="main.php"><button class="btn"><i class="fi fi-ss-house-chimney"></i></button></a>
                  <button class="btn"><i class="fi fi-rs-ballot"></i></button>
                  <button class="btn"><i class="fi fi-rr-books"></i></button>
                  <button class="btn"><i class="fi fi-rs-shop"></i></button>
                  <button class="btn"><i class="fi fi-br-eye"></i></button>
                  </button>
                  <a href="profile.php"><button class="btnNow"><i class="fi fi-br-user" href="profile.php"></i></button></a>
                  <a href="includes\logout.inc.php"><button class="btn"><i class="fi fi-bs-sign-out-alt"></i></button></a>
                  </div>
                </div>
              </nav>

        <div class="outer">
        <div class="innerleft">
        <?php
        if ($pfp !== null && !empty($pfp)) {
          echo '<img src="uploads/pfp/' . $pfp . '" alt="Profile Picture">';
      } else {
          echo '<img src="uploads/pfp/default-pfp.jpg" alt="Profile Picture">';
      }
        ?>
    </div>
    <?php
		echo'<div class="innerright">
		<div>
            
            <h2 style="font-size: 30px;">'.$username.'</h2>
            
            <h4>- ' .$bio.'</h4>
            </div>
</div>';
?>
</div>
<?php
include_once 'includes/dbh.inc.php';

// Assuming you have a session started with a 'userid' variable
if (isset($selectedUserID)) {
 

  $sql = "SELECT * FROM gallery WHERE userid = ? ORDER BY orderGallery DESC;";
  $stmt = mysqli_stmt_init($conn);

  if (!mysqli_stmt_prepare($stmt, $sql)) {
    echo "SQL statement failed! HAHAHAHAH";
  } else {
    mysqli_stmt_bind_param($stmt, "s", $selectedUserID);
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