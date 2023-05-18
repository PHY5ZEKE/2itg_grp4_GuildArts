<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['comment'])) {
    $comment = $_POST['comment'];

    include_once "dbh.inc.php";

    if (empty($comment)) {
        header("Location: galleryread.inc.php?upload=empty");
        exit();
    } else {
        // Retrieve userid and useruid from session
        $userid = $_SESSION['userid'];
        $useruid = $_SESSION['useruid'];
        $postid = $_SESSION['postid'];

        // Get the maximum orderComment value from the comments table
        $sql = "SELECT MAX(orderComment) AS maxOrder FROM comments";
        $result = mysqli_query($conn, $sql);

        if ($result) {
            $row = mysqli_fetch_assoc($result);
            $maxOrder = $row['maxOrder'];
            $orderComment = $maxOrder + 1;

            // Insert the comment into the comments table
            $sql = "INSERT INTO comments (userid, useruid, postid, comment, orderComment) VALUES (?, ?, ?, ?, ?)";
            $stmt = mysqli_stmt_init($conn);

            if (!mysqli_stmt_prepare($stmt, $sql)) 
            {
             echo "SQL statement failed!";
} else {
    mysqli_stmt_bind_param($stmt, "isiss", $userid, $useruid, $postid, $comment, $orderComment);
    mysqli_stmt_execute($stmt);

    // Check if the comment was successfully inserted
    if (mysqli_stmt_affected_rows($stmt) === 1) {
        // Set the session variable for post ID
        
        header("Location: galleryread.inc.php?id=" . $postid);
       
        exit();
    } else {
        $response = array('success' => false, 'error' => "Failed to insert the comment into the database.");
        echo json_encode($response);
        exit();
    }
            }
        } else {
            $response = array('success' => false, 'error' => "Error: " . mysqli_error($conn));
            echo json_encode($response);
            exit();
        }
    }
} else {
    header("Location: galleryread.inc.php?id=" . $postid);
}
?>
