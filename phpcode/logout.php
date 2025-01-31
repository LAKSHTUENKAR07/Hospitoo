<?php
session_start();
session_unset();
session_destroy();
$error = htmlentities('See you back soon :)');
header("Location:/hospital/index.html?msg=$error");