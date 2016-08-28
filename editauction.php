<?php
$title = "Auctions";
require_once("db.php");
include "header.php";
?>

<?php
$id = $_GET['a'];
if ($loggedIn) {
    if ( isset($getID) ) {
      $verb = "Edit";
      //means we are starting to edit or just finished editing
      $query  = "SELECT *
              FROM auctions
              WHERE auctionID = :id
              ";
      $params = array(
          ':id' => $id
      );
      $stmt   = $db->prepare($query);
      $stmt->execute($params);
      $auction = $stmt->fetch();
    } else {
      $verb = "New";
    }
  }
?>

<h1> <?php echo $verb; ?> Auction </h1>

<div id='editDiv'>
  <form id='editForm'>
    <input />

  </form>

</div>


 <?php
include "footer.php";
?>
