<?php

$con = mysqli_connect('localhost', 'root', '', 'international_bank_system');

if (!$con) {
    die('Connection Error: ' . mysqli_error($con));
}

session_start();

?>