<?php
    require 'mysql.php';

    if(!isset($_SESSION))
    {
        session_start();
    }

    $stmt = $pdo->prepare('SELECT * FROM user WHERE email = :email');

    $criteria = [
      'email' => $_SESSION['login_user']
    ];

    $stmt -> execute($criteria);

    foreach ($stmt as $row) {
    $row['email'];
    $row['password'];
    }

    $hello = 'Hello, ';
    $login_session =   $row['email'];
    $user_firstname = $row['firstname'];
    $user_passwords = $row['password'];

    if(!isset($login_session))
        {
            $pdo = null;
            header('Location: index.php');
        }
?>
