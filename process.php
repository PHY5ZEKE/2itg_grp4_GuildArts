<?php
require_once('config.php');
?>

<?php
                if(isset($_POST))
                {
                    $firstname = $_POST['firstname'];
                    $lastname = $_POST['lastname'];
                    $email = $_POST['email'];
                    $contactnumber = $_POST['contactnumber'];
                    $password = sha1($_POST['password']);

                    $sql = "INSERT INTO users (firstname, lastname, email, contactnumber, password ) VALUES(?,?,?,?,?)";
                    $stmtinsert = $mysqli->prepare($sql);
                    $result = $stmtinsert->execute([$firstname,$lastname,$email,$contactnumber,$password]);
                    if($result){
                        echo 'You have successfully registered.';
                    }else{
                        echo 'There were erros while saving the data.';
                    }
            }else
            {
                echo 'No data';
            }
                

            ?>