<?php 

$server = 'localhost';
$username = 'root';
$password = '123456789';
$dbname = 'my_api';

$connection = new mysqli($server, $username, $password, $dbname);



global $connection;
