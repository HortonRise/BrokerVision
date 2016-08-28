$( document ).ready(function() {
    //console.log(test);

    // updateGraph(valuesArray1, 1);
    // updateGraph(valuesArray2, 2);

    setTimeout(function(){
        updatePage();
    }, 1000);


    // setTimeout(function(){
    //     updateGraph(valuesArray1, 2);
    //     updateGraph(valuesArray2, 1);
    //
    // }, 2000);
    //
    // setTimeout(function(){
    //     updateBars(barArray);
    //     updateFacts(barArray);
    // }, 2000);

    //
    //top lines
    //
    // setTimeout(function(){
    //     adjustLines();
    // }, 1000);


    //
    //clock
    //
    setTimeout(function(){
        $('.ring1').css('opacity', '1');
        moveClock(6000);
        displayClock(6000);
    }, 500);


    //JSON
    //getData();

});

///////END DOC READY


var dataObj;
//JSON GET
function getData() {
    $.get( "../getbids.php?a=1", function( data ) {
       var newJSON = data;

       var testJson = jQuery.parseJSON(newJSON);
       dataObj = testJson[0];

       console.log(dataObj);
    });
}

getData();




//graph value max 60 currently
//preferences max 40
//100 total val



function moveClock(time){
    $(".ring1").css('transition','transform ' + (time/2000) + 's linear');
    $(".ring2").css('transition','transform ' + (time/2000) + 's linear');
    $(".mask1").css('transition','all ' + (time/2000) + 's linear');

    setTimeout(function(){
        $(".ring1").css('transform','rotate(180deg)');
        $(".ring2").css('transform','rotate(180deg)');
    }, 10);

    var timeTillHalf = (time/2)+10;

    setTimeout(function(){
        $(".ring2").css('opacity','1');
        $(".mask1").css('display','none');
        $(".ring2").css('transform','rotate(360deg)');
    }, timeTillHalf);
}

function displayClock(time){

    var seconds = Math.round((time/1000)%60);
    var minutes = Math.round(time/60000);


    var min = 0;
    var sec = 0;

    if(seconds<10 && seconds>-1){
        $('.clockNumbers').html(minutes + ":0" + seconds);
    }else{
        $('.clockNumbers').html(minutes + ":" + seconds);
    }


    setTimeout(function(){
        tickDown(minutes, seconds);
    }, 1000);


}


function tickDown(minutes, seconds){


    if(seconds!==0){
        seconds--;
    }else{
        seconds=59;
        if(minutes!==0){
            minutes--;
        }
    };


    if(seconds<10 && seconds>-1){
        $('.clockNumbers').html(minutes + ":0" + seconds);
    }else{
        $('.clockNumbers').html(minutes + ":" + seconds);
    }


    if(seconds!==0 || minutes!==0){
        setTimeout( function(){
            tickDown(minutes, seconds);
        },1000);

    }else{
        //do nothing
    }
}

//////END CLOCK




// var valuesArray1 = [];
// var value1 = {value:"$100", perc:"100%", pref:".9"};
// var value2 = {value:"$60", perc:"60%", pref:".2"};
// var value3 = {value:"$80", perc:"80%",  pref:".4"};
// valuesArray1.push(value1);
// valuesArray1.push(value2);
// valuesArray1.push(value3);
//
//
// var valuesArray2 = [];
// var value1b = {value:"$60", perc:"60%", pref:".4"};
// var value2b = {value:"$80", perc:"80%", pref:".9"};
// var value3b = {value:"$100", perc:"100%", pref:".2"};
// valuesArray2.push(value1b);
// valuesArray2.push(value2b);
// valuesArray2.push(value3b);




//VERTICAL BAR GRAPHS
function updateGraph(graphVals, graphNum){
    for(var j=0; j<3;j++){

        var varClass = ".var" + graphNum;
        var barFullClass = varClass + ' .graph' + ' .barsWrapper' + ' .bar' + (j+1);
        var valFullClass = varClass + ' .graph' + ' .barsWrapper' + ' .bar' + (j+1) + ' .barVal' + (j+1);
        var prefFullClass = varClass + ' .graph' + ' .pref';
        var prefFullValClass = varClass + ' .graph' + ' .pref .prefVal';
        var transformedVal = (graphVals[j].pref*100) + "%";

        $(barFullClass).css('height', graphVals[j].perc);
        $(valFullClass).html(graphVals[j].value);
        $(prefFullClass).css('opacity', graphVals[j].pref);
        $(prefFullValClass).html(transformedVal);

    };
}


//TOP SUMMARY AND FACTS

// var barArray = [];
// var value1c = {value:9.0, cost:'$2.2m'};
// var value2c = {value:5.2, cost:'$2.8m'};
// var value3c = {value:7.1, cost:'$1.9m'};
// barArray.push(value1c);
// barArray.push(value2c);
// barArray.push(value3c);

var barArray = [];
var value1c = {value:0.0, cost:'$0.0m'};
var value2c = {value:0.0, cost:'$0.0m'};
var value3c = {value:0.0, cost:'$0.0m'};
barArray.push(value1c);
barArray.push(value2c);
barArray.push(value3c);



function updateBars(){
    for(var k=0; k<3;k++){

        var barWidth = (dataObj.score[k].value*10) + "%";

        var propId = ".propertyLine" + (k+1);
        var propImgWrapId = ".propertyImgWrapper" + (k+1);
        var propValWrapId = ".propertyValueWrapper" + (k+1);
        var propValId = propValWrapId + " .propertyValue" + (k+1);

        var totalValue = dataObj.netvalue[k].value;

        $(propValId).html(totalValue);
        $(propId).css('width', barWidth);
        $(propImgWrapId).css('left', barWidth);
        $(propValWrapId).css('left', barWidth);
    }
}
// function updateBars(barVals){
//     for(var k=0; k<3;k++){
//
//         var barWidth = (barVals[k].value*10) + "%";
//
//         var propId = ".propertyLine" + (k+1);
//         var propImgWrapId = ".propertyImgWrapper" + (k+1);
//         var propValWrapId = ".propertyValueWrapper" + (k+1);
//
//
//         $(propId).css('width', barWidth);
//         $(propImgWrapId).css('left', barWidth);
//         $(propValWrapId).css('left', barWidth);
//     }
// }

function updateFacts(barVals){
    for(var l=0; l<3;l++){

        var propFactId = ".propStat" + (l+1);
        var propFactNumId = propFactId + " .propFact1 .factNum";
        var propFact2NumId = propFactId + " .propFact2 .factNum";

        $(propFactNumId).html(barVals[l].value);
        $(propFact2NumId).html(barVals[l].cost);

    }
}

function updatePage(){
    console.log(dataObj.score[1]);
    updateBars();
    // for(var m; m<dataObj.score.length; m++){
    //
    // }


}
