$( document ).ready(function() {



    setTimeout(function(){
        updatePage();
    }, 2000);

    // setTimeout(function(){
    //     adjustClock();
    // }, 500);

    //JSON
    //getData();
});

///////END DOC READY

var dataObj;
var myTimer;
var myTimer2;
//JSON GET
function getData() {
    $.get( "../getbids.php?a=1", function( data ) {
       var newJSON = data;

       var testJson = jQuery.parseJSON(newJSON);
       dataObj = testJson[0];

       updatePage();
       console.log(dataObj);
    });
    setTimeout(function(){
        getData();
    }, 2000);
}

getData();

function moveClock(time){
    // $(".ring1").css('transition','transform 0s linear');
    // $(".ring2").css('transition','transform 0s linear');
    //
    // $(".ring1").css('transform','rotate(0deg)');
    // $(".ring2").css('transform','rotate(180deg)');


    $(".ring1").css('transition','transform ' + (time/2000) + 's linear');
    $(".ring2").css('transition','transform ' + (time/2000) + 's linear');
    $(".mask1").css('transition','all ' + (time/2000) + 's linear');

    setTimeout(function(){
        $(".ring1").css('transform','rotate(180deg)');
        $(".ring2").css('transform','rotate(180deg)');
    }, 10);

    var timeTillHalf = (time/2)+10;

    myTimer2 = setTimeout(function(){
        $(".ring2").css('opacity','1');
        $(".mask1").css('display','none');
        $(".ring2").css('transform','rotate(360deg)');
    }, timeTillHalf);
}

function displayClock(time){

    var seconds = 0;
    var minutes = 0;

    seconds = Math.round((time/1000)%60);
    minutes = Math.round(time/60000);


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
        myTimer = setTimeout( function(){
            tickDown(minutes, seconds);
        },1000);

    }else{
        //do nothing
        $('.clockNumbers').css('color','red');
        $('.clockNumbers').css('color','red');
        $('.ring1').css('border','4px red solid');
        $('.ring2').css('border','4px red solid');
    }
}

//////END CLOCK


//VERTICAL BAR GRAPHS
function updateGraph(graphNum){

    var currentObj;
        if(graphNum==0){
            currentObj = dataObj.price;
        }else if(graphNum==1){
            currentObj = dataObj.TI;
        }else if(graphNum==2){
            currentObj = dataObj.FR;
        }else if(graphNum==3){
            currentObj = dataObj.escalation;
        }else{
            currentObj = dataObj.term;
        }

    //console.log(currentObj);

    for(var j=0; j<3;j++){

        var varClass = ".var" + (graphNum+1);
        var barFullClass = varClass + ' .graph' + ' .barsWrapper' + ' .bar' + (j+1);
        var valFullClass = varClass + ' .graph' + ' .barsWrapper' + ' .bar' + (j+1) + ' .barVal' + (j+1);
        var prefFullClass = varClass + ' .graph' + ' .pref';
        var prefFullValClass = varClass + ' .graph' + ' .pref .prefVal';
        var transformedVal = currentObj[j].percent;
        //console.log(transformedVal);

        $(barFullClass).css('height', transformedVal);
        $(valFullClass).html(currentObj[j].value);

    };

    var prefWeight = currentObj[0].weight;
    $(prefFullClass).css('opacity', prefWeight);
    $(prefFullValClass).html((prefWeight*100) + "%");
}

//TOP SUMMARY AND FACTS

function updateBars(){
    for(var k=0; k<3;k++){

        var barWidth = (dataObj.score[k].value*10) + "%";

        var propId = ".propertyLine" + (k+1);
        var propX = ".property" + (k+1);
        var propNameId = propX + " .propertyName";
        var propImgWrapId = ".propertyImgWrapper" + (k+1);
        var propValWrapId = ".propertyValueWrapper" + (k+1);
        var propValId = propValWrapId + " .propertyValue" + (k+1);

        var totalValue = dataObj.netvalue[k].value;
        var propNameData = dataObj.score[k].title;

        $(propNameId).html(propNameData);
        $(propValId).html(totalValue);
        $(propId).css('width', barWidth);
        $(propImgWrapId).css('left', barWidth);
        $(propValWrapId).css('left', barWidth);
    }
}


function updateFacts(){
    for(var l=0; l<3;l++){

        var propFactId = ".propStat" + (l+1);
        var propFactNumId = propFactId + " .propFact1 .factNum";
        var propFact2NumId = propFactId + " .propFact2 .factNum";

        var propNameAndSq = propFactId + " .propName";

        $(propNameAndSq).html(dataObj.score[l].title + "<span style='font-weight:300;font-size:13px;'>  &#124;  " + dataObj.score[l].title + "</span>")

        $(propFactNumId).html(dataObj.score[l].value);
        $(propFact2NumId).html(dataObj.netvalue[l].tinyV);

    }
}

var lastTimeStamp = 0;

function updatePage(){

    updateBars();
    updateFacts();

    for(var m=0; m<5; m++){
        updateGraph(m);
    }

    if(lastTimeStamp !== dataObj.lastUpdate){
        clearTimeout(myTimer);
        clearTimeout(myTimer2);

        $('.clockNumbers').css('color','white');

        $(".ring1").css('transition','transform 0s linear');
        $(".ring2").css('transition','transform 0s linear');

        $('.ring1').css('border','4px white solid');
        $('.ring2').css('border','4px white solid');

        $(".ring2").css('opacity','0');
        $(".mask1").css('display','block');

        $(".ring1").css('transform','rotate(0deg)');
        $(".ring2").css('transform','rotate(180deg)');

        myTimer = setTimeout(function(){
            adjustClock();
        }, 1000);
        lastTimeStamp = dataObj.lastUpdate
        console.log(lastTimeStamp);
    }

    // setTimeout(function(){
    //     updatePage();
    // }, 2000);
}

function adjustClock (){
    $('.ring1').css('opacity', '1');
    moveClock(6000);
    displayClock(6000);
}
