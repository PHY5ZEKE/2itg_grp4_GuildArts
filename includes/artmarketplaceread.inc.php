<?php
session_start();
include_once 'dbh.inc.php';
$postId = $_GET['id'];

// Check existence of id parameter before processing further
if (isset($_GET["id"]) && !empty(trim($_GET["id"]))) {
    // Include config file
    require_once "dbh.inc.php";

    // Prepare a select statement
    $sql = "SELECT * FROM marketplace WHERE id = ?";

    if ($stmt = mysqli_prepare($conn, $sql)) {
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "i", $param_id);

        // Set parameters
        $param_id = trim($_GET["id"]);

        // Attempt to execute the prepared statement
        if (mysqli_stmt_execute($stmt)) {
            $result = mysqli_stmt_get_result($stmt);

            if (mysqli_num_rows($result) == 1) {
                /* Fetch result row as an associative array. Since the result set
                contains only one row, we don't need to use while loop */
                $row = mysqli_fetch_assoc($result);

                // Retrieve individual field value
                $userid = $row["userid"];
                $useruid = $row["useruid"];
                $titleArt = $row["titleArt"];
                $descArt = $row["descArt"];
                $priceArt = $row["priceArt"];
                $imgFullNameArt = $row["imgFullNameArt"];
                $filePath = 'uploads/marketplace/' . $imgFullNameArt; // Set the file path here
                //session variables
               
               
            } else {
                // URL doesn't contain a valid id parameter. Redirect to error page
                header("location: galleryread.inc.php.");
                exit();
            }
        } else {
            echo "Oops! Something went wrong. Please try again later.";
        }
    }

    // Close statement
    mysqli_stmt_close($stmt);

    
} else {
    // URL doesn't contain id parameter. Redirect to error page
    header("location: error.php");
    exit();
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>View Record</title>  
     <!--Icons-->
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/uicons-regular-rounded/css/uicons-regular-rounded.css'>
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/uicons-solid-straight/css/uicons-solid-straight.css'>
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/uicons-regular-straight/css/uicons-regular-straight.css'>
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/uicons-bold-rounded/css/uicons-bold-rounded.css'>
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/uicons-bold-straight/css/uicons-bold-straight.css'>
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/uicons-bold-rounded/css/uicons-bold-rounded.css'>
        <!--Bootstrap-->
    <!--CSS-->
    <link href="..\css\galleryreadStyle.css" rel="stylesheet">
    <!--Bootstrap-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
         <!--Image Appearance-->
        <style>
        .image-container {
            background-image: url(<?php echo '../uploads/marketplace/'.$row["imgFullNameArt"]; ?>);
            background-size: contain;
        background-repeat: no-repeat; /* Prevent image from repeating */
            background-position: center;
            width: 100%;
            height: 500px; /* Adjust the height as needed */
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-lg-6 separator-line">
                <div class="wrapper">
                <button class="btn">
                <a href="../artmarketplace.php"><i class="fi fi-br-arrow-left" style = "color: #A65A28;font-size: 40px">
                        </i>
                        </a></button>
                    <div class="form-group">
                        
                    <center><p class="title" style="font-size: 35px;color: #e7e7e7;"><b><?php echo $row["titleArt"]; ?></b></p></center>
                    </div>
                    <div class="form-group">
                        <div class="image-container">
                        <a href="<?php echo '../uploads/marketplace/'.$row["imgFullNameArt"]; ?>"  target="_blank"><div class="image-container"></div></a>
                        </div>
                    </div>
                    <div class="form-group">
                        
                    <p class="desc"><b>- <?php echo $row["descArt"]; ?></b></p>
                    </div>
                    <div class="form-group">
                    
                    <p class="user" style="color: #A65A28;"><b><?php echo $row["useruid"]; ?></b></p>
                    </div>
                    <div class="form-group">
                        
                    <p class="sub" style="padding-bottom: 20px;"><b><?php echo $row["created_at"]; ?></b></p>
                    </div>
                    

                    <?php
                      if (isset($_SESSION['userid']) && $_SESSION['useruid'] === $row['useruid']) {
                        echo '
                              <a href="gallerydelete.inc.php?id=' . $row['id'] . '" title="Delete Post" data-toggle="tooltip" class="btn btn-danger">Delete Post</span></a>
                              <a href="galleryupdate.inc.php?id=' . $row['id'] . '" title="Update Post" data-toggle="tooltip" class="btn btn-primary">Edit Post</span></a>';
                    }
                    
                  
                    ?>

                    
            </div>
        </div>
        <div class="col-lg-6">
  <div class="upper-section">
    <div class="creator-name">
      <center><p><b>Price</b></p></center>
    </div>
    <hr>
  </div>
  <div class="bottom-section">
  <div class="form-group">
                    <p class="sale"><b> Price:</p>
                    <p class="sale" style="color: #A65A28;">Php: <?php echo $row["priceArt"]; ?></b></p>
                    </div>
    </div>
    <div class="form-group">
                    <p class="sale"><b> To purchase this art you may send an email to</p>
                    <p class="sale" style="color: #A65A28;"><?php echo $row["email"]; ?></b></p>
                    </div>
                    <p class="sale"><b> or contact me at
                        <?php echo $row["contact"]; ?></b></p>
                    </div>
    </div>
    
</div>
</div>
</div>
</div>
</div>
</body>
</html>