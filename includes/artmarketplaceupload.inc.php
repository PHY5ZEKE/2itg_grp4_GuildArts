<?php
session_start();
if (isset($_POST['submit'])) {
    $titleArt = $_POST['titleArt'];
    $descArt = $_POST['descArt'];
    $priceArt = $_POST['priceArt'];
    $contact = $_POST['contactNum'];
    $email = $_POST['email'];
    

    if ($priceArt <= 0) {
        header("Location: ../uploadArtMarketplace.php?error=invalid_price");
        exit();
    }

    $fileName = $_FILES['file']['name'];
    $fileType = $_FILES['file']['type'];
    $fileTempName = $_FILES['file']['tmp_name'];
    $fileError = $_FILES['file']['error'];
    $fileSize = $_FILES['file']['size'];

    $fileExt = explode('.', $fileName);
    $fileActualExt = strtolower(end($fileExt));

    $allowed = array("jpg", "jpeg", "png");

    if (in_array($fileActualExt, $allowed)) {
        if ($fileError === 0) {
            if ($fileSize < 2000000000) {
                $imageFullNameArt = uniqid("", true) . '.' . pathinfo($fileName, PATHINFO_EXTENSION);
                $fileDestination = "../uploads/marketplace/" . $imageFullNameArt;

                include_once "dbh.inc.php";

                if (empty($titleArt) || empty($descArt)) {
                    header("Location: ../main.php?upload=empty");
                    exit();
                } else {
                    // Retrieve userid and useruid from session
                    $userid = $_SESSION['userid'];
                    $useruid = $_SESSION['useruid'];

                    $sql = "SELECT MAX(orderArt) AS maxOrder FROM marketplace;";
                    $stmt = mysqli_stmt_init($conn);
                    if (!mysqli_stmt_prepare($stmt, $sql)) {
                        echo "SQL statement failed";
                    } else {
                        mysqli_stmt_execute($stmt);
                        $result = mysqli_stmt_get_result($stmt);
                        $row = mysqli_fetch_assoc($result);
                        $maxOrder = $row['maxOrder'];
                        $setImageOrder = $maxOrder + 1;

                        $sql = "INSERT INTO marketplace (userid, useruid, titleArt, descArt, imgFullNameArt, priceArt,email,contact,orderArt) VALUES (?, ?, ?, ?, ?, ?, ?,?,?);";
                        $stmt = mysqli_stmt_init($conn);
                        if (!mysqli_stmt_prepare($stmt, $sql)) {
                            echo "SQL statement failed";
                        } else {
                            mysqli_stmt_bind_param($stmt, "sssssdssi", $userid, $useruid, $titleArt, $descArt, $imageFullNameArt, $priceArt, $email, $contact, $setImageOrder);

                            mysqli_stmt_execute($stmt);

                            move_uploaded_file($fileTempName, $fileDestination);

                            header("Location: ../artmarketplace.php?upload=success");
                        }
                    }
                }
            } else {
                echo "File is too large";
                exit();
            }
        } else {
            echo "There was an error uploading your file";
            exit();
        }
    } else {
        echo "You cannot upload files of this type";
        exit();
    }
}
?>
