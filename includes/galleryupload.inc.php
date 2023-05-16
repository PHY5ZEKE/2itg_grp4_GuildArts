<?php
session_start();
if(isset($_POST['submit']))
{
    $newFileName = $_POST['filename'];
    if(empty($_POST['filename']))
    {
        $newFileName = "gallery";
    } 
    else
    {
        $newFileName = strtolower(str_replace(" ","-",$newFileName));
    }
    $imageTitle = $_POST['filetitle'];
    $imageDesc = $_POST['filedesc'];

    $file = $_FILES["file"];

    $fileName = $file['name'];
    $fileType = $file['type'];
    $fileTempName = $file['tmp_name'];
    $fileError = $file['error'];
    $fileSize = $file['size'];
    
    $fileExt = explode('.',$fileName);
    $fileActualExt = strtolower(end($fileExt));

    $allowed = array("jpg","jpeg","png");

    if(in_array($fileActualExt,$allowed))
    {
        if($fileError === 0)
        {
            if($fileSize < 2000000000)
            {
                $imageFullName = $newFileName . "." . uniqid("",true). "." .$fileActualExt;
                $fileDestination = "../uploads/gallery/".$imageFullName;

                include_once "dbh.inc.php";

                if(empty($imageTitle)||empty($imageDesc))
                {
                    header("Location:../main.php?upload=empty");
                    exit();
                }
                else
                {
                    // Retrieve userid and useruid from session
                    $userid = $_SESSION['userid'];
                    $useruid = $_SESSION['useruid'];

                    $sql = "SELECT MAX(orderGallery) AS maxOrder FROM gallery;";
                    $stmt = mysqli_stmt_init($conn);
                    if(!mysqli_stmt_prepare($stmt,$sql))
                    {
                        echo "SQL statement failed";
                    }
                    else
                    {
                        mysqli_stmt_execute($stmt);
                        $result = mysqli_stmt_get_result($stmt);
                        $row = mysqli_fetch_assoc($result);
                        $maxOrder = $row['maxOrder'];
                        $setImageOrder = $maxOrder + 1;

                        $sql = "INSERT INTO gallery (userid, useruid, titleGallery, descGallery, imgFullNameGallery, orderGallery) VALUES (?, ?, ?, ?, ?, ?);";
                        $stmt = mysqli_stmt_init($conn);
                        if(!mysqli_stmt_prepare($stmt,$sql))
                        {
                            echo "SQL statement failed";
                        }
                        else
                        {
                            mysqli_stmt_bind_param($stmt,"ssssss",$userid,$useruid,$imageTitle,$imageDesc,$imageFullName,$setImageOrder);
                            mysqli_stmt_execute($stmt);

                            move_uploaded_file($fileTempName,$fileDestination);

                            header("Location:../main.php?upload=success");
                        }
                    }
                }
            }
            else
            {
                echo "File is too large";
                exit();
            }
        }
        else
        {
            echo "There was an error uploading your file";
            exit();
        }
    }
    else
    {
        echo "You cannot upload files of this type";
        exit();
    }
}
