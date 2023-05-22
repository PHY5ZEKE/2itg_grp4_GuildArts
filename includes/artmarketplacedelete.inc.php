<?php
// Process delete operation after confirmation
session_start();
if (isset($_POST["id"]) && !empty($_POST["id"])) {
    // Include config file
    require_once "dbh.inc.php";

    // Prepare a delete statement
    $sql = "DELETE FROM marketplace WHERE id = ? AND useruid = ?";

    if ($stmt = mysqli_prepare($conn, $sql)) {
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "id", $param_id, $param_useruid);

        // Set parameters
        $param_id = trim($_POST["id"]);
        $param_useruid = $_SESSION['useruid'];

        // Attempt to execute the prepared statement
        if ($stmt->execute()) {
            // Records deleted successfully. Redirect to landing page
            header("location: ../main.php");
            exit();
        } else {
            echo "Oops! Something went wrong. Please try again later.";
        }
    }

    // Close statement
    $stmt->close();

    // Close connection
    $conn->close();
} else {
    // Check existence of id parameter
    if (empty(trim($_GET["id"]))) {
        // URL doesn't contain id parameter. Redirect to error page
        header("location: error.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Delete Post</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="..\css\crudeStyle.css" rel="stylesheet" type="text/css">

</head>

<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="mt-5 mb-3">Delete Post</h2>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
<center>
                            <input type="hidden" name="id" value="<?php echo trim($_GET["id"]); ?>" />
                            <p>Are you sure you want to delete this resource?</p>
                            <p>
                                <input type="submit" value="Yes" class="btn btn-danger">
                                <a href="../main.php" class="btn btn-secondary ml-2">No</a>
                            </p>
</center>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
