<?php
include "db.php";


if ( $loggedIn and isset($_POST['memberID']) ) {
  //Check that we own it and make a new bid record
  $id =  $_POST['memberID'];
  $query  = "SELECT property.ownerID, members.auctionID
            FROM members
            INNER JOIN property on members.propertyID = property.propertyID
            WHERE members.memberID = :id
          ";

  $params = array(
      ':id' => $id
  );
  $stmt   = $db->prepare($query);
  $stmt->execute($params);
  $row = $stmt->fetch();
  if ($row['ownerID'] == $userID) {
    $auctionID = $row['auctionID'];
    $query  = "INSERT INTO bids
              (memberID, price, TI, FR, escalation, term)
              VALUES
              (:memberID, :price, :ti, :fr, :escalation, :term)
            ";

    $params = array(
        ':memberID' => $id,
        ':price' => $_POST['newPrice'],
        ':ti' => $_POST['newTI'],
        ':fr' => $_POST['newFR'],
        ':escalation' => $_POST['newEscalation'],
        ':term' => $_POST['newTerm']
    );
    $stmt   = $db->prepare($query);
    $stmt->execute($params);

    //UPDATE lastUpdate field
    $newTS = date("Y-m-d h:i:s");
    $query  = "UPDATE auctions
              SET lastUpdate = :ts
              WHERE auctionID = :id
            ";

    $params = array(
        ':id' => $auctionID,
        ':ts' => $newTS
    );
    $stmt   = $db->prepare($query);
    $stmt->execute($params);

  } else {
    echo "Not authorized";
  }
} else {
  echo "error";
}

 ?>
