<?php

$username="root";
$password="root";
$database="brokervision";
date_default_timezone_set('America/Chicago');
$db = new PDO('mysql:host=localhost;dbname=' . $database .';charset=utf8', $username, $password);
session_start();
//check if they're trying to log in
if ($_POST['email']) {
  $wrong = false;
  $passHash = md5($_POST['password']);
  $query  = "SELECT userID, email, password, first_name, last_name, type
              FROM users
              WHERE email = :email
              ";
  $params = array(
      ':email' => $_POST['email']
  );
  $stmt   = $db->prepare($query);
  $stmt->execute($params);
  $row = $stmt->fetch();
  if ($row['password'] == $passHash) {
    //You did it!
    $loggedIn = true;
    $userID = $row['userID'];
    $_SESSION['userID'] = $userID;
    $_SESSION['first_name'] = $row['first_name'];
    $_SESSION['last_name'] = $row['last_name'];
    $_SESSION['type'] = $row['type'];
  } else {
    $loggedIn = false;
    $wrong = true;
  }
}

if (isset( $_SESSION['userID'] ) ) {
  $loggedIn = true;
  $userID = $_SESSION['userID'];
}


function notLoggedIn() {
  echo "You need to be logged in to view this page.";
}

?>
