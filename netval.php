
<?php
function netValue($price, $years, $sqft, $TI, $FR, $esc) {
  /*
  Calculates the Annual Cost of a Property Investment based on the NPV
  */
  $dr = .06;  //interest ratio of present dollars
  $value = 0;
  $npv = 0;
  $currentPrice = $price;
  for ($i = 0; $i<$years; $i++) {
    //Add the current rent value
    $rent = $currentPrice * $sqft;
    if ($i == 0) {
      //Remove any free months of rent
      $rent *= (12 - $FR) / 12;
      //Remove the landlord improvement dollars
      $rent -= $TI * $sqft;
    }
    //calculate the NPV of the rent
    $n = $rent / pow(1.06, $i);
    $npv += $n;
    $value += $rent;
    $currentPrice *=  1 + ($esc / 100);
  }
  return Round($npv/$years, 0);
}
?>
