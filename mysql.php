<?php
$server = 'v.je';
$username = 'student';
$password = 'student';
//The name of the schema we created earlier in MySQL workbench
//If this schema does not exist you will POST an error!
$schema = 'rainforest';
$pdo = new PDO('mysql:dbname=' . $schema . ';host=' . $server, $username, $password,
[PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

 ?>
