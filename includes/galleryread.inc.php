<?php
session_start();
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
                $descGallery = $row["descGallery"];
                $imgFullNameGallery = $row["imgFullNameGallery"];
                $filePath = 'uploads/gallery/' . $imgFullNameGallery; // Set the file path here
            } else {
                // URL doesn't contain a valid id parameter. Redirect to error page
                header("location: error.php");
                exit();
            }
        } else {
            echo "Oops! Something went wrong. Please try again later.";
        }
    }

    // Close statement
    mysqli_stmt_close($stmt);

    // Close connection
    mysqli_close($conn);
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
                    <h1 class="mt-5 mb-3"></h1>
                    <div class="form-group">
                        <label>Title</label>
                        <p><b><?php echo $row["titleGallery"]; ?></b></p>
                    </div>
                    <div class="form-group">
                        <div class="image-container"></div>
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <p><b><?php echo $row["descGallery"]; ?></b></p>
                    </div>
                    <div class="form-group">
                    <label>Posted by:</label>
                    <p><b><?php echo $row["useruid"]; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>Uploaded on:</label>
                        <p><b><?php echo $row["created_at"]; ?></b></p>
                    </div>

                    <p><a href="../main.php" class="btn btn-primary">Back</a></p>
            </div>
        </div>
        <div class="col-lg-6">
  <div class="upper-section">
    <div class="creator-name">
      <p><b>Comments</b></p>
    </div>
    <hr>
  </div>

  <div class="middle-section">
    <div class="comment-box">
      <div class="card comment">
        <div class="card-body comment-content">
          This is the first comment.
        </div>
      </div>
      <div class="card comment">
        <div class="card-body comment-content">
          This is another comment.
        </div>
      </div>
      <div class="card comment">
        <div class="card-body comment-content">
          This is another comment.
        </div>
      </div>
      <!-- Add more comments here -->
    </div>
  </div>

  <div class="bottom-section">
    <div class="comment-input-container">
      <textarea id="comment-input" class="comment-input" placeholder="Add a comment..."></textarea>
      <button id="submit-comment" class="comment-submit">Submit</button>
    </div>
  </div>
</div>

            <script>
                document.addEventListener("DOMContentLoaded", function () {
                    const commentInput = document.getElementById("comment-input");
                    const submitButton = document.getElementById("submit-comment");

                    // Function to handle comment submission
                    function submitComment() {
                        const commentText = commentInput.value.trim();
                        if (commentText !== "") {
                            createComment(commentText);
                            commentInput.value = "";
                        }
                    }

                    // Function to create a new comment element
                    function createComment(commentText) {
                        const commentElement = document.createElement("div");
                        commentElement.classList.add("comment");
                        const commentContent = document.createElement("div");
                        commentContent.classList.add("comment-content");
                        commentContent.textContent = commentText;
                        commentElement.appendChild(commentContent);
                        document.querySelector(".comment-box").insertBefore(commentElement, commentInputContainer);
                    }

                    // Submit comment on Enter key press
                    commentInput.addEventListener("keydown", function (event) {
                        if (event.key === "Enter" && !event.shiftKey) {
                            event.preventDefault();
                            submitComment();
                        }
                    });

                    // Submit comment on button click
                    submitButton.addEventListener("click", function (event) {
                        event.preventDefault();
                        submitComment();
                    });
                });
            </script>
        </div>
    </div>
</div>
</body>
</html>