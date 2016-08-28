<?php
    //Form to input your next bid
    if (isset($myProperty)) {
      $query  = "SELECT *
                FROM bids
                WHERE memberID = :id
                ORDER BY bidID  DESC
                LIMIT 1
              ";

      $params = array(
          ':id' => $myPropertyMember
      );
      $stmt   = $db->prepare($query);
      $stmt->execute($params);
      $myBid = $stmt->fetch();
      ?>

      <div id='newBidForm'>
        <form id='newBid' action="#">
          <input type='hidden' id='memberID' name='memberID'  value='<?php echo $myBid['memberID']; ?>'/>
          <div>
            <input type='text' id='newPrice' name='newPrice' value='<?php echo $myBid['price']; ?>'/>
          </div>
          <div>
            <input type='text' id='newTI' name='newTI' value='<?php echo $myBid['TI']; ?>' />
            </div>
          <div>
            <input type='text' id='newFR' name='newFR' value='<?php echo $myBid['FR']; ?>' />
            </div>
          <div>
            <input type='text' id='newEscalation' name='newEscalation' value='<?php echo $myBid['escalation']; ?>' />
            </div>
          <div>
            <input type='text' id='newTerm' name='newTerm' value='<?php echo $myBid['term']; ?>' />
            </div>
            <div>
              <span onClick='newBid()'>Submit</span>
            </div>
        </form>
      </div>
      <div id='loadingBid' class='hidden'>
        Submitting new bid!
      </div>

      <?php
      //close My Property Section
    }
    //Loop through all member data
    foreach ($members as $member) {
      echo "<div id='member_" . $member['memberID'] ."'>" . $member['title'];
      $currentBid = $member['currentBid'];
      $query  = "SELECT *
                FROM bids
                WHERE bids.bidID = :id
              ";

      $params = array(
          ':id' => $currentBid
      );
      $stmt   = $db->prepare($query);
      $stmt->execute($params);



      if ($stmt->rowCount() == 1 ) {
        $bid = $stmt->fetch();


        echo "<div id='price'>Price: $" . $bid['price'] . " / ft^2 </div>";
        echo "<div id='ti'>TI: $" . $bid['TI'] . " / ft^2 </div>";
        echo "<div id='fr'>Free Rent: $" . $bid['FR'] . " months </div>";
        echo "<div id='escalation'>Escalation: $" . $bid['escalation'] . "% </div>";
      } else {
        echo "<div>No current bids</div>";
      }
        echo "</div>";
    }

?>
