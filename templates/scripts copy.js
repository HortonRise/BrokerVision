$( document ).ready(function() {
    //console.log(test);
    adjustChart();

    rate = 30;
    ratePref = 23;

    ti = 40;
    tiPref = 12;

    frm = 24;
    frmPref = 38;

    esc = 40;
    escPref = 6;

    term = 40;
    termPref = 36;

    setTimeout(function(){
        adjustChart();
    }, 1000);
    // $('#prefLabel1').html("<p>" + (ratePref/10) + "</p>");
    // $('#pref1').css('width', ratePref + '%');
    // $('#valLabel1').html("<p>" + rateLabel + "</p>");
    // $('#val1').css('width', rate + '%');
    //
    // $('#prefLabel2').html("<p>" + (tiPref/10) + "</p>");
    // $('#pref2').css('width', tiPref + '%');
    // $('#valLabel2').html("<p>" + tiLabel + "</p>");
    // $('#val2').css('width', ti + '%');



    //
    //top lines
    //
    setTimeout(function(){
        adjustLines();
    }, 1000);


    //
    //clock
    //
    setTimeout(function(){
        moveClock(180000);
        displayClock(180000);
    }, 500);


});


//graph value max 60 currently
//preferences max 40
//100 total val

var rate = 35; // sqft/$
var rateLabel = '$180/sq foot';
var ratePref = 28;
//var rateUnits = "/sq foot";

var ti = 52;
var tiLabel = '$21/sq foot'; // $/sq foot
var tiPref = 14;
//var tiUnits = "/sq foot";

var frm = 20; // free rent months
var frmLabel = '2 months';
var frmPref = 35;
//var frmUnits = "months";

var esc = 55; // escalation percentage
var escLabel = '3% yearly';
var escPref = 10;
//var escUnits = "% yearly";

var term = 35; // term years
var termLabel = '6 years';
var termPref = 33;
//var termUnits = "years";



//overall numbers
var overallNo1 = 45;
var overallNo2 = 25;
var overallNo3 = 64;




function adjustChart(){
    $('#prefLabel1').html("<p>" + (ratePref/10) + "</p>");
    $('#pref1').css('width', ratePref + '%');
    $('#valLabel1').html("<p>" + rateLabel + "</p>");
    $('#val1').css('width', rate + '%');
    //$('#val1').css('width', rate + '%');
    //$('#unit1').html("<p>" + rateUnits + "</p>");


    $('#prefLabel2').html("<p>" + (tiPref/10) + "</p>");
    $('#pref2').css('width', tiPref + '%');
    $('#valLabel2').html("<p>" + tiLabel + "</p>");
    $('#val2').css('width', ti + '%');
    //$('#unit2').html("<p>" + tiUnits + "</p>");

    $('#prefLabel3').html("<p>" + (frmPref/10) + "</p>");
    $('#pref3').css('width', frmPref + '%');
    $('#valLabel3').html("<p>" + frmLabel + "</p>");
    $('#val3').css('width', frm + '%');
    //$('#unit3').html("<p>" + frmUnits + "</p>");

    $('#prefLabel4').html("<p>" + (escPref/10) + "</p>");
    $('#pref4').css('width', escPref + '%');
    $('#valLabel4').html("<p>" + escLabel + "</p>");
    $('#val4').css('width', esc + '%');
    //$('#unit4').html("<p>" + escUnits + "</p>");

    $('#prefLabel5').html("<p>" + (termPref/10) + "</p>");
    $('#pref5').css('width', termPref + '%');
    $('#valLabel5').html("<p>" + termLabel +"</p>");
    $('#val5').css('width', term + '%');
    //$('#unit5').html("<p>" + termUnits + "</p>");
}

function adjustLines(){
    $('#propertyLine1').css('width', overallNo1 + "%");
    $('#propertyImgWrapper1').css('left', overallNo1 + "%");

    $('#propertyLine2').css('width', overallNo2 + "%");
    $('#propertyImgWrapper2').css('left', overallNo2 + "%");

    $('#propertyLine3').css('width', overallNo3 + "%");
    $('#propertyImgWrapper3').css('left', overallNo3 + "%");
}

function moveClock(time){
    $(".ring1").css('transition','all ' + (time/2000) + 's linear');
    $(".ring2").css('transition','transform ' + (time/2000) + 's linear');
    $(".mask1").css('transition','all ' + (time/2000) + 's linear');
    // $(".ring2").css('transform','rotate(180deg)');
    //$(".mask2").css('transition','all ' + (time/2000) + 's linear');
    //console.log('all ' + (time/500) + 's linear');

    setTimeout(function(){
        $(".ring1").css('transform','rotate(180deg)');
        $(".ring2").css('transform','rotate(180deg)');
    }, 10);

    var timeTillHalf = (time/2)+10;

    setTimeout(function(){
        $(".ring2").css('opacity','1');
        $(".mask1").css('display','none');
        $(".ring2").css('transform','rotate(360deg)');
        //console.log("inFxn");
    }, timeTillHalf);
    console.log(timeTillHalf);
}

function displayClock(time){

    var seconds = Math.round((time/1000)%60);
    var minutes = Math.round(time/60000);

    // if(seconds==0){
    //     seconds="00";
    // }
    // if(minutes==0){
    //     minutes="00";
    // }

    //console.log(minutes);

    var min = 0;
    var sec = 0;

    // $('.clockNumbers').html(minutes + ":" + seconds);
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

    // if(minutes!==0){
    //     //minutes--;
    // }else{
    //     minutes=0;
    // };
    if(seconds!==0){
        seconds--;
    }else{
        seconds=59;
        if(minutes!==0){
            minutes--;
        }
    };

    // if(seconds==0){
    //     seconds=0;
    //
    // };
    // if(minutes==0){
    //     minutes=0;
    // };

    if(seconds<10 && seconds>-1){
        $('.clockNumbers').html(minutes + ":0" + seconds);
    }else{
        $('.clockNumbers').html(minutes + ":" + seconds);
    }


    if(seconds!==0 || minutes!==0){
        setTimeout( function(){
            tickDown(minutes, seconds);
        },1000);
        //console.log("tickdown");
    }else{
        //do nothing
    }


}
//
// var rate = 1/180; // sqft/$
// var ratePref = 1.4;
//
// var ti = 21; // $/sq foot
// var tiPref = .8;
//
// var frm = 2; // free rent months
// var frmPref = 1.2;
//
// var esc = .03; // escalation percentage
// var escPref = .6;
//
// var term = 6; // term years
// var termPref = .8;
