<?php
function emptyInputSignUp($name, $email,$username,$pwd,$confirmPwd)
{
    $result;
    if(empty($name)||empty($email)||empty($username)||empty($pwd)||empty($confirmPwd))
    {
        $result = true;
    }
    else
    {
        $result = false;
    }
    return $result;
}
function invalidUid($username)
{
    $result;
    if (!preg_match("/^[a-zA-Z0-9]*$/", $username))
    {
        $result = true;
    }
    else
    {
        $result = false;
    }
    return $result;
}
function invalidEmail($email)
{
    $result;
    if(!filter_var($email,FILTER_VALIDATE_EMAIL))
    {
        $result = true;
    }
    else
    {
        $result = false;
    }
    return $result;
}
function pwdMatch($pwd,$confirmPwd)
{
    $result;
    if($pwd !== $confirmPwd)
    {
        $result = true;
    }
    else
    {
        $result = false;
    }
    return $result;
}
function uidExists($conn,$username,$email)
{
   $sql= "SELECT * FROM users WHERE usersUid = ? OR usersEmail = ?;";
   $stmt = mysqli_stmt_init($conn);
   if(!mysqli_stmt_prepare($stmt,$sql))
   {
    header("location:../registration.php?error=stmtfailed");
   }

   mysqli_stmt_bind_param($stmt,"ss",$username,$email);
   mysqli_stmt_execute($stmt);

   $resultData = mysqli_stmt_get_result($stmt);

   if($row = mysqli_fetch_assoc($resultData))
   {
        return $row;
   }
   else
   {
    $result = false;
    return $result;
   }

   mysqli_stmt_close();
}
function createUser($conn,$name,$email,$username,$pwd)
{
    $sql = "INSERT INTO users (usersName, usersEmail, usersUid, usersPwd, pfp, bio) VALUES (?, ?, ?, ?, ?, ?) ;";
    $stmt = mysqli_stmt_init($conn);
    
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../registration.php?error=stmtfailed");
    }
    
    $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);
    
    $bio =" ";
    $defaultpfp = 'default-pfp.jpg';
    
    mysqli_stmt_bind_param($stmt, "ssssss", $name, $email, $username, $hashedPwd, $defaultpfp,$bio);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    
    header("location: ../index.html?error=none");

}

function emptyInputLogin($username,$pwd)
{
    $result;
    if(empty($username)||empty($pwd))
    {
        $result = true;
    }
    else
    {
        $result = false;
    }
    return $result;
}

function loginUser($conn,$username,$pwd)
{
    $uidExists = uidExists($conn,$username,$username);

    if($uidExists === false)
    {
        header("location:../login.php?error=wronglogin");
    exit();
    }

    $pwdHashed = $uidExists["usersPwd"];
    $checkPwd = password_verify($pwd,$pwdHashed);
    
    if($checkPwd === false)
    {
        header("location:../login.php?error=wronglogin");
        exit();
    }
    else if($checkPwd === true)
    {
        session_start();
        $_SESSION["userid"]= $uidExists["usersId"];
        $_SESSION["useruid"]= $uidExists["usersUid"];
        session_regenerate_id();
		$_SESSION['loggedin'] = TRUE;
		$_SESSION['username'] = $uidExists["usersUid"];
        $_SESSION['name'] = $uidExists["usersName"];
        $_SESSION['email'] = $uidExists["usersEmail"];
		$_SESSION['id'] = $uidExists["usersId"];
        header("location: ../main.php");
    }
}




?>