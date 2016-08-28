<?php
$title = "Login";
require_once("db.php");
include "header.php";
 ?>

  <?php
   if ($loggedIn) {
 ?>
     You are logged in!

 <?php
   } else {
 ?>

<?php if ($wrong) {
    echo "Sorry - that name / pass combo is incorrect";
}
?>

<form action="login.php" method="post">
  Email: <input type='text' name='email' id='email' /> <br />
  Password: <input type='password' name='password' id='password' /> <br />
  <input type="submit" value='Log-In' />
</form>

 <?php
   }
 ?>


<?php
  include "footer.php";
 ?>
