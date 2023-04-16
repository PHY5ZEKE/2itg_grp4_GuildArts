<?php
if(isset($_POST["submit"]))
{
   $name =($_POST["name"]);
   $email =($_POST["email"]);
   $username =($_POST["uid"]);
   $pwd =($_POST["pwd"]);
   $confirmPwd =($_POST["confirmPwd"]);

   require_once 'dbh.inc.php';
   require_once 'functions.inc.php';

   if(emptyInputSignUp($name, $email,$username,$pwd,$confirmPwd)!== false)
   {
    header("location:../registration.php?error=emptyinput");
    exit();
   }
   if(invalidUid($username)!== false)
   {
    header("location:../registration.php?error=invaliduid");
    exit();
   }
   if(invalidEmail($email)!== false)
   {
    header("location:../registration.php?error=invalidemail");
    exit();
   }
   if(pwdMatch($pwd,$confirmPwd)!== false)
   {
    header("location:../registration.php?error=passwordsdontmatch");
    exit();
   }
   if(uidExists($conn,$username,$email)!== false)
   {
    header("location:../registration.php?error=usernametaken");
    exit();
   }

   createUser($conn,$name,$email,$username,$pwd);

}
else
{
    header("location:../registration.php");
    exit();
}
?>