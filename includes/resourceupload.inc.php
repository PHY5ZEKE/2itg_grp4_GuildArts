<?php
session_start();
if(isset($_POST['submit'])) {
    $typeFile = $_POST['resourceType'];
    $resourceTitle = $_POST['resourceTitle'];
    $resourceDesc = $_POST['resourceDescription'];

    $file = $_FILES['file'];
    
    $fileName = $_FILES['file']['name'];
    $fileTmpName = $_FILES['file']['tmp_name'];
    $fileSize = $_FILES['file']['size'];
    $fileError = $_FILES['file']['error'];
    $fileType = $_FILES['file']['type'];
    
    $fileExt = explode('.',$fileName);
    $fileActualExt = strtolower(end($fileExt));

    if($fileError === 0) {
        if($fileSize < 2000000000) {

            $fileDestination = "../uploads/resources/".$fileName;

            include_once "dbh.inc.php";

            if(empty($typeFile)||empty($resourceTitle)||empty($resourceDesc)) {
                header("Location:../main.php?upload=empty");
                exit();
            } else {
                $sql = "SELECT * FROM resources;";
                $stmt = mysqli_stmt_init($conn);
                if(!mysqli_stmt_prepare($stmt,$sql)) {
                    echo "SQL statement failed";
                } else {
                    mysqli_stmt_execute($stmt);
                    $result = mysqli_stmt_get_result($stmt);
                    $rowCount = mysqli_num_rows($result);
                    $orderResource = $rowCount + 1;

                    $sql = "INSERT INTO resources (userid, useruid, typeFile, resourceTitle, resourceDesc, resourceFile, orderResource) VALUES (?,?,?,?,?,?,?);";
                    if(!mysqli_stmt_prepare($stmt,$sql)) {
                        echo "SQL statement failed!";
                    } else {
                        // Retrieve userid and useruid from session
                        $userid = $_SESSION['userid'];
                        $useruid = $_SESSION['useruid'];

                        mysqli_stmt_bind_param($stmt,"sssssss",$userid,$useruid,$typeFile,$resourceTitle,$resourceDesc,$fileName,$orderResource);
                        mysqli_stmt_execute($stmt);

                        move_uploaded_file($fileTmpName,$fileDestination);

                        header("Location:../resource.php?upload=success");
                        exit();
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
?>
