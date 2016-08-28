<?php
$title = "Auctions";
require_once("db.php");
include "header.php";
 ?>

<?php
if ($loggedIn) {
 ?>

<h1>Property Auctions</h1>

<?php
  //look up upcominmg auctions that they're RUNNING
  $query  = "SELECT *
              FROM auctions
              WHERE ownerID = :id
              ";
  $params = array(
      ':id' => $userID
  );
  $stmt   = $db->prepare($query);
  $stmt->execute($params);
  $running = $stmt->rowCount();
  if ($running > 0) {
    $auctions = $stmt->fetchAll();
    echo "<h2>Your Upcoming Property Auctions</h2>";
    echo "<ul>";
    foreach ($auctions as $auction) {
      echo "<li><span>Auction #" . $auction['auctionID'] . "</span><span>" .  $auction['endDate']  . "</span><span><a href='/auction/". $auction['auctionID'] . "'>View</a></span></li>";
    }
    echo "</ul>";
  }
  //look up upcoming auctions that they're PARTICIPATING in
  $query  = "SELECT auctions.auctionID, auctions.endDate, property.title, property.propertyID
              FROM auctions
              INNER JOIN members ON auctions.auctionID = members.auctionID
              INNER JOIN property ON members.propertyID = property.propertyID
              WHERE property.ownerID = :id
              ";
  $params = array(
      ':id' => $userID
  );
  $stmt   = $db->prepare($query);
  $stmt->execute($params);
  $participating = $stmt->rowCount();

  if ($participating  > 0) {
    echo "<h2>Property You're Selling</h2>";
    echo "<ul>";
    $auctions = $stmt->fetchAll();
    foreach ($auctions as $auction) {

      echo "<li><span>Property #" . $auction['propertyID'] . " - " . $auction['property.title'] . "</span><span>" .  $auction['endDate']  . "</span><span><a href='/auction/". $auction['auctionID'] . "'>View</a></span></li>";
    }
    echo "</ul>";
  }

  if ($running == 0 && $participating == 0) {
    echo "You have no upcoming property auctions";
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
