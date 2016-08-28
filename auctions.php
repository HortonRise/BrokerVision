<?php
$title = "Auctions";
require_once("db.php");
include "header.php";
?>

<?php
$query  = "SELECT auctions.auctionID, auctions.startDate
            FROM auctions
            WHERE ownerID = :id
UNION ALL
SELECT auctions.auctionID, auctions.startDate
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
$running = $stmt->rowCount();
if ($running > 0) {
  $auctions = $stmt->fetchAll();
}

 ?>

<div class="upcomingAuctions">
    <div class="container">
        <div class="clearfix">

        </div>
        <h2 class="auctionName">
            Upcoming Auctions
        </h2>

        <?php foreach($auctions as $auction) {
          $auctionID = $auction['auctionID'];
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
          ?>
        <div class="auctionBlock">

            <div class="auctionDateWrapper">

                <img src="templates/css/assets/cal.png" class="calIcon"/>
                <p class="auctionDateTime">
                    October 2nd 2016 | 3:30 PM
                </p>
            </div>
            <?php
            foreach($properties as $p) {
              ?>
              <div class="propertyPreview">
                  <img class="propertyPreviewImage" height='150'  src="<?php echo $p['thumbnail']; ?>" />
                  <p class="buildingName">
                      <?php echo $p['title']; ?>
                  </p>
              </div>

            <?php
            }
            ?>

        <a href="/auction/<?php echo $auctionID ?>"> <input type="submit" class="viewAuction" value="View Auction" /></a>

        </div>
        <hr class="auctionListHR" />
        <?php }   ?>
    </div>
    <div class="spacer">

    </div>
</div>

<?php include "footer.php"; ?>
