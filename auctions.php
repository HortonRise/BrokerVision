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
    foreach ($auctions as $auction) {
      ?>
      <div class='auction'>
        <div class='auctionDate'>
          <?php echo $auction['startDate']; ?>
        </div>
        <div class='auctionLabel'>
          <?php echo $auction['title']; ?>
        </div>

        <?php
                $query  = "SELECT *
                            FROM members
                            INNER JOIN property ON members.propertyID = property.propertyID
                            WHERE members.auctionID = :id
                            ";
                $params = array(
                    ':id' => $auction['auctionID']
                );
                $stmt   = $db->prepare($query);
                $stmt->execute($params);
                $properties = $stmt->fetchAll();
                foreach($properties as $p) {
                  echo "<img height='150' src='" . $p['thumbnail'] . "'  />'";
                }
         ?>
        <div>
          <a class='button' href='/auction/<?php echo$auction['auctionID']; ?>'>View</a>
        </div>
      </div>
      <?php
    }
    echo "</ul>";
  }


  //look up upcoming auctions that they're PARTICIPATING in
  $query  = "SELECT auctions.auctionID, auctions.startDate, property.title, property.propertyID
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
    $auctions = $stmt->fetchAll();
    foreach ($auctions as $auction) {
      ?>
      <div class='auction'>
        <div class='auctionDate'>
          <?php echo $auction['startDate']; ?>
        </div>
        <div class='auctionLabel'>
          <?php echo $auction['title']; ?>
        </div>

        <?php
                $query  = "SELECT *
                            FROM members
                            INNER JOIN property ON members.propertyID = property.propertyID
                            WHERE members.auctionID = :id
                            ";
                $params = array(
                    ':id' => $auction['auctionID']
                );
                $stmt   = $db->prepare($query);
                $stmt->execute($params);
                $properties = $stmt->fetchAll();
                foreach($properties as $p) {
                  echo $p['title'];
                }
         ?>
        <div>
          <a class='button' href='/auction/<?php echo $auction['auctionID']; ?>'>View</a>
        </div>
      </div>
      <?php
    }
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
