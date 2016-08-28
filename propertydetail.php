<?php
require_once("db.php");
include "header.php";
 ?>
<h1>PROPERTY</h1>
<?php
$id = $_GET['p'];
if ($loggedIn) {
  if (isset($id)) {}
  $query  = "SELECT *
              FROM property
              WHERE propertyID = :id
              ";
  $params = array(
      ':id' => $id
  );
  $stmt   = $db->prepare($query);
  $stmt->execute($params);
  $property = $stmt->fetch();
  echo "<h2>" . $property['title']  ."</h2>";

?>


<?php
} else {
  notLoggedIn();
}

 ?>



 <?php
 include "footer.php";
  ?>
