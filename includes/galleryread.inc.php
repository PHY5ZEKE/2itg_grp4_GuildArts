<?php
session_start();
include_once 'dbh.inc.php';
$postId = $_GET['id'];

// Check existence of id parameter before processing further
if (isset($_GET["id"]) && !empty(trim($_GET["id"]))) {
    // Include config file
    require_once "dbh.inc.php";

    // Prepare a select statement
    $sql = "SELECT * FROM gallery WHERE id = ?";

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
                $titleGallery = $row["titleGallery"];
                $postid = $row["id"];
                $descGallery = $row["descGallery"];
                $imgFullNameGallery = $row["imgFullNameGallery"];
                $filePath = 'uploads/gallery/' . $imgFullNameGallery; // Set the file path here
                //session variables
               
                $_SESSION["postid"] = $postid;
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
            background-image: url(<?php echo '../uploads/gallery/'.$row["imgFullNameGallery"]; ?>);
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
                
                <a href="../main.php"><button class="btn"><i class="fi fi-br-arrow-left" style = "color: #A65A28;font-size: 40px">
                        </i>
                        </button></a>
                    <div class="form-group">
                        
                    <center><p class="title" style="font-size: 35px;color: #e7e7e7;"><?php echo $row["titleGallery"]; ?></p></center>
                    
                    </div>
                    <div class="form-group">
                    <a href="<?php echo '../uploads/gallery/'.$row["imgFullNameGallery"]; ?>"  target="_blank"><div class="image-container"></div></a>
                    </div>
                    <div class="form-group">
                        
                        <p class="desc"><b>- <?php echo $row["descGallery"]; ?></b></p>
                    </div>
                    <div class="form-group">
                    
                        <p class="user" style="color: #A65A28;"><b><?php echo $row["useruid"]; ?></b></p>
                    <?php
                    
                    
                    ?>
                        <p class="sub"><b><?php echo $row["created_at"]; ?></b></p>
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
      <center><p><b>Comments</b></p></center>
    </div>
    <hr>
  </div>
  <div class="bottom-section">
    <div class="comment-input-container">
        <form id="comment-form" method="POST">
            <textarea id="comment-input" class="comment-input" placeholder="Add a comment..." name="comment"></textarea>
            <center><button type="submit" id="submit-comment" class="buttonPost">
                  <div class="svg-wrapper-1">
                    <div class="svg-wrapper">
                      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                        <path fill="none" d="M0 0h24v24H0z"></path>
                        <path fill="currentColor" d="M1.946 9.315c-.522-.174-.527-.455.01-.634l19.087-6.362c.529-.176.832.12.684.638l-5.454 19.086c-.15.529-.455.547-.679.045L12 14l6-8-8 6-8.054-2.685z"></path>
                      </svg>
                    </div>
                  </div>
                  <span style="color:#D4D4D4;">Post</span>
                </button>
                </center>
        </form>
    </div>
</div>
  <?php
                include_once 'dbh.inc.php';

                $sql = "SELECT * FROM comments WHERE postid = ? ORDER BY orderComment ASC;";
                $stmt = mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($stmt, $sql)) {
                    echo "SQL statement failed!";
                } else {
                    // Bind the post ID as a parameter
                    mysqli_stmt_bind_param($stmt, "i", $postid);
                    mysqli_stmt_execute($stmt);
                    $result = mysqli_stmt_get_result($stmt);
                    echo '<div class="comments-container">';
                    while ($row = mysqli_fetch_assoc($result)) {

                       

                        echo '
                        <div class="middle-section">
                            <div class="comment-box">
                                <div class="card comment">
                                    <div class="card-body comment-content">
                                        ' . $row["comment"] .'
                                    </div>
                                </div>
                                Posted by: '. $row["useruid"].' at '. $row["created_at"];
                    
                    if (isset($_SESSION['userid']) && $_SESSION['useruid'] === $row['useruid']) {
                        echo '<a href="commentdelete.inc.php?id=' . $row['id'] . '" title="Delete Record" data-toggle="tooltip"><span class="fa fa-trash"></span></a>';
                    }
                    
                    echo '
                            </div>
                        </div>';
                    }
                    echo '</div>';
                }


                ?>

                


</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const commentForm = document.getElementById("comment-form");

        // Function to handle form submission
        function submitComment(event) {
            event.preventDefault(); // Prevent the form from being submitted normally

            const commentText = document.getElementById("comment-input").value.trim();
            if (commentText !== "") {
                commentForm.action = "gallerycomments.inc.php"; // Set the action URL
                commentForm.submit(); // Submit the form
            }
        }

        // Submit comment on Enter key press
        commentForm.addEventListener("keydown", function (event) {
            if (event.key === "Enter" && !event.shiftKey) {
                event.preventDefault();
                submitComment(event);
            }
        });

        // Submit comment on form submit (button click)
        commentForm.addEventListener("submit", function (event) {
            event.preventDefault();
            submitComment(event);
        });
    });
</script>
</div>
</div>
</div>
</body>
</html>