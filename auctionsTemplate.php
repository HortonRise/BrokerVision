<?php
$title = "Auctions";
require_once("db.php");
include "header.php";
?>

<div class="upcomingAuctions">
    <div class="container">
        <div class="clearfix">

        </div>
        <h2 class="auctionName">
            Upcoming Auctions
        </h2>
        <div class="auctionBlock">
            <div class="auctionDateWrapper">

                <img src="templates/css/assets/cal.png" class="calIcon"/>
                <p class="auctionDateTime">
                    October 2nd 2016 | 3:30 PM
                </p>
            </div>

            <div class="propertyPreview">
                <img class="propertyPreviewImage" src="templates/css/assets/200SW.png" />
                <p class="buildingName">
                    200 South Wacker
                </p>
            </div>
            <div class="propertyPreview">
                <img class="propertyPreviewImage" src="templates/css/assets/200SW.png" />
                <p class="buildingName">
                    200 South Wacker
                </p>
            </div>
            <div class="propertyPreview">
                <img class="propertyPreviewImage" src="templates/css/assets/200SW.png" />
                <p class="buildingName">
                    200 South Wacker
                </p>
            </div>

        <input type="submit" class="viewAuction" value="View Auction" />

        </div>
        <hr class="auctionListHR" />


        <div class="auctionBlock">
            <div class="auctionDateWrapper">

                <img src="templates/css/assets/cal.png" class="calIcon"/>
                <p class="auctionDateTime">
                    October 3rd 2016 | 3:30 PM
                </p>
            </div>

            <div class="propertyPreview">
                <img class="propertyPreviewImage" src="templates/css/assets/200SW.png" />
                <p class="buildingName">
                    200 South Wacker
                </p>
            </div>
            <div class="propertyPreview">
                <img class="propertyPreviewImage" src="templates/css/assets/200SW.png" />
                <p class="buildingName">
                    200 South Wacker
                </p>
            </div>
            <div class="propertyPreview">
                <img class="propertyPreviewImage" src="templates/css/assets/200SW.png" />
                <p class="buildingName">
                    200 South Wacker
                </p>
            </div>

        <input type="submit" class="viewAuction" value="View Auction" />

        </div>
    </div>
    <div class="spacer">
        
    </div>
</div>

<?php include "footer.php"; ?>
