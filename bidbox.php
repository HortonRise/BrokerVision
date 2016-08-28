

<div id='newBidContainer'>
  <div id='bidInput' class='bidBox'>
    <form id='newBid' action="#">
      <input type='hidden' id='memberID' name='memberID'  value='<?php echo $myBid['memberID']; ?>'/>
      <div class='bidInput'>
        Price ($/sq-ft)<br />
        <input type='text' id='newPrice' name='newPrice' value='<?php echo $myBid['price']; ?>'/>
      </div>
      <div class='bidInput'>
        Tenant Improvement ($/sq-ft) <br />
        <input type='text' id='newTI' name='newTI' value='<?php echo $myBid['TI']; ?>' />
        </div>
      <div class='bidInput'>
        Free Rent (# Months)<br />
        <input type='text' id='newFR' name='newFR' value='<?php echo $myBid['FR']; ?>' />
        </div>
      <div class='bidInput'>
        Escalation (%) <br />
        <input type='text' id='newEscalation' name='newEscalation' value='<?php echo $myBid['escalation']; ?>' />
        </div>
      <div class='bidInput'>
        Term (Years)<br />
        <input type='text' id='newTerm' name='newTerm' value='<?php echo $myBid['term']; ?>' />
        </div>
        <div class='bidInput'>
          <span onClick='newBid()' class='button'>Submit</span>
        </div>
    </form>
  </div>
  <div id='loadingBid' class='bidBox hidden'>
    Submitting new bid!
  </div>
</div>
