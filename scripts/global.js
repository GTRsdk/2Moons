var xsize 	= screen.width;
var ysize 	= screen.height;
var breite	= 720;
var hoehe	= 300;
var xpos	= (xsize-breite) / 2;
var ypos	= (ysize-hoehe) / 2;

window.onerror = blockError; 

function blockError(){return true;} 

$(document).ready(function () {
	$('#content').css("top", $('#infobox').height()+91+"px");
	$(".autocomplete").attr("autocomplete","off")
});

function f(target_url, win_name) {
var new_win = window.open(target_url, win_name, "scrollbars=yes,statusbar=no,toolbar=no,location=no,directories=no,resizable=no,menubar=no,width="+breite+",height="+hoehe+",screenX="+xpos+",screenY="+ypos+",top="+ypos+",left="+xpos);
new_win.focus();
}

function playercard(target_url) {
var playercard = window.open(target_url, "playercard", "scrollbars=yes,statusbar=no,toolbar=no,location=no,directories=no,resizable=no,menubar=no,width=640,height=510,screenX="+((xsize-640)/2)+",screenY="+((ysize-510)/2)+",top="+((ysize-510)/2)+",left="+((xsize-640)/2));
playercard.focus();
}

function info(target_url) {
var playercard = window.open("game.php?page=infos&gid=" + target_url, "info", "scrollbars=yes,statusbar=no,toolbar=no,location=no,directories=no,resizable=no,menubar=no,width=640,height=510,screenX="+((xsize-640)/2)+",screenY="+((ysize-510)/2)+",top="+((ysize-510)/2)+",left="+((xsize-640)/2));
playercard.focus();
}

function pretty_time_update(div) {

	var bocs 	= document.getElementById(div).innerHTML;
	var boc		= bocs.split(" ");
	var Stunde	= boc[0].replace(/h/g, "");
	var Minute	= boc[1].replace(/m/g, "");
	var Sekunde	= boc[2].replace(/s/g, "");
	
	if (Minute == 00 && Stunde != 00) {
		Stunde 	= Stunde - 1;
		Minute 	= 59;
		Sekunde = 59;
	}
	else {
		if (Sekunde == 00 && Minute != 00) {
			Minute 	= Minute - 1;
			Sekunde = 59;
		}
		else {
			Sekunde	= Sekunde - 1;
		}
	}
	if (Sekunde.toString().length < 2) {
		Sekunde = "0" + Sekunde;
	}	
	if (Minute.toString().length < 2) {
		Minute = "0" + Minute;
	}	
	if(Sekunde == 0 && Minute == 0 && Stunde == 0){
		document.getElementById(div).innerHTML = "Fertig";
		window.clearInterval('si_'+div);
	}
	else {
		document.getElementById(div).innerHTML = Stunde + "h "+Minute+"m "+Sekunde+"s";
	}
}

function ajax(datei, id) {
	$.get(datei, function(data){
		$("#"+id).html(data);
	});
}