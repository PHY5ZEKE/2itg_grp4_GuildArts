<?php
session_start();
// Include config file
require_once "dbh.inc.php";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if ID is set and not empty
    if (isset($_POST["id"]) && !empty($_POST["id"])) {
        // Get hidden input value
        $id = $_POST["id"];

        // Retrieve userid and useruid from session
        $userid = $_SESSION['userid'];
        $useruid = $_SESSION['useruid'];

        // Validate and sanitize title, description, and price inputs
        $title = trim($_POST["title"]);
        $description = trim($_POST["description"]);
        $price = trim($_POST["price"]);
        $contact = trim($_POST["contact"]);
        $email = trim($_POST["email"]);

        // Prepare an update statement
        $sql = "UPDATE marketplace SET titleArt = ?, descArt = ?, priceArt = ?, contact = ?, email = ? WHERE id = ? AND userid = ? AND useruid = ?";

        if ($stmt = $conn->prepare($sql)) {
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("ssdssiis", $title, $description, $price, $contact,$email,$id, $userid, $useruid);

            // Attempt to execute the prepared statement
            if ($stmt->execute()) {
                // Records updated successfully. Redirect to landing page
                header("location: ../main.php");
                exit();
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }
        }

        // Close statement
        $stmt->close();
    }

    // Close connection
    $conn->close();
} else {
    // Check existence of ID parameter before processing further
    if (isset($_GET["id"]) && !empty(trim($_GET["id"]))) {
        // Get URL parameter
        $id = trim($_GET["id"]);

        // Prepare a select statement
        $sql = "SELECT * FROM marketplace WHERE id = ?";
        if ($stmt = $conn->prepare($sql)) {
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("i", $id);

            // Attempt to execute the prepared statement
            if ($stmt->execute()) {
                $result = $stmt->get_result();

                if ($result->num_rows == 1) {
                    // Fetch result row as an associative array
                    $row = $result->fetch_array(MYSQLI_ASSOC);

                    // Retrieve individual field value
                    $title = $row["titleArt"];
                    $description = $row["descArt"];
                    $price = $row["priceArt"];
                    $contact = $row["contact"];
                    $email = $row["email"];
                } else {
                    // URL doesn't contain a valid ID. Redirect to the error page
                    header("location: error.php");
                    exit();
                }
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }
        }

        // Close statement
        $stmt->close();

        // Close connection
        $conn->close();
    } else {
        // URL doesn't contain an ID parameter. Redirect to the error page
        header("location: error.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Update Post</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="../css/crudeStyle.css" rel="stylesheet" type="text/css">
</head>

<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="mt-5">Update Post</h2>
                    <p>Please edit the input values and submit to update the post.</p>
                    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                        <div class="form-group">
                            <label>Title</label>
                            <input type="text" name="title" class="form-control" value="<?php echo $title; ?>">
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <textarea name="description" class="form-control"><?php echo $description; ?></textarea>
                        </div>
                        <div class="form-group">
                            <label>Price</label>
                            <input type="text" name="price" class="form-control" value="<?php echo $price; ?>">
                        </div>
                        <div class="form-group">
                            <label>Contact</label>
                            <input type="text" name="contact" class="form-control" value="<?php echo $contact; ?>">
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="text" name="email" class="form-control" value="<?php echo $email; ?>">
                        </div>
                        <input type="hidden" name="id" value="<?php echo $id; ?>" />
                        <center>
                            <p>
                                <input type="submit" class="btn btn-primary" value="Submit">
                                <a href="../main.php" class="btn btn-secondary ml-2">Cancel</a>
                            </p>
                        </center>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
