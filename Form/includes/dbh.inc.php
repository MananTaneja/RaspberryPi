<?php

$servername = "localhost";
$username = "order_product";
$password = "password";
$dbName = "transactions";

$conn = mysqli_connect($servername, $username, $password, $dbName);

if(!$conn) {
    die("Connection Failed: ".mysqli_connect_error());
}

