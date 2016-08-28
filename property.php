<?php
$title = "Property";
require_once("db.php");
include "header.php";
 ?>
<h1>PROPERTY</h1>
<?php
if ($loggedIn) {
  $query  = "SELECT *
              FROM property
              WHERE ownerID = :id
              ";
  $params = array(
      ':id' => $userID
  );
  $stmt   = $db->prepare($query);
  $stmt->execute($params);
  $listings = $stmt->rowCount();
  if ($listings > 0) {
    $properties = $stmt->fetchAll();
    echo "<h2>Your Properties</h2>";
    foreach ($properties as $property) {
      echo "Property #" . $property['propertyID'] . "<br />";
    }
  } else {
?>
  You have no properties to show.

<?php


  }

?>

<?php
} else {
  notLoggedIn();
}

 ?>



 <?php
 include "footer.php";
  ?>
