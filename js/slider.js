
$(".slid li").hide();
$(".slid li:first").show();


var imgitems = $(".slid li").length;
var imgpos = 1;

setInterval(function(){
    nextslider();
}, 12000);


function nextslider(){
    if (imgpos >= imgitems) {
        imgpos = 1; 
    } else {
        imgpos++; 
    }


    $(".slid li").hide();
    $(".slid li:nth-child(" + imgpos + ")").fadeIn();
}
