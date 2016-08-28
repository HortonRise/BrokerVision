<?php
$title = "Login";
require_once("db.php");
unset($_SESSION['userID']);
unset($_SESSION['first_name']);
unset($_SESSION['last_name']);

$loggedIn = false;
include "header.php";
 ?>

     You are logged out!


<?php
  include "footer.php";
 ?>
