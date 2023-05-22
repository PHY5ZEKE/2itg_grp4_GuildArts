<?php
session_start();

if (isset($_POST['heart-submit'])) {
  if (!isset($_SESSION['loggedin'])) {
    header('Location: index.html');
    exit;
  }

  include_once 'dbh.inc.php';

  $galleryId = $_POST['gallery_id'];
  $userId = $_SESSION['userid'];

  // Check if the user has already liked the gallery item
  $sql = "SELECT COUNT(*) FROM hearts WHERE gallery_id = ? AND user_id = ?";
  $stmt = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $sql)) {
    // Handle the SQL error
  } else {
    mysqli_stmt_bind_param($stmt, "ii", $galleryId, $userId);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $count);
    mysqli_stmt_fetch($stmt);
    mysqli_stmt_close($stmt);

    if ($count > 0) {
      // User has already liked the gallery item, remove the heart
      $sql = "DELETE FROM hearts WHERE gallery_id = ? AND user_id = ?";
    } else {
      // User has not liked the gallery item, add the heart
      $sql = "INSERT INTO hearts (gallery_id, user_id, created_at) VALUES (?, ?, NOW())";
    }

    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
      // Handle the SQL error
    } else {
      mysqli_stmt_bind_param($stmt, "ii", $galleryId, $userId);
      mysqli_stmt_execute($stmt);
      mysqli_stmt_close($stmt);
    }
  }

  mysqli_close($conn);
}

header('Location: ../main.php');
exit;
?>
