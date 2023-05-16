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
    <!--Icons-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/uicons-regular-rounded/css/uicons-regular-rounded.css'>
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/uicons-solid-straight/css/uicons-solid-straight.css'>
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/uicons-regular-straight/css/uicons-regular-straight.css'>
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/uicons-bold-rounded/css/uicons-bold-rounded.css'>
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/uicons-bold-straight/css/uicons-bold-straight.css'>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .wrapper {
            width: 600px;
            margin: 0 auto;
        }
    </style>
    <style>
    .image-container {
        background-image: url(<?php echo '../uploads/gallery/'.$row["imgFullNameGallery"]; ?>);
        background-size: cover;
        background-position: center;
        width: 100%;
        height: 300px; /* Adjust the height as needed */
    }
</style>
</head>

<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="mt-5 mb-3">View Post</h1>
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
    </div>
</div>
</body>

</html>