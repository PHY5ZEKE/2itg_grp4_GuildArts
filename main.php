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
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/uicons-solid-rounded/css/uicons-solid-rounded.css'>
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/uicons-bold-rounded/css/uicons-bold-rounded.css'>
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/uicons-bold-straight/css/uicons-bold-straight.css'>
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/uicons-regular-rounded/css/uicons-regular-rounded.css'>
        <!--Bootstrap-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
		<link href="css\mainPageStyle.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer">
	</head>
	<body>
  <div class="glow-effect"></div>
              <script>
                    function handleScroll() {
                    var glowEffect = document.querySelector(".glow-effect");
                    var scrollPosition = window.scrollY;
                    var windowHeight = window.innerHeight;
                    var scrollPercent = (scrollPosition / (document.documentElement.scrollHeight - windowHeight)) * 100;
                    var opacity = scrollPercent / 100;

                    glowEffect.style.setProperty("--glow-opacity", opacity);
                  }
                  window.addEventListener("scroll", handleScroll);

              </script>
    <nav class="navbar navbar-expand-lg">
                <div class="container-fluid">
                    <!--Navbar Logo-->
                  <a class="navbar-logo" href="#">
                    <img src="assets\Logo.png" alt="Logo" width="85" height="85">
                  </a>
                    <!--Navbar Name-->
                  <a class="navbar-brand" href="#" style = "color: #D4D4D4; opacity:.75">GuildArts</a>

                  <!--Home-->
                  <span class="hovertext" data-hover="Home">
                    <a href="main.php"><button class="btn"><i class="fi fi-ss-house-chimney" style = "color: #A65A28;"></i></button></a>
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
            
              <a href="uploadGallery.php" class="button-link">
              <button class="buttonPost">
                  <div class="svg-wrapper-1">
                    <div class="svg-wrapper">
                      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                        <path fill="none" d="M0 0h24v24H0z"></path>
                        <path fill="currentColor" d="M1.946 9.315c-.522-.174-.527-.455.01-.634l19.087-6.362c.529-.176.832.12.684.638l-5.454 19.086c-.15.529-.455.547-.679.045L12 14l6-8-8 6-8.054-2.685z"></path>
                      </svg>
                    </div>
                  </div>
                  <span style="color:#D4D4D4;">Create Post</span>
                </button>
              </a>
              <center><p class="title">GuildArts Gallery</p>
              <p class="subtext">Works of art for all to see!</p></center>
              <div class="bleeding-light">
                
              </div>          
              

              
		<div class="content">
      
    <script>
                function handleScroll() {
  var button = document.querySelector(".buttonPost");
  var scrolled = window.pageYOffset;
  if (scrolled > 200) { // Adjust the scroll position at which the button should shift
    button.classList.add("shifted");
  } else {
    button.classList.remove("shifted");
  }
}

window.addEventListener("scroll", handleScroll);

// Initial execution
handleScroll();


            </script>      
  <?php
include_once 'includes/dbh.inc.php';

// Function to check if a user has liked a gallery item
function hasLikedGalleryItem($conn, $galleryId, $userId) {
  $sql = "SELECT COUNT(*) FROM hearts WHERE gallery_id = ? AND user_id = ?";
  $stmt = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $sql)) {
    return false;
  } else {
    mysqli_stmt_bind_param($stmt, "ii", $galleryId, $userId);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $count);
    mysqli_stmt_fetch($stmt);
    mysqli_stmt_close($stmt);
    return $count > 0;
  }
}

// Function to get the total number of hearts for a gallery item
function getGalleryItemHeartsCount($conn, $galleryId) {
  $sql = "SELECT COUNT(*) FROM hearts WHERE gallery_id = ?";
  $stmt = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $sql)) {
    return 0;
  } else {
    mysqli_stmt_bind_param($stmt, "i", $galleryId);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $count);
    mysqli_stmt_fetch($stmt);
    mysqli_stmt_close($stmt);
    return $count;
  }
}

$sql = "SELECT * FROM gallery ORDER BY orderGallery DESC;";
$stmt = mysqli_stmt_init($conn);
if (!mysqli_stmt_prepare($stmt, $sql)) {
  echo "SQL statement failed!";
} else {
  mysqli_stmt_execute($stmt);
  $result = mysqli_stmt_get_result($stmt);

  while ($row = mysqli_fetch_assoc($result)) {
    $galleryId = $row['id'];
    $userId = $_SESSION['userid'];

    echo '
    <div class="gallery-container-color">
      <div class="gallery-container">
        <a href ="includes/galleryread.inc.php?id=' . $galleryId . '">
          <div style="background-image: url(uploads/gallery/' . $row["imgFullNameGallery"] . ');background-size: cover;border-radius: 25px;border: 4px solid #D4D4D4;"></div>
          <h3>' . $row["titleGallery"] . '</h3>
          <p class="subheading">' . $row["descGallery"] . '</p>
        </a>
        
        <p class="subtext" style="padding-left: 0px;font-size: 20px;margin-top: 30px;">By: ';
    
    if (isset($_SESSION['userid']) && $_SESSION['userid'] == $row['userid']) {
      echo '<a href="profile.php">' . $row['useruid'] . '</a>';
    } else {
      echo '<a href="visitProfile.php?userid=' . $row['userid'] . '&useruid=' . $row['useruid'] . '">' . $row['useruid'] . '</a>';
    }
    
    echo '</p>
    
    <p style="font-size: 15px;margin-top: 20px;opacity:.5;"> ' . $row["created_at"] . '</p>';

    // Check if the user has liked the gallery item
    $hasLiked = isset($_SESSION['userid']) && hasLikedGalleryItem($conn, $galleryId, $userId);
    // Get the total number of hearts for the gallery item
    $heartsCount = getGalleryItemHeartsCount($conn, $galleryId);

    echo '<center> <article class="icon-straighter" style = "width: 100%; height 100%; align-items: center; justify-content: center;display: flex; flex-direction: row;">
    <form action="includes/heart.inc.php" method="post" style="width: 100px; height: 80px;">
      <div class="heart-container" style = "width: 100px; height: 20px; align-items: center; justify-content: center;">
        <button type="submit" name="heart-submit" class="btn heart-button ' . ($hasLiked ? 'liked' : '') . '">
          <i class="fa fa-heart"></i>
        </button>
        <span> ' . $heartsCount . '</span>
      </div>
      <input type="hidden" name="gallery_id" value="' . $galleryId . '">
    </form>';


    if (isset($_SESSION['userid']) && $_SESSION['useruid'] === $row['useruid']) {
      echo '
        <a href="includes/gallerydelete.inc.php?id=' . $row['id'] . '">
        <button class="btn"><i class="fi fi-sr-trash"style = "color: #d22828;"></button></i>
        </a>
        
        <a href="includes/galleryupdate.inc.php?id=' . $row['id'] . '">
        <button class="btn">
        <i class="fi fi-sr-pencil" style ="color: #22bbf2;"></i>
        </button>
        </a>
      </div></div></article></center>';
    } else {
      echo '</div></div></article></center>';
    }
  }
}

  

mysqli_stmt_close($stmt);
mysqli_close($conn);
?>
            

</div>
  
	</body>
</html>
