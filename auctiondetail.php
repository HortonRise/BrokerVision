<?php
$title = "Auctions";
require_once("db.php");
include "header.php";
?>
<h1>Auction</h1>
<?php
$id = $_GET['a'];
if ($loggedIn) {
    if (isset($id)) {
      echo $id;
        //Get Auction Data
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
        echo "<h2>" . $auction['title'] . "</h2>";
        echo "<div id='timer'>" . $auction['endDate'] ."</div>";

        $query  = "SELECT MAX(b.bidID) as currentBid, p.*, m.*
                  FROM members m
                  INNER JOIN property p on p.propertyID = m.propertyID
                  LEFT JOIN bids b ON b.memberID = m.memberID
                  WHERE m.auctionID = :id
                  GROUP BY m.memberID
                ";
        $params = array(
            ':id' => $id
        );
        $stmt   = $db->prepare($query);
        $stmt->execute($params);
        if ($stmt->rowCount() > 0) {
            $members = $stmt->fetchAll();
            //Loop through each member of the auction
            foreach ($members as $member) {
              if ($member['ownerID'] == $userID) {
                $myProperty = $member['propertyID'];
                $myPropertyMember = $member['memberID'];
              }
            }
        }
        if ($auction['ownerID'] == $userID) {
            $owner = true;
        } else {
          $owner = false;
        }

        include "auctionmembers.php";
    }

}
?>





 <?php
include "footer.php";
?>
