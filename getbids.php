
<?php
include_once "db.php";
include "netval.php";

function maxKey($key, $array)
{
    $max = $array[0][$key];
    foreach ($array as $a) {
        if ($a[$key] > $max) {
            $max = $a[$key];
        }
    }
    return $max;
}

function minKey($key, $array)
{
    $min = $array[0][$key];
    foreach ($array as $a) {
        if ($a[$key] < $min) {
            $min = $a[$key];
        }
    }
    return $min;
}

if (isset($_GET['a'])) {
    $id     = $_GET['a'];
    $query  = "SELECT * FROM auctions WHERE auctionID = :id";
    $params = array(
        ':id' => $id
    );
    $stmt   = $db->prepare($query);
    $stmt->execute($params);
    $auctionData = $stmt->fetch();

    //Set up Weighted Scores
    $priceWeight      = $auctionData["priceWeight"] / 10;
    $TIWeight         = $auctionData["TIWeight"] / 10;
    $FRWeight         = $auctionData["FRWeight"] / 10;
    $escalationWeight = $auctionData["escalationWeight"] / 10;
    $termWeight       = $auctionData["termWeight"] / 10;

    $weights = Array(
              "price" => $auctionData["priceWeight"] / 100,
              "TI" => $auctionData["TIWeight"] / 100,
              "FR" => $auctionData["FRWeight"] / 100,
              "escalation" => $auctionData["escalationWeight"] / 100,
              "term" => $auctionData["termWeight"] / 100,
    );
    $lastUpdate = $auctionData['lastUpdate'];
    $maxScore = $priceWeight + $TIWeight + $FRWeight + $escalationWeight + $termWeight;

    //Pull out the most up to date bids for a specified auction
    $query  = "SELECT topBid.currentBid, auctions.auctionID, property.sqft, property.propertyID, property.title, bids.price, bids.TI, bids.FR, bids.escalation, bids.term
              FROM bids
              INNER JOIN
                  (SELECT MAX(bidID) as currentBid, memberID
                FROM bids
                GROUP BY memberID)
              topBid on bids.bidID = topBid.currentBid
              INNER JOIN members on members.memberID = bids.memberID
              INNER JOIN auctions on auctions.auctionID = members.auctionID
              INNER JOIN property on members.propertyID = property.propertyID
              WHERE auctions.auctionID = :id
              ORDER BY property.propertyID ASC
          ";
    $params = array(
        ':id' => $id
    );
    $stmt   = $db->prepare($query);
    $stmt->execute($params);
    if ($stmt->rowCount() > 0) {
        //Set up the arrays that will hold the values, names, and weighted %

        $bids = $stmt->fetchAll();
        foreach ($bids as $bid) {
            $sqft[] = number_format($bid['sqft']);
            $price[]      = Array(
                "property" => $bid['propertyID'],
                "title" => $bid['title'],
                "value" => $bid['price'],
                "weight" => $weights['price']
            );
            $TI[]         = Array(
                "property" => $bid['propertyID'],
                "title" => $bid['title'],
                "value" => $bid['TI'],
                "weight" => $weights['TI']
            );
            $FR[]         = Array(
                "property" => $bid['propertyID'],
                "title" => $bid['title'],
                "value" => $bid['FR'],
                "weight" => $weights['FR']
            );
            $escalation[] = Array(
                "property" => $bid['propertyID'],
                "title" => $bid['title'],
                "value" => $bid['escalation'],
                "weight" => $weights['escalation']
            );
            $term[]       = Array(
                "property" => $bid['propertyID'],
                "title" => $bid['title'],
                "value" => $bid['term'],
                "weight" => $weights['term']
            );
            $v = netValue($bid['price'], $bid['term'], $bid['sqft'], $bid['TI'], $bid['FR'], $bid['esc']);
            if ($v > 1000000) {
              $tinyV = "$" . Round($v / 1000000, 1) . "M";
            } else {
              $tinyV = "$" . Round($v / 1000, 1) . "K";
            }
            $netvalue[] = Array(
                "property" => $bid['propertyID'],
                "title" => $bid['title'],
                "value" => "$" . number_format($v),
                "tinyV" => $tinyV
            );

        }
        $minPrice      = minKey("value", $price);
        $maxTI         = maxKey("value", $TI);
        $maxFR         = maxKey("value", $FR);
        $minEscalation = minKey("value", $escalation);
        $minTerm       = minKey("value", $term);


        //Calculate the percentage based off the BEST score of the group
        $i = 0;
        foreach ($price as &$p) {
            $percent      = ($minPrice / $p["value"]);
            $p["percent"] = intval($percent * 100) . "%";
            $score[$i]    = Array(
                "title" => $p["title"],
                "property" => $p["property"],
                "total" => $percent * $priceWeight
            );
            $i++;
        }

        $i = 0;
        foreach ($TI as &$t) {
            $percent      = ($t["value"] / $maxTI);
            $t["percent"] = intval($percent * 100) . "%";
            $score[$i]["total"] += $percent * $TIWeight;
            $i++;
        }

        $i = 0;
        foreach ($FR as &$f) {
            $percent      = ($f["value"] / $maxFR);
            $f["percent"] = intval($percent * 100) . "%";
            $score[$i]["total"] += $percent * $FRWeight;
            $i++;
        }

        $i = 0;
        foreach ($escalation as &$e) {
            $percent      = ($minEscalation / $e["value"]);
            $e["percent"] = intval($percent * 100) . "%";
            $score[$i]["total"] += $percent * $escalationWeight;
            $i++;
        }

        $i = 0;
        foreach ($term as &$r) {
            $percent      = ($minTerm / $r["value"]);
            $r["percent"] = intval($percent * 100) . "%";
            $score[$i]["total"] += $percent * $termWeight;
            $i++;
        }

        //Figure out the 10-point rating for all of these
        foreach ($score as &$s) {
            $s["value"] = round(($s["total"] / $maxScore) * 10, 1);
        }

        $results[] = Array(
            "price" => $price,
            "TI" => $TI,
            "FR" => $FR,
            "escalation" => $escalation,
            "term" => $term,
            "score" => $score,
            "netvalue" => $netvalue,
            "weights" => $weights,
            "sqft" => $sqft,
            "lastUpdate" => $lastUpdate
        );
        header('Content-Type: application/json');
        echo json_encode($results, JSON_PRETTY_PRINT);



    }
}

?>
