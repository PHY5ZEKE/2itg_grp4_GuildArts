<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['userid'])) {
    header("Location: login.php");
    exit();
}

// Get the current session user ID
$userId = $_SESSION['userid'];

include_once 'dbh.inc.php';


// Retrieve the user's data from the database
$sql = "SELECT * FROM users WHERE usersId = '$userId'";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();

    // Populate the form with the user's existing data
    $currentBio = $row['bio'];
} else {
    echo "User not found.";
    exit();
}

// Check if the form is submitted
if (isset($_POST['submit'])) {
    // Retrieve the form input
    $newBio = $_POST['newBio'];

    // Handle profile picture upload
    $newPfp = $_FILES['newPfp']['name'];
    $pfpTmpName = $_FILES['newPfp']['tmp_name'];
    $pfpSize = $_FILES['newPfp']['size'];
    $pfpError = $_FILES['newPfp']['error'];
    $pfpType = $_FILES['newPfp']['type'];

    // Check if a new profile picture is uploaded
    if ($pfpSize > 0 && $pfpError == 0) {
        // Specify the directory to upload the profile pictures
        $newPfpName = uniqid("", true) . '.' . pathinfo($newPfp, PATHINFO_EXTENSION);
        $uploadDir = "../uploads/pfp/".$newPfpName;

        // Generate a unique filename for the uploaded profile picture
       
        // Move the uploaded profile picture to the upload directory
       
        if (move_uploaded_file($pfpTmpName, $uploadDir)) {
            // Update the user's profile picture path in the database
            $sql = "UPDATE users SET pfp = '$newPfpName' WHERE usersId = '$userId'";
            if ($conn->query($sql) !== TRUE) {
                echo "Error updating profile picture: " . $conn->error;
                exit();
            }
        } else {
            echo "Error uploading profile picture.";
            exit();
        }
    }

    // Update the user's bio in the database
    $sql = "UPDATE users SET bio = '$newBio' WHERE usersId = '$userId'";
    if ($conn->query($sql) === TRUE) {
        echo "User profile updated successfully.";
        // Update the current session user's data
        $currentBio = $newBio;
        header("location: ../profile.php");
    } else {
        echo "Error updating user profile: " . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit User Profile</title>
    <link href="..\css\profUpStyle.css" rel="stylesheet" type="text/css">
    <script>
        function previewImage(event) {
            var reader = new FileReader();
            reader.onload = function(){
                var output = document.getElementById('image-preview');
                output.innerHTML = '<img src="' + reader.result + '">';
            };
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>
</head>
<body>
    <h1>Edit User Profile</h1>
    <form action="" method="post" enctype="multipart/form-data">

        <label for="newBio">New Bio:</label>
        <textarea name="newBio" rows="4" cols="50"><?php echo $currentBio; ?></textarea><br><br>

        <label for="newPfp">New Profile Picture:</label>
        <input type="file" name="newPfp" onchange="previewImage(event)"><br><br>

        <center><div class="image-preview" id="image-preview"></div></center>

        <input type="submit" name="submit" value="Update Profile">
    </form>
</body>
</html>
