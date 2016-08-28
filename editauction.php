<?php
$title = "Auctions";
require_once("db.php");
include "header.php";
?>

<?php
$id = $_GET['a'];
if ($loggedIn) {
    if ( isset($id) ) {
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
      $verb = "Create";
    }
  }
?>

<h1> <?php echo $verb; ?> Auction </h1>

<div id='editDiv'>
  <form id='editForm' method='post' action='/auction/<?php if (isset($id)) {echo $id; } else { echo "x"; } ?>'>
    <div id='nameSection'>
      <input type='text' name='title' value='<?php echo $auction['title']; ?>'/><br />
    </div>
    <div id='dateSection'>
      <div id='editDate'>
        <input type='date' name='date' value='<?php echo date("Y-m-d"); ?>'/>
      </div>
      <div id='editTime'>
        <input type='time' />
      </div>

    </div>
    <div id='propertySection'>

    </div>
    <input type='submit' />

  </form>

</div>


 <?php
include "footer.php";
?>
