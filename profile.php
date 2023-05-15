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
$stmt = $conn->prepare('SELECT usersPwd, usersEmail FROM users WHERE usersId = ?');
// In this case we can use the account ID to get the account info.
$stmt->bind_param('i', $_SESSION['usersId']);
$stmt->execute();
$stmt->bind_result($usersPwd, $usersEmail);
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
        <img src="uploads\default.jpg">
    </div>
		<div class="innerright">
			<div>
            <h3>username: &nbsp<?=$_SESSION['userid']?><h3>
            <h3>Name: &nbsp<?=$_SESSION['useruid']?><h3>
            <h3>Email: &nbsp<?=$_SESSION['email']?><h3> 
            <h3>0927-509-2022<h3>
            <h3>"this is a filler bio"<h3>
            <a href="profileUpdate.html" class="btn btn-success pull-right"><i class="fa fa-plus"></i> Edit Profile</a>
            </div>
</div>
</div>
  

  


	</body>
</html>

