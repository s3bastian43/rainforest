<?php
    session_start();
    if (isset($_POST['email'], $_POST['password']))
        {
            try
                {


                    require 'mysql.php';

                    $stmt = $pdo->prepare('SELECT * FROM user WHERE email = :email');

                    $criteria = [
                      'email' => $_POST['email'],
                    ];

                    $stmt->execute($criteria);
                    $user = $stmt->fetch();

                    $num=$stmt->rowCount();
                    if($num > 0)
                        {
                          if (password_verify($_POST['password'], $user['password'])) {

                            }
                            $_SESSION['loggedin'] = True;
                            $_SESSION['login_user'] = $_POST['email'];
                          if($_POST['email'] == 'ciobanu.sebastian96@yahoo.com'){
                          $_SESSION['administrator'] = True;
                            }
                            header("location:profile.php");

                        }
                    else
                        {
                          echo  '<script type="text/javascript">
                         window.alert("Sorry, it seems that the email address or the password does not match ");
                         window.location.href="signin.php";
                         </script>';
                        }

                }
            catch (Exception $e)
                {
                    echo 'Caught exception: ',  $e->getMessage(), "\n";
                }
        }

?>
