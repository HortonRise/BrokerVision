
<?php

function netValue($price, $years, $sqft, $TI, $FR, $esc) {
  //echo $price;

  $dr = .06;
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
    //echo "Year " . $i . " $" . Round($rent, 0) . " / NPV $" . Round($n, 0) . "<br />";
    $value += $rent;

    $npv += $n;
    $currentPrice *=  1 + ($esc / 100);
  }
  return Round($npv, 0);
}


//echo netValue(10.00, 10, 100000, 1, 4, 4);


?>
